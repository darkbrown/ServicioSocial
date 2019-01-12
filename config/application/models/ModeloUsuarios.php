<?php
class ModeloUsuarios extends CI_Model {

    public function iniciarSesion($usuario)
    {
        $this->db->where('correo', $usuario['correo']);
        $this->db->where('contrasena', $usuario['contrasena']);
        $alumno = $this->db->get('Alumno');
        return $alumno->result_array();

    }


}