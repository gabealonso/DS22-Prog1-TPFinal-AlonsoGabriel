<?php
class Alumnos
{
    protected $legajo;
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $id_mod;
    protected $cursos_id;
    protected $usuarios_id_admin;
    protected $id_alumno;

    public function __construct($legajo, $nombre, $apellido, $email, $id_mod, $cursos_id, $usuarios_id_admin, $id_alumno = null)
    {
        $this->legajo = $legajo;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->id_mod = $id_mod;
        $this->cursos_id = $cursos_id;
        $this->usuarios_id_admin = $usuarios_id_admin;
        $this->id_alumno = $id_alumno;
    }

    public function getIdAlumno() { return $this->id_alumno; }
    public function setIdAlumno($id_alumno) { $this->id_alumno = $id_alumno; }
    public function getLegajo() { return $this->legajo; }
    public function getNombre() { return $this->nombre; }
    public function getApellido() { return $this->apellido; }
    public function getEmail() { return $this->email; }
    public function getId_mod() { return $this->id_mod; }
    public function getCursos_id() { return $this->cursos_id; }
    public function getUsuarios_id_admin() { return $this->usuarios_id_admin; }
}