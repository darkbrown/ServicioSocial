<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorInicioCoordinador extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper('url_helper');
		
    
    }

	public function index()
	{
		$this->load->view('coordinador/EncabezadoCoordinador');
	}


	public function listaAlumnos()
	{
		$this->load->model('ModeloAlumno');
		$data['listaAlumnos'] = $this->ModeloAlumno->obtenerAlumnos();
		$this->load->view('coordinador/EncabezadoCoordinador');
		$this->load->view('coordinador/VistaListaAlumnos', $data);
	}

	public function editarAlumno($matricula)
	{
		$matricula = base64_decode(urldecode($matricula));
		
		if(strlen($matricula) <= 9 && strlen($matricula) > 0){
			$this->load->model('ModeloAlumno');
			$alumno =  $this->ModeloAlumno->obtenerAlumno($matricula);
			
			if(count($alumno)){
				$datos = array(
					'nombre' => $alumno[0]['nombre'],
					'apellidos' => $alumno[0]['apellidos'],
					'matricula' => $alumno[0]['matricula'],
					'bloque' => $alumno[0]['bloque'],
					'seccion' => $alumno[0]['seccion'],
					'correo' => $alumno[0]['correo'],
					'telefono' => $alumno[0]['telefono'],
				);

				$this->load->view('coordinador/EncabezadoCoordinador');
				$this->load->view('coordinador/VistaEditarAlumno', $datos);
			}else{
				echo "RECURSO NO DISPONIBLE PARA EDICIÓN";
			}
		}else{
			echo "LOS DATOS NO SE RECIBIERON CORRECTAMENTE";
		}	
	}

	public function modificarAlumno()
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
            );
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
			$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
			$this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
            $this->form_validation->set_rules('bloque', 'Bloque', 'trim|required|numeric');
            $this->form_validation->set_rules('seccion', 'Seccion', 'trim|required|numeric');
            $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|numeric');

            if($this->form_validation->run() == TRUE){
                
                    $this->load->model('ModeloAlumno');        
                    $confirmacion = $this->ModeloAlumno->modificarAlumno($datos); 

            }else{
                $confirmacion = "datosInvalidos";
            }
        }else{
            $confirmacion =  "vacio";
        }

        echo $confirmacion;
	}

	public function cambiarMatricula($matricula)
	{
		$matricula = base64_decode(urldecode($matricula));
		
		if(strlen($matricula) <= 9 && strlen($matricula) > 0){
			$datos['matricula'] = $matricula;
			$this->load->view('coordinador/EncabezadoCoordinador');
			$this->load->view('coordinador/VistaModificarMatricula', $datos);
			
		}else{
			echo "LOS DATOS NO SE RECIBIERON CORRECTAMENTE";
		}	
	}

	public function modificarMatricula()
	{
		
		$confirmacion = "";
        
        if($this->input->post()){
			$this->load->model('ModeloAlumno'); 
            $matriculaAnterior = strtoupper($this->input->post('matriculaAnterior'));
			$matriculaNueva = strtoupper($this->input->post('matriculaNueva'));
			$matriculaNueva2 = strtoupper($this->input->post('matriculaNueva2'));
            $this->form_validation->set_rules('matriculaAnterior', 'MatriculaAnterior', 'trim|required|min_length[9]|max_length[9]');
			$this->form_validation->set_rules('matriculaNueva', 'MatriculaNueva', 'trim|required|min_length[9]|max_length[9]');
			$this->form_validation->set_rules('matriculaNueva2', 'MatriculaNueva2', 'trim|required|min_length[9]|max_length[9]|matches[matriculaNueva]');			
            if($this->form_validation->run() == TRUE){	
				if($matriculaAnterior != $matriculaNueva){	
										
					if($this->ModeloAlumno->verificarMatricula($matriculaNueva) == "0"){
						$this->load->model('ModeloAlumno');  
						$datos = array(
							'matricula' => $matriculaNueva
						);     
						$confirmacion = $this->ModeloAlumno->modificarMatricula($matriculaAnterior, $datos);
					}else{
						$confirmacion = "yaExiste";
					}
				}else{
					$confirmacion = "sonIguales";
				}
            }else{
                $confirmacion = "datosInvalidos";
            }
        }else{
            $confirmacion = "vacio";
        }

        echo $confirmacion;
	}

	public function modificarContrasenaAlumno()
	{
		$this->load->view('coordinador/VistaModificarContrasenaAlumno');
	}

}
