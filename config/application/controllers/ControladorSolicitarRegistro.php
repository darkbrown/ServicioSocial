<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorSolicitarRegistro extends CI_Controller {


	public function index()
	{
        $this->load->view('EncabezadoVacio');
		$this->load->view('VistaSolicitarRegistro');
    }
    

    public function formularioAlumno()
    {
        $this->load->view('EncabezadoVacio');
		$this->load->view('alumno/VistaRegistrarAlumno');
    }

    public function registrarAlumno()
    {
        $confirmacion = "";
        
        if($this->input->post()){
            $datos = array(
                'nombre' => strtoupper($this->input->post('nombre')),
                'apellidos' => strtoupper($this->input->post('apellidos')),
                'matricula' => strtoupper($this->input->post('matricula')),
                'bloque' => $this->input->post('bloque'),
                'seccion' => $this->input->post('seccion'),
                'correo' => strtoupper($this->input->post('correo')),
                'telefono' => $this->input->post('telefono'),
                'contrasena' => $this->input->post('contrasena')
            );
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
            $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
            $this->form_validation->set_rules('matricula2', 'Matricula2', 'trim|required|matches[matricula]');
            $this->form_validation->set_rules('bloque', 'Bloque', 'trim|required|numeric');
            $this->form_validation->set_rules('seccion', 'Seccion', 'trim|required|numeric');
            $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|numeric');
            $this->form_validation->set_rules('contrasena', 'Contrasena', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('contrasena2', 'Contrasena2', 'trim|required|matches[contrasena]');

            if($this->form_validation->run() == TRUE){
                $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]|is_unique[alumno.matricula]');
                $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email|is_unique[alumno.correo]');
                if($this->form_validation->run() == TRUE){                    
                    $this->load->model('ModeloAlumno');        
                    $datos['contrasena'] = hash("sha256", $datos['contrasena']);
                    $datos['estatus'] = 'ACTIVO';
                    $confirmacion = $this->ModeloAlumno->registrarAlumno($datos); //retorna '1' y no true
                }else{
                    $confirmacion = "yaExiste";
                }               
            }else{
                $confirmacion = "datosInvalidos";
            }
        }else{
            $confirmacion =  "vacio";
        }

        echo $confirmacion;
    }
}
?>