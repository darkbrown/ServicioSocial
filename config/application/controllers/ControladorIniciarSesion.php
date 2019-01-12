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
			$datos = array(
                'correo' => strtoupper ($this->input->post('correo')),
                'contrasena' => $this->input->post('contrasena')
            );
			$this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
			$this->form_validation->set_rules('contrasena', 'Contrasena', 'trim|required');

			if($this->form_validation->run() == TRUE){
				$this->load->model('ModeloUsuarios');        
				$datos['contrasena'] = hash("sha256", $datos['contrasena']);
				$usuario = array();
				$usuario = $this->ModeloUsuarios->iniciarSesion($datos);
				
				if(count($usuario)){
					if($usuario[0]['estatus'] == '1'){
						$datosUsuario = array();
						if($usuario[0]['tipoUsuario'] == 'ALUMNO'){
					
							$datosUsuario = array(
								'correo' => $usuario[0]['correo'],
								'nombre' => $usuario[0]['nombre'],
								'tipoUsuario' => 'ALUMNO',
								'matricula' => $usuario[0]['matricula'],
								'apellidos' => $usuario[0]['apellidos']
							);
							
							$directorio = realpath(APPPATH) . '/archivos/' . base64_encode('ALUMNOS') . '/'.base64_encode($usuario[0]['matricula']);
							if(!file_exists($directorio)){
								mkdir($directorio, 0777, true);
							}
						}

						/**AQUI DEBE DE IR EL CÓDIGO PARA VALIDAR A LOS DEMAS USUARIOS
						 * 
						 * 
						 * 
						 * 
						 * 
						 */
						
			
						
						
						$this->session->set_userdata($datosUsuario);
						
						if($this->session->userdata('tipoUsuario') == 'ALUMNO'){
							
							//redirect('ControladorInicioAlumno/index');
							//$this->load->view('alumno/VistaInicio');
							
							$confirmacion = 'exitosa';
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
