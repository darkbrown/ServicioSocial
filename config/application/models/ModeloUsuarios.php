<?php
class ModeloUsuarios extends CI_Model {

    public function iniciarSesion($datos)
    {
        $usuario = array();
        $this->db->where('correo', $datos['correo']);
        $this->db->where('contrasena', $datos['contrasena']);
        $alumno = $this->db->get('alumno');

        if(count($alumno->result_array())){
            $usuario = $alumno->result_array();
        }else{
            $this->db->where('correo', $datos['correo']);
            $this->db->where('contrasena', $datos['contrasena']);
            $coordinador = $this->db->get('coordinador');
            if(count($coordinador->result_array())){
                $usuario = $coordinador->result_array();
            }
        }


        return $usuario;

    }


}