<?php
class ModeloAlumno extends CI_Model {

    public function registrarAlumno($alumno)
    {
        return $this->db->insert('Alumno', $alumno);
    }

    public function obtenerIdUsuario($matricula)
    {
        $this->db->where('matriculaAlumno', $matricula);
        $alumno = $this->db->get('alumno')->row_array();
        return $alumno['Usuario_idUsuario'];
    }

    public function obtenerAlumno($matricula){
        $this->db->select('nombreAlumno, apellidosAlumno, bloqueAlumno, seccionAlumno, telefonoAlumno, matriculaAlumno, estatusUsuario, correoUsuario');
        $this->db->from('alumno a');
        $this->db->where('matriculaAlumno', $matricula);
        $this->db->join('usuario u', 'u.idUsuario = a.Usuario_idUsuario');
        return $this->db->get()->row_array();
    }

    public function obtenerAlumnos(){
        $this->db->select('nombreAlumno, apellidosAlumno, telefonoAlumno, estatusUsuario, matriculaAlumno, correoUsuario');
        $this->db->from('alumno a');
        $this->db->join('usuario u', 'u.idUsuario = a.Usuario_idUsuario');
        return $this->db->get()->result_array();
    }

    public function obtenerAlumnoXMatricula($matricula){
        $this->db->where('matriculaAlumno', $matricula);
        return $this->db->get('alumno')->result_array();
    }
    public function obtenerAlumnoXUsuario($idUsuario){
        $this->db->where('Usuario_idUsuario', $idUsuario);
        return $this->db->get('alumno')->row_array();
    }

    public function modificarAlumno($alumno){  
        $this->db->where('matriculaAlumno', $alumno['matriculaAlumno']);
        $this->db->update('alumno', $alumno);
        return (bool)($this->db->affected_rows() > 0);
    }
    
    public function modificarMatricula($matriculaAnterior, $matriculaNueva){
        $this->db->where('matriculaAlumno', $matriculaAnterior);
        $this->db->update('alumno', $matriculaNueva);
        return (bool)($this->db->affected_rows() > 0);
    }

    public function verificarMatricula($matricula){
        $estatus= "0";
        $this->db->where('matriculaAlumno', $matricula);
        $alumno = array();
        $alumno = $this->db->get('alumno')->row_array();        
        if($alumno){
            $estatus = "1";
        } 
        return $estatus;
    }

}

?>