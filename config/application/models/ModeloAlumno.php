<?php
class ModeloAlumno extends CI_Model {

    public function registrarAlumno($alumno)
    {
        $datos = array(
            'nombre' => $alumno['nombre'],
            'apellidos' => $alumno['apellidos'],
            'matricula' => $alumno['matricula'],
            'bloque' => $alumno['bloque'],
            'seccion' => $alumno['seccion'],
            'correo' => $alumno['correo'],
            'telefono' => $alumno['telefono'],
            'contrasena' => $alumno['contrasena'],
            'estatus' => "1"
        );
        return $this->db->insert('Alumno', $datos);

    }


}