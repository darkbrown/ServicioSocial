<?php
class ModeloAlumno extends CI_Model {

    public function registrarAlumno($alumno)
    {
        return $this->db->insert('Alumno', $alumno);

    }

    public function obtenerIdUsuario($matricula)
    {
        $this->db->where('matricula', $matricula);
        $alumno = $this->db->get('alumno')->result_array();
        return $alumno[0]['Usuario_idUsuario'];
    }

    public function obtenerAlumno($matricula){
        $this->db->select('nombre', 'apellidos', 'telefono', 'usuario.estatus', 'matricula', 'usuario.correo')->get_compiled_select();
        $this->db->from('alumno');
        $this->db->where('matricula', $matricula);
        $this->db->join('usuario', 'idUsuario = Usuario_idUsuario');
        return $this->db->get()->result_array();
    }

    public function obtenerAlumnos(){
        $this->db->select('nombre', 'apellidos', 'telefono', 'usuario.estatus', 'matricula', 'usuario.correo')->get_compiled_select();
        $this->db->from('alumno');
        $this->db->join('usuario', 'idUsuario = Usuario_idUsuario');
        return $this->db->get()->result_array();
    }

    public function obtenerAlumnoXMatricula($matricula){
        $this->db->where('matricula', $matricula);
        return $this->db->get('alumno')->result_array();
    }
    public function obtenerAlumnoXUsuario($idUsuario){
        $this->db->where('Usuario_idUsuario', $idUsuario);
        return $this->db->get('alumno')->result_array();
    }

    public function modificarAlumno($alumno){  
        $this->db->where('matricula', $alumno['matricula']);
        $this->db->update('alumno', $alumno);
        return (bool)($this->db->affected_rows() > 0);
    }
    public function modificarAlumno2($alumno){  
        $this->db->where('matricula', $alumno['matricula']);
        $this->db->update('alumno', $alumno);
        return (bool)($this->db->affected_rows() > 0);
    }

    public function modificarMatricula($matriculaAnterior, $matriculaNueva){
        $this->db->where('matricula', $matriculaAnterior);
        $this->db->update('alumno', $matriculaNueva);
        return (bool)($this->db->affected_rows() > 0);
    }

    public function verificarMatricula($matricula){
        $estatus= "0";
        $this->db->where('matricula', $matricula);
        $alumno = $this->db->get('alumno')->result_array();        
        if(count($alumno) > 0){
            $estatus = "1";
        }
 
        return $estatus;
    }

    
    

  
}

?>