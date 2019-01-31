<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorAlumno extends CI_Controller {


	public function index()
	{
        $this->load->view('alumno/EncabezadoAlumno');
		
    }

	//Utiliza Coordinador y Alumno
    public function formularioAlumno($usuario)
    {
        if($usuario == 'nuevo'){
            $this->load->view('EncabezadoVacio');
        }elseif($usuario =='coordinador'){
            $this->load->view('coordinador/EncabezadoCoordinador');
        }      
		$this->load->view('registro/VistaRegistrarAlumno');
    }

	//Utiliza Coordinador y Alumno
    public function registrarAlumno()
    {
		$this->load->model('ModeloUsuario');  
		$this->load->model('ModeloAlumno'); 
        $confirmacion = "";
        if($this->input->post()){
            $usuarioActual = $this->input->post('usuarioActual');
            if($usuarioActual == 'SS: Coordinador'){
                $confirmacion = 'coordinador';
            }elseif($usuarioActual == 'LIS | ServicioSocial'){
                $confirmacion = 'nuevo';
            }else{
                $confirmacion = 'datosInvalidos';
            }
        
            $alumno = array(
                'nombreAlumno' => mb_strtoupper($this->input->post('nombre')),
                'apellidosAlumno' => mb_strtoupper($this->input->post('apellidos')),
                'matriculaAlumno' => mb_strtoupper($this->input->post('matricula')),
                'bloqueAlumno' => $this->input->post('bloque'),
                'seccionAlumno' => $this->input->post('seccion'),               
                'telefonoAlumno' => $this->input->post('telefono')
            );
            $contrasena = $this->input->post('contrasena');
            $usuario = array(                
                'correoUsuario' => mb_strtoupper($this->input->post('correo')),
                'tipoUsuario' => 'ALUMNO',
                'contrasenaUsuario' => hash("sha256", $contrasena),
                'estatusUsuario' => 'ACTIVO'
            );
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|max_length[60]');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|max_length[60]');
            $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
            $this->form_validation->set_rules('matricula2', 'Matricula2', 'trim|required|matches[matricula]');
            $this->form_validation->set_rules('bloque', 'Bloque', 'trim|required|numeric|max_length[2]');
            $this->form_validation->set_rules('seccion', 'Seccion', 'trim|required|numeric|max_length[2]');
            $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email|max_length[320]');
            $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('contrasena', 'Contrasena', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('contrasena2', 'Contrasena2', 'trim|required|matches[contrasena]');
            if($this->form_validation->run() == TRUE && $confirmacion != 'datosInvalidos'){
                $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]|is_unique[alumno.matriculaAlumno]');
                $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email|is_unique[usuario.correoUsuario]');
                if($this->form_validation->run() == TRUE){                              
                    $resultado = $this->ModeloUsuario->registrarUsuario($usuario);
                    if($resultado['respuesta'] == '1'){
                        $alumno['Usuario_idUsuario'] = $resultado['idUsuario'];                                           
                        $this->ModeloAlumno->registrarAlumno($alumno);                           
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
            $confirmacion = "vacio";
        }

        echo $confirmacion;
    }

	//Utiliza Coordinador
    public function listaAlumnos()
	{
		$this->load->model('ModeloAlumno');
		$alumnos['listaAlumnos'] = $this->ModeloAlumno->obtenerAlumnos();
		$this->load->view('coordinador/EncabezadoCoordinador');
		$this->load->view('coordinador/VistaListaAlumnos', $alumnos);
	}

	//Utiliza Coordinador
	public function editarAlumno($matricula)
	{
		$matricula = base64_decode(urldecode($matricula));
		
		if(strlen($matricula) <= 9 && strlen($matricula) > 0){
			$this->load->model('ModeloAlumno');
			$alumno =  $this->ModeloAlumno->obtenerAlumno($matricula);
			
			if($alumno){
				$datos = array(
					'nombre' => $alumno['nombreAlumno'],
					'apellidos' => $alumno['apellidosAlumno'],
					'matricula' => $alumno['matriculaAlumno'],
					'bloque' => $alumno['bloqueAlumno'],
					'seccion' => $alumno['seccionAlumno'],
					'correo' => $alumno['correoUsuario'],
					'telefono' => $alumno['telefonoAlumno'],
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

	//Utiliza Coordinador
	public function modificarAlumno()
	{
		$confirmacion = "";
		$this->load->model('ModeloAlumno'); 
		$this->load->model('ModeloUsuario'); 
        if($this->input->post()){
            $datosAlumno = array(
                'nombreAlumno' => mb_strtoupper($this->input->post('nombre')),
				'apellidosAlumno' => mb_strtoupper($this->input->post('apellidos')),
				'matriculaAlumno' => mb_strtoupper($this->input->post('matricula')),				
                'bloqueAlumno' => $this->input->post('bloque'),
                'seccionAlumno' => $this->input->post('seccion'),              
                'telefonoAlumno' => $this->input->post('telefono')
			);
			$datosUsuario = array(
				'correoUsuario' => mb_strtoupper($this->input->post('correo'))
			);
            $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
			$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required');
			$this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
            $this->form_validation->set_rules('bloque', 'Bloque', 'trim|required|numeric');
            $this->form_validation->set_rules('seccion', 'Seccion', 'trim|required|numeric');
            $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
            $this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|numeric');

            if($this->form_validation->run() == TRUE){
				if($this->ModeloAlumno->verificarMatricula($datosAlumno['matriculaAlumno']) == '1'){
					$idUsuario = $this->ModeloAlumno->obtenerIdUsuario($datosAlumno['matriculaAlumno']);
					if($this->ModeloUsuario->comprobarMismoCorreo($datosUsuario['correoUsuario'], $idUsuario) == '1'){
						$modificacionAlumno = $this->ModeloAlumno->modificarAlumno($datosAlumno);
						if($modificacionAlumno == true){
							$confirmacion = true;
						}else{
							$confirmacion = false;
						}
					}else{
						if($this->ModeloUsuario->verificarCorreo($datosUsuario['correoUsuario']) == '0'){
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

	//Utiliza Coordinador
	public function cambiarMatricula($matricula)
	{
		$matricula = base64_decode(urldecode($matricula));
		$this->load->model('ModeloAlumno');
		if(strlen($matricula) == 9){		
			$alumno =  $this->ModeloAlumno->obtenerAlumno($matricula);
			if($alumno){
				$datos['matricula'] = mb_strtoupper($matricula);
				$this->load->view('coordinador/EncabezadoCoordinador');
				$this->load->view('coordinador/VistaModificarMatricula', $datos);
			}else{
				echo "RECURSO NO DISPONIBLE PARA EDICIÓN";
			}			
		}else{
			echo "LOS DATOS NO SE RECIBIERON CORRECTAMENTE O LA MATRÍCULA ES INVÁLIDA";
		}	
	}

	//Utiliza Coordinador
	public function modificarMatricula()
	{		
		$confirmacion = "";
        
        if($this->input->post()){
			$this->load->model('ModeloAlumno'); 
            $matriculaAnterior = mb_strtoupper($this->input->post('matriculaAnterior'));
			$matriculaNueva = mb_strtoupper($this->input->post('matriculaNueva'));
			$matriculaNueva2 = mb_strtoupper($this->input->post('matriculaNueva2'));
            $this->form_validation->set_rules('matriculaAnterior', 'MatriculaAnterior', 'trim|required|min_length[9]|max_length[9]');
			$this->form_validation->set_rules('matriculaNueva', 'MatriculaNueva', 'trim|required|min_length[9]|max_length[9]');
			$this->form_validation->set_rules('matriculaNueva2', 'MatriculaNueva2', 'trim|required|min_length[9]|max_length[9]|matches[matriculaNueva]');			
            if($this->form_validation->run() == TRUE){	
				if($matriculaAnterior != $matriculaNueva){											
					if($this->ModeloAlumno->verificarMatricula($matriculaNueva) == "0"){ 
						$nueva = array(
							'matriculaAlumno' => $matriculaNueva
						);     
						$confirmacion = $this->ModeloAlumno->modificarMatricula($matriculaAnterior, $nueva);
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

	//Utiliza Coordinador
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

	//Utiliza Coordinador
	public function modificarContrasenaAlumno()
	{		
		$confirmacion = "";
        
        if($this->input->post()){
			$this->load->model('ModeloAlumno'); 
			$this->load->model('ModeloUsuario'); 
            $matricula = mb_strtoupper($this->input->post('matricula'));
			$contrasena1 = $this->input->post('contrasena1');
			$contrasena2 = $this->input->post('contrasena2');
            $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
			$this->form_validation->set_rules('contrasena1', 'Contrasena1', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('contrasena2', 'Contrasena2', 'trim|required|matches[contrasena1]');
            if($this->form_validation->run() == TRUE){	
				if($this->ModeloAlumno->verificarMatricula($matricula) == "1"){
					$idUsuario = $this->ModeloAlumno->obtenerIdUsuario($matricula);
					$usuario = $this->ModeloUsuario->obtenerContrasena($idUsuario);
					if($usuario){
						$contrasenaNueva = hash("sha256", $contrasena1);
						if($usuario['contrasenaUsuario'] != $contrasenaNueva){
							$datosUsuario = array(
								'contrasenaUsuario' => $contrasenaNueva
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

	//Utiliza Coordinador
	public function modificarEstatusAlumno()
	{
		$confirmacion = "";
		if($this->input->post()){
			$this->load->model('ModeloAlumno'); 
			$this->load->model('ModeloUsuario'); 
            $matricula = mb_strtoupper($this->input->post('matricula'));
            $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]');
            if($this->form_validation->run() == TRUE){	
				if($this->ModeloAlumno->verificarMatricula($matricula) == "1"){
					$idUsuario = $this->ModeloAlumno->obtenerIdUsuario($matricula);
					$usuario = $this->ModeloUsuario->obtenerEstatus($idUsuario);
					if($usuario){
						if($usuario['estatusUsuario'] == 'ACTIVO'){
							$datosUsuario = array(
								'estatusUsuario' => 'SUSPENDIDO'
							);
							$confirmacion = $this->ModeloUsuario->modificarUsuario($datosUsuario, $idUsuario);
						}elseif($usuario['estatusUsuario'] == 'SUSPENDIDO'){
							$datosUsuario = array(
								'estatusUsuario' => 'ACTIVO'
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

	//Utiliza Coordinador
	public function consultarAlumno($matricula)
	{
		$matricula = base64_decode(urldecode($matricula));
		
		if(strlen($matricula) <= 9 && strlen($matricula) > 0){
			$this->load->model('ModeloAlumno');
			$alumno =  $this->ModeloAlumno->obtenerAlumno($matricula);		
			if($alumno){
				$datos = array(
					'nombre' => $alumno['nombreAlumno'],
					'apellidos' => $alumno['apellidosAlumno'],
					'matricula' => $alumno['matriculaAlumno'],
					'bloque' => $alumno['bloqueAlumno'],
					'seccion' => $alumno['seccionAlumno'],
					'correo' => $alumno['correoUsuario'],
					'telefono' => $alumno['telefonoAlumno']
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



}
?>