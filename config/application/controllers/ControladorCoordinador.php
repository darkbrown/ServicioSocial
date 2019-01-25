<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorCoordinador extends CI_Controller {

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
		$alumnos['listaAlumnos'] = $this->ModeloAlumno->obtenerAlumnos();
		$this->load->view('coordinador/EncabezadoCoordinador');
		$this->load->view('coordinador/VistaListaAlumnos', $alumnos);
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
		$this->load->model('ModeloAlumno'); 
		$this->load->model('ModeloUsuario'); 
        if($this->input->post()){
            $datosAlumno = array(
                'nombre' => strtoupper($this->input->post('nombre')),
				'apellidos' => strtoupper($this->input->post('apellidos')),
				'matricula' => strtoupper($this->input->post('matricula')),				
                'bloque' => $this->input->post('bloque'),
                'seccion' => $this->input->post('seccion'),              
                'telefono' => $this->input->post('telefono')
			);
			$datosUsuario = array(
				'correo' => strtoupper($this->input->post('correo'))
			);
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
			$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
			$this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
            $this->form_validation->set_rules('bloque', 'Bloque', 'trim|required|numeric');
            $this->form_validation->set_rules('seccion', 'Seccion', 'trim|required|numeric');
            $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|numeric');

            if($this->form_validation->run() == TRUE){
				if($this->ModeloAlumno->verificarMatricula($datosAlumno['matricula']) == '1'){
					$idUsuario = $this->ModeloAlumno->obtenerIdUsuario($datosAlumno['matricula']);
					if($this->ModeloUsuario->comprobarMismoCorreo($datosUsuario['correo'], $idUsuario) == '1'){
						$modificacionAlumno = $this->ModeloAlumno->modificarAlumno($datosAlumno);
						if($modificacionAlumno == true){
							$confirmacion = true;
						}else{
							$confirmacion = false;
						}
					}else{
						if($this->ModeloUsuario->verificarCorreo($datosUsuario['correo']) == '0'){
							$this->ModeloAlumno->modificarAlumno($datosAlumno);
							$modificacionUsuario = $this->ModeloUsuario->modificarUsuario($datosUsuario, $idUsuario);
								if($modificacionUsuario == true){
									$confirmacion = true;
								}else{
									$confirmacion = 'errorCorreo';
								}							
						}else{
							$confirmacion = "yaExisteCorreo";
						}
					}
				}else{
					$confirmacion = "matriculaInvalida";
				}
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
		
		if(strlen($matricula) == 9){
			$datos['matricula'] = $matricula;
			$this->load->view('coordinador/EncabezadoCoordinador');
			$this->load->view('coordinador/VistaModificarMatricula', $datos);			
		}else{
			echo "LOS DATOS NO SE RECIBIERON CORRECTAMENTE O LA MATRÍCULA ES INVÁLIDA";
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

	public function cambiarContrasenaAlumno($matricula)
	{
		$matricula = base64_decode(urldecode($matricula));
		
		if(strlen($matricula) == 9){
			$datos['matricula'] = $matricula;
			$this->load->view('coordinador/EncabezadoCoordinador');
			$this->load->view('coordinador/VistaModificarContrasenaAlumno', $datos);		
		}else{
			echo "LOS DATOS NO SE RECIBIERON CORRECTAMENTE O LA MATRÍCULA ES INVÁLIDA";
		}	
		
	}


	public function modificarContrasenaAlumno()
	{		
		$confirmacion = "";
        
        if($this->input->post()){
			$this->load->model('ModeloAlumno'); 
			$this->load->model('ModeloUsuario'); 
            $matricula = strtoupper($this->input->post('matricula'));
			$contrasena1 = strtoupper($this->input->post('contrasena1'));
			$contrasena2 = strtoupper($this->input->post('contrasena2'));
            $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
			$this->form_validation->set_rules('contrasena1', 'Contrasena1', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('contrasena2', 'Contrasena2', 'trim|required|matches[contrasena1]');
            if($this->form_validation->run() == TRUE){	
				if($this->ModeloAlumno->verificarMatricula($matricula) == "1"){
					$idUsuario = $this->ModeloAlumno->obtenerIdUsuario($matricula);
					$usuario = $this->ModeloUsuario->obtenerContrasena($idUsuario);
					if(count($usuario) > 0){
						$contrasenaNueva = hash("sha256", $contrasena1);
						if($usuario[0]['contrasena'] != $contrasenaNueva){
							$datosUsuario = array(
								'contrasena' => $contrasenaNueva
							);
							$confirmacion = $this->ModeloUsuario->modificarUsuario($datosUsuario, $idUsuario);
						}else{
							$confirmacion = true;
						}
					}else{
						$confirmacion = "noExiste";
					}
				}else{
					$confirmacion = "matriculaInvalida";
				}	
            }else{
                $confirmacion = "datosInvalidos";
            }
        }else{
            $confirmacion = "vacio";
        }

        echo $confirmacion;
	}


	public function modificarEstatusAlumno()
	{
		$confirmacion = "";
		if($this->input->post()){
			$this->load->model('ModeloAlumno'); 
			$this->load->model('ModeloUsuario'); 
            $matricula = strtoupper($this->input->post('matricula'));
            $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
            if($this->form_validation->run() == TRUE){	
				if($this->ModeloAlumno->verificarMatricula($matricula) == "1"){
					$idUsuario = $this->ModeloAlumno->obtenerIdUsuario($matricula);
					$usuario = $this->ModeloUsuario->obtenerEstatus($idUsuario);
					if(count($usuario) > 0){
						if($usuario[0]['estatus'] == 'ACTIVO'){
							$datosUsuario = array(
								'estatus' => 'SUSPENDIDO'
							);
							$confirmacion = $this->ModeloUsuario->modificarUsuario($datosUsuario, $idUsuario);
						}elseif($usuario[0]['estatus'] == 'SUSPENDIDO'){
							$datosUsuario = array(
								'estatus' => 'ACTIVO'
							);
							$confirmacion = $this->ModeloUsuario->modificarUsuario($datosUsuario, $idUsuario);
						}
					}else{
						$confirmacion = "noExiste";
					}
				}else{
					$confirmacion = "matriculaInvalida";
				}	
            }else{
                $confirmacion = "datosInvalidos";
            }
        }else{
            $confirmacion = "vacio";
        }

        echo $confirmacion;
	}

	public function consultarAlumno($matricula)
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
				$this->load->view('coordinador/VistaConsultarAlumno', $datos);
			}else{
				echo "RECURSO NO DISPONIBLE PARA EDICIÓN";
			}
		}else{
			echo "LOS DATOS NO SE RECIBIERON CORRECTAMENTE";
		}	
	}

	public function formularioAlumno()
    {
        $this->load->view('coordinador/EncabezadoCoordinador');
		$this->load->view('coordinador/VistaRegistrarAlumnoCoordinador');
    }

    public function registrarAlumnoCoordinador()
    {
        $confirmacion = "";
        
        if($this->input->post()){
            $alumno = array(
                'nombre' => strtoupper($this->input->post('nombre')),
                'apellidos' => strtoupper($this->input->post('apellidos')),
                'matricula' => strtoupper($this->input->post('matricula')),
                'bloque' => $this->input->post('bloque'),
                'seccion' => $this->input->post('seccion'),               
                'telefono' => $this->input->post('telefono')
            );
            $contrasena = $this->input->post('contrasena');
            $usuario = array(                
                'correo' => strtoupper($this->input->post('correo'))
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
                $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email|is_unique[usuario.correo]');
                if($this->form_validation->run() == TRUE){
                    $this->load->model('ModeloUsuario');                   
                    $usuario['contrasena'] = hash("sha256", $contrasena);
                    $usuario['tipo'] = 'ALUMNO';
                    $usuario['estatus'] = 'ACTIVO';
                    $resultado = $this->ModeloUsuario->registrarUsuario($usuario);
                    if($resultado['respuesta'] == '1'){
                        $alumno['Usuario_idUsuario'] = $resultado['idUsuario'];
                        $this->load->model('ModeloAlumno');                        
                        $confirmacion = $this->ModeloAlumno->registrarAlumno($alumno);                           
                    }else{
                        $confirmacion = "error";
                    }
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