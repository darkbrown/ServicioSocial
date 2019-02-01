<?php
class ModeloDependencia extends CI_Model {

    public function registrarDependencia($dependencia)
    {
        return $this->db->insert('Dependencia', $dependencia);

    }

    public function modificarDependencia($datosDependencia, $idUsuario)
    {
        $this->db->where('Responsable_idUsuario', $idUsuario);
        $this->db->update('dependencia', $datosDependencia);
        return (bool)($this->db->affected_rows() > 0);
    }
}