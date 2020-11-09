<?php
require_once '.env.php';
require_once 'Alumnos.php';

class RepositorioAlumno
{
    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }

    public function getTablaAlumnos()
    {
        $q = "SELECT a.id_alumno, a.legajo, a.nombre, a.apellido, a.email,
        CONCAT(usu.nombre,' ',usu.apellido) as modificado, c.nombre_curso, car.nombre_carrera, CONCAT(usu2.nombre, ' ', usu2.apellido) as creado
        FROM alumnos a
        JOIN cursos c ON a.cursos_id = c.id
        JOIN carreras car ON c.carreras_id = car.id
        JOIN usuarios usu2 ON a.usuarios_id_admin = usu2.id_admin
        LEFT JOIN usuarios usu ON a.id_mod = usu.id_admin";
        $resultado = self::$conexion->query($q);
        return $resultado;
    }

    public function getAlum($id_alumno)
    {
        $q = "SELECT * FROM alumnos WHERE id_alumno = '$id_alumno'";
        $resultado = self::$conexion->query($q);
        return $resultado;
    }

    public function search($legajo)
    {
        $q = "SELECT a.id_alumno, a.legajo, a.nombre, a.apellido, a.email,
        CONCAT(usu.nombre,' ',usu.apellido) as modificado, c.nombre_curso, car.nombre_carrera, CONCAT(usu2.nombre, ' ', usu2.apellido) as creado
        FROM alumnos a
        JOIN cursos c ON a.cursos_id = c.id
        JOIN carreras car ON c.carreras_id = car.id
        JOIN usuarios usu2 ON a.usuarios_id_admin = usu2.id_admin
        LEFT JOIN usuarios usu ON a.id_mod = usu.id_admin WHERE a.legajo LIKE '%".$legajo."%'";
        $resultado = self::$conexion->query($q);
        return $resultado;
    }

    public function exists($legajo)
    {
        $q = "SELECT legajo FROM alumnos WHERE legajo = '$legajo'";
        $resultado = self::$conexion->query($q);
        $row = mysqli_fetch_array($resultado);
        if ($row[0] === $legajo) {
            return false;
        }
        else {
            return true;
        }
    }

    public function save(Alumnos $a)
    {
        $q = "INSERT INTO alumnos (legajo, nombre, apellido, email, id_mod, cursos_id, usuarios_id_admin) ";
        $q.= "VALUES (?, ?, ?, ?, ?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $leg = $a->getLegajo();
        $nom = $a->getNombre();
        $ape = $a->getApellido();
        $email = $a->getEmail();
        $mod = $a->getId_mod();
        $curso = $a->getCursos_id();
        $adm = $a->getUsuarios_id_admin();

        $query->bind_param("isssiii", $leg, $nom, $ape, $email, $mod, $curso, $adm);

        if ( $query->execute() ) {
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }
    }

    public function edit($id_alumno, $legajo, $nombre, $apellido, $email, $id_mod, $cursos_id)
    {
        $q = "UPDATE alumnos SET legajo='$legajo', nombre='$nombre', apellido='$apellido', email='$email', 
        id_mod='$id_mod', cursos_id='$cursos_id' WHERE id_alumno='$id_alumno'";
        
        $query = self::$conexion->query($q);
        if ( $query ) {
            return true;
        }
        else {
            return false;
        }
    }

    public function delete($id_alumno)
    {
        $q = "DELETE FROM alumnos WHERE id_alumno='$id_alumno'";
        $query = self::$conexion->query($q);
        if ( $query ) {
            return true;
        }
        else {
            return false;
        }
    }
}