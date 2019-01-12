<?php
class ModeloAlumno extends CI_Model {

    public function registrarAlumno($alumno)
    {
        return $this->db->insert('Alumno', $alumno);

    }

    public function obtenerAlumnos(){
        return $this->db->get('alumno')->result_array();
    }

    public function obtenerAlumno($matricula){
        $this->db->where('matricula', $matricula);
        return $this->db->get('alumno')->result_array();
    }

    public function modificarAlumno($alumno){  
        $this->db->where('matricula', $alumno['matricula']);
        $this->db->update('alumno', $alumno);
        return (bool)($this->db->affected_rows() > 0);
    }

}