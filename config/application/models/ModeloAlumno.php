<?php
class ModeloAlumno extends CI_Model {

    public function registrarAlumno($alumno)
    {
        return $this->db->insert('Alumno', $alumno);

    }


}