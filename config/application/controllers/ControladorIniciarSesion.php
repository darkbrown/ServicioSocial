<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorIniciarSesion extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
    
    }

	public function index()
	{
		$this->load->view('VistaIniciarSesion');
	}

	public function iniciarSesion()
	{
		$confirmacion = "dsads";
		if($this->input->post()){
			$usuario = array(
                'correo' => strtoupper ($this->input->post('correo')),
                'contrasena' => $this->input->post('contrasena')
            );
			$this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
			$this->form_validation->set_rules('contrasena', 'Contrasena', 'trim|required');

			if($this->form_validation->run() == TRUE){
				$this->load->model('ModeloUsuario');        
				$usuario['contrasena'] = hash("sha256", $usuario['contrasena']);
				$nuevoUsuario = Array();
				$nuevoUsuario = $this->ModeloUsuario->obtenerUsuario($usuario);
				if(count($nuevoUsuario) > 0){
					if($nuevoUsuario[0]['estatus'] != 'SUSPENDIDO'){
						$datosSesion = Array();
						if($nuevoUsuario[0]['tipo'] == 'ALUMNO'){
							$this->load->model('ModeloAlumno');
							$alumno = $this->ModeloAlumno->obtenerAlumnoXUsuario($nuevoUsuario[0]['idUsuario']);
							if(count($alumno) > 0){
								$datosSesion = array(
									'correo' => $nuevoUsuario[0]['correo'],
									'nombre' => $alumno[0]['nombre'],
									'tipoUsuario' => $nuevoUsuario[0]['tipo'],
									'matricula' => $alumno[0]['matricula'],
									'apellidos' => $alumno[0]['apellidos'],
									'idUsuario' => $nuevoUsuario[0]['idUsuario']
								);
								$directorio = realpath(APPPATH) . '/archivos/' . base64_encode('ALUMNOS') . '/'.base64_encode($nuevoUsuario[0]['idUsuario']);
							}else{
								$confirmacion = 'noExiste';
							}
						}elseif($nuevoUsuario[0]['tipo'] == 'COORDINADOR'){
							$this->load->model('ModeloCoordinador');
							$coordinador = $this->ModeloCoordinador->obtenerCoordinadorXUsuario($nuevoUsuario[0]['idUsuario']);
							if(count($coordinador) > 0){
								$datosSesion = array(
									'correo' => $nuevoUsuario[0]['correo'],
									'nombre' => $coordinador[0]['nombre'],
									'tipoUsuario' => $nuevoUsuario[0]['tipo'],
									'apellidos' => $coordinador[0]['apellidos'],
									'idUsuario' => $nuevoUsuario[0]['idUsuario']
								);
								$directorio = realpath(APPPATH) . '/archivos/' . base64_encode('COORDINADORES') . '/'.base64_encode($nuevoUsuario[0]['idUsuario']);
							}else{
								$confirmacion = 'noExiste';
							}					
						}else{
							//AQUI VA EL OTRO TIPO DE USUARIO



							//
						}

						if(isset($directorio)){
							if(!file_exists($directorio)){
								mkdir($directorio, 0777, true);
							}
						}
		
						$this->session->set_userdata($datosSesion);
								
								if($this->session->userdata('tipoUsuario') == 'ALUMNO'){										
									$confirmacion = 'alumno';
								}elseif($this->session->userdata('tipoUsuario') == 'COORDINADOR'){
									$confirmacion = 'coordinador';
								}
					}else{
						$confirmacion = 'suspendido';
					}
					
				}else{
					$confirmacion = 'noExiste';
				}							
			}else{
				$confirmacion = 'datosInvalidos';
			}
			
		}else{
			$confirmacion = 'vacio';
		}

		echo $confirmacion;
	}
}
?>
