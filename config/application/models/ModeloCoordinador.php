<?php
class ModeloCoordinador extends CI_Model {

    public function obtenerCoordinadorXCorreo($correo)
    {
        $this->db->where('correo', $correo);
        return $this->db->get('coordinador')->result_array();
    }
    
    public function obtenerCoordinadorXUsuario($idUsuario)
    {
        $this->db->where('Usuario_idUsuario', $idUsuario);
        return $this->db->get('coordinador')->row_array();
    }

}