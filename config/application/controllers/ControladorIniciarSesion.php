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

	public function seleccionarNuevaCuenta()
	{
        $this->load->view('EncabezadoVacio');
		$this->load->view('registro/VistaSeleccionarCuenta');
    }

	public function iniciarSesion()
	{
		$confirmacion = "dsads";
		if($this->input->post()){
			$usuario = array(
                'correo' => mb_strtoupper ($this->input->post('correo')),
                'contrasena' => $this->input->post('contrasena')
            );
			$this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
			$this->form_validation->set_rules('contrasena', 'Contrasena', 'trim|required');

			if($this->form_validation->run() == TRUE){
				$this->load->model('ModeloUsuario');        
				$usuario['contrasena'] = hash("sha256", $usuario['contrasena']);
				$nuevoUsuario = Array();
				$nuevoUsuario = $this->ModeloUsuario->obtenerUsuario($usuario);
				if($nuevoUsuario){
					if($nuevoUsuario['estatusUsuario'] != 'SUSPENDIDO'){
						$datosSesion = Array();
						if($nuevoUsuario['tipoUsuario'] == 'ALUMNO'){
							$this->load->model('ModeloAlumno');
							$alumno = $this->ModeloAlumno->obtenerAlumnoXUsuario($nuevoUsuario['idUsuario']);
							if($alumno){
								$datosSesion = array(
									'correo' => $nuevoUsuario['correoUsuario'],
									'nombre' => $alumno['nombreAlumno'],
									'tipoUsuario' => $nuevoUsuario['tipoUsuario'],
									'matricula' => $alumno['matriculaAlumno'],
									'apellidos' => $alumno['apellidosAlumno'],
									'idUsuario' => $nuevoUsuario['idUsuario']
								);
								$directorio = realpath(APPPATH) . '/archivos/' . base64_encode('ALUMNOS') . '/'.base64_encode($nuevoUsuario['idUsuario']);
							}else{
								$confirmacion = 'noExiste';
							}
						}elseif($nuevoUsuario['tipoUsuario'] == 'COORDINADOR'){
							$this->load->model('ModeloCoordinador');
							$coordinador = $this->ModeloCoordinador->obtenerCoordinadorXUsuario($nuevoUsuario['idUsuario']);
							if($coordinador){
								$datosSesion = array(
									'correo' => $nuevoUsuario['correoUsuario'],
									'nombre' => $coordinador['nombreCoordinador'],
									'tipoUsuario' => $nuevoUsuario['tipoUsuario'],
									'apellidos' => $coordinador['apellidosCoordinador'],
									'idUsuario' => $nuevoUsuario['idUsuario']
								);
								$directorio = realpath(APPPATH) . '/archivos/' . base64_encode('COORDINADORES') . '/'.base64_encode($nuevoUsuario['idUsuario']);
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
