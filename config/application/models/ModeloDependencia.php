<?php
class ModeloDependencia extends CI_Model {

    public function registrarDependencia($dependencia)
    {
        return $this->db->insert('Dependencia', $dependencia);

    }
}