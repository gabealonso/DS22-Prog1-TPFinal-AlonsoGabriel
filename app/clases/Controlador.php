<?php
require_once 'Usuario.php';
require_once 'RepositorioUsuario.php';
require_once 'Alumnos.php';
require_once 'RepositorioAlumno.php';

class Controlador
{
    protected $usuario = null;

    public function login($nombre_usuario, $clave)
    {
        $repo = new RepositorioUsuario();
        $usuario = $repo->login($nombre_usuario, $clave);
        //Si falló el login:
        if ($usuario === false) {
            return [false, "Error de credenciales"];
        }
        else {
            session_start();
            $_SESSION['usuario'] = serialize($usuario);
            return [true, "Usuario autenticado correctamente"];
        }
    }

    public function createUsuario($nombre_usuario, $nombre, $apellido, $clave)
    {
        $repo = new RepositorioUsuario();
        if($repo->exists($nombre_usuario)){
            return [ false, "Error al crear el usuario"];
        }
        else{
            $usuario = new Usuario($nombre_usuario, $nombre, $apellido);
            $id_admin = $repo->save($usuario, $clave);
            $usuario->setId($id_admin);
            return [ true, "Usuario creado correctamente" ];
        }
    }

    public function createAlumno($legajo, $nombre, $apellido, $email, $id_mod, $cursos_id, $usuarios_id_admin)
    {
        $repo = new RepositorioAlumno();
        if($repo->exists($legajo)){
            $alumno = new Alumnos($legajo, $nombre, $apellido, $email, $id_mod, $cursos_id, $usuarios_id_admin);
            $id_alumno = $repo->save($alumno);
            $alumno->setIdAlumno($id_alumno);
            return [ true, "Alumno dado de alta exitosamente" ];
        }
        else{
            return [ false, "Error al dar de alta al alumno" ];
        }
    }

    public function editAlumno($id_alumno, $legajo, $nombre, $apellido, $email, $id_mod, $cursos_id)
    {
        $repo = new RepositorioAlumno();
        $modificacion = $repo->edit($id_alumno, $legajo, $nombre, $apellido, $email, $id_mod, $cursos_id);
        if ($modificacion === false) {
            return [ false, "Error al modificar al alumno" ];
        }
        else {
            return [ true, "Alumno modificado exitosamente" ];
        }
    }

    public function deleteAlumno($id_alumno)
    {
        $repo = new RepositorioAlumno();
        $eliminacion = $repo->delete($id_alumno);
        if ($eliminacion === false) {
            return [ false, "Error al eliminar el alumno" ];
        }
        else {
            return [ true, "Alumno eliminado exitosamente" ];
        }
    }

    public function getAlumno($id_alumno)
    {
        $repo = new RepositorioAlumno();
        $resultado = $repo->getAlum($id_alumno);
        return $resultado;
    }

    public function buscarAlumno($buscador)
    {
        $repo = new RepositorioAlumno();
        $resultado = $repo->search($buscador);
        return $resultado;
    }

    public function getTabla()
    {
        $repo = new RepositorioAlumno();
        $resultado = $repo->getTablaAlumnos();
        return $resultado;
    }
}
