<?php
class ModeloResponsable extends CI_Model {

    public function registrarResponsable($responsable)
    {
        return $this->db->insert('Responsable', $responsable);
    }

    public function obtenerResponsable($correo){
        $this->db->select('*');
        $this->db->from('responsable r');
        $this->db->join('usuario u', 'u.idUsuario = r.Usuario_idUsuario');
        $this->db->where('correoUsuario', $correo);
        $this->db->join('dependencia d', 'd.Responsable_idUsuario = u.idUsuario');
        
        return $this->db->get()->row_array();
    }

    public function obtenerResponsables(){
        $this->db->select('nombreResponsable, apellidosResponsable, telefonoResponsable, extensionResponsable
        , estatusUsuario, nombreDependencia, correoUsuario, extensionResponsable');
        $this->db->from('responsable r');
        $this->db->join('usuario u', 'u.idUsuario = r.Usuario_idUsuario');
        $this->db->join('dependencia d', 'd.Responsable_idUsuario = u.idUsuario');
        return $this->db->get()->result_array();
    }

    public function modificarResponsable($responsable, $idUsuario){  
        $this->db->where('Usuario_idUsuario', $idUsuario);
        $this->db->update('responsable', $responsable);
        return (bool)($this->db->affected_rows() > 0);
    }

}