<?php
class Usuario
{
    protected $id_admin;
    protected $usuario;
    protected $nombre;
    protected $apellido;

    public function __construct($usuario, $nombre, $apellido, $id_admin = null)
    {
        $this->id_admin = $id_admin;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->usuario = $usuario;
    }

    public function getId() { return $this->id_admin;}
    public function setId($id_admin) { $this->id_admin = $id_admin; }
    public function getUsuario() {return $this->usuario;}
    public function getNombre() {return $this->nombre;}
    public function getApellido() {return $this->apellido;}
    public function getNombreApellido() {return "$this->nombre $this->apellido";}
}





