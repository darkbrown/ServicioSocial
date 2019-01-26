<?php
class ModeloResponsable extends CI_Model {

    public function registrarResponsable($responsable)
    {
        return $this->db->insert('Responsable', $responsable);
    }

}