<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorResponsable extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper('url_helper');
    }

	public function index()
	{
		//AQUI VA SU VENTANA DE INICIO
	}

	public function formularioResponsable($usuario)
    {
        if($usuario == 'nuevo'){
            $this->load->view('EncabezadoVacio');
        }elseif($usuario =='coordinador'){
            $this->load->view('coordinador/EncabezadoCoordinador');
        }  
		$this->load->view('registro/VistaRegistrarResponsable');
    }

    //Se registra la dependencia y el responsable
    public function registrarResponsable()
    {
        $confirmacion = "";
        
        if($this->input->post()){
            $usuarioActual = $this->input->post('usuarioActual');
            if($usuarioActual == 'SS: Coordinador'){
                $confirmacion = 'coordinador';
            }elseif($usuarioActual == 'LIS | ServicioSocial'){
                $confirmacion = 'nuevo';
            }else{
                $confirmacion = "datosInvalidos";
            }

            $this->load->model('ModeloUsuario');
            $this->load->model('ModeloResponsable'); 
            $this->load->model('ModeloDependencia');        

            $dependencia = array(
                'nombreDependencia' => mb_strtoupper($this->input->post('nombreDependencia')),
                'sectorDependencia' => mb_strtoupper($this->input->post('sectorDependencia')),
                'telefonoDependencia' => $this->input->post('telefonoDependencia'),
                'extensionDependencia' => $this->input->post('extDependencia'),
                'correoDependencia' => mb_strtoupper($this->input->post('correoDependencia')),
                'estadoRepublicaDependencia' => mb_strtoupper($this->input->post('estadoRepublica')),
                'codigoPostalDependencia' => $this->input->post('cpDependencia'),
                'ciudadDependencia' => mb_strtoupper($this->input->post('ciudadDependencia')),
                'direccionDependencia' => mb_strtoupper($this->input->post('direccionDependencia')),
                'numExteriorDependencia' => $this->input->post('numExterior'),
                'numInteriorDependencia' => $this->input->post('numInterior'),
                'usuariosDirectosDependencia' => $this->input->post('usuariosDirectos'),
                'usuariosIndirectosDependencia' => $this->input->post('usuariosIndirectos')
            );

            $responsable = array(
                'nombreResponsable' => mb_strtoupper($this->input->post('nombreResponsable')),
                'apellidosResponsable' => mb_strtoupper($this->input->post('apellidosResponsable')),
                'cargoResponsable' => mb_strtoupper($this->input->post('cargoResponsable')),
                'telefonoResponsable' => $this->input->post('telefonoResponsable'),
                'extensionResponsable' => $this->input->post('extResponsable')
            );
            $contrasena = $this->input->post('contrasenaResponsable1');
            $usuario = array(                
                'correoUsuario' => mb_strtoupper($this->input->post('correoResponsable1')),
                'contrasenaUsuario' => hash("sha256", $contrasena),
                'tipoUsuario' => 'RESPONSABLE',
                'estatusUsuario' => 'ACTIVO'
            );
            $this->form_validation->set_rules('nombreDependencia', 'NombreDependencia', 'trim|required|max_length[350]');
            $this->form_validation->set_rules('sectorDependencia', 'SectorDependencia', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('telefonoDependencia', 'TelefonoDependencia', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('extDependencia', 'ExtDependencia', 'trim|numeric|max_length[30]');
            $this->form_validation->set_rules('correoDependencia', 'CorreoDependencia', 'trim|required|valid_email|max_length[320]');
            $this->form_validation->set_rules('estadoRepublica', 'EstadoRepublica', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('cpDependencia', 'CpDependencia', 'trim|required|numeric|exact_length[5]');
            $this->form_validation->set_rules('ciudadDependencia', 'CiudadDependencia', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('direccionDependencia', 'DireccionDependencia', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('numExterior', 'NumExterior', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('numInterior', 'NumInterior', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('usuariosDirectos', 'UsuariosDirectos', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('usuariosIndirectos', 'UsuariosIndirectos', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('nombreResponsable', 'NombreResponsable', 'trim|required|max_length[60]');
            $this->form_validation->set_rules('apellidosResponsable', 'ApellidosResponsable', 'trim|required|max_length[60]');
            $this->form_validation->set_rules('cargoResponsable', 'CargoResponsable', 'trim|required|max_length[120]');
            $this->form_validation->set_rules('telefonoResponsable', 'TelefonoResponsable', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('extResponsable', 'ExtResponsable', 'trim|numeric|max_length[30]');
            $this->form_validation->set_rules('correoResponsable1', 'CorreoResponsable1', 'trim|required|valid_email|max_length[320]');
            $this->form_validation->set_rules('correoResponsable2', 'CorreoResponsable2', 'trim|required|matches[correoResponsable1]');
            $this->form_validation->set_rules('contrasenaResponsable1', 'ContrasenaResponsable1', 'trim|required|min_length[6]|max_length[15]');
            $this->form_validation->set_rules('contrasenaResponsable2', 'ContrasenaResponsable2', 'trim|required|matches[contrasenaResponsable1]');

            if($this->form_validation->run() == TRUE){
            
                if($this->ModeloUsuario->verificarCorreo($usuario['correoUsuario']) == '0'){                         
                    $resultado = $this->ModeloUsuario->registrarUsuario($usuario);
                    if($resultado['respuesta'] == '1'){
                        $responsable['Usuario_idUsuario'] = $resultado['idUsuario'];
                        $dependencia['Responsable_idUsuario'] = $resultado['idUsuario'];
                        $this->ModeloResponsable->registrarResponsable($responsable);                   
                        $this->ModeloDependencia->registrarDependencia($dependencia);                           
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

    //Utiliza Coordinador
    public function listaResponsables()
	{
		$this->load->model('ModeloResponsable');
		$responsables['listaResponsables'] = $this->ModeloResponsable->obtenerResponsables();
		$this->load->view('coordinador/EncabezadoCoordinador');
		$this->load->view('coordinador/VistaListaResponsables', $responsables);
    }
    
    //Utiliza Coordinador
    public function editarResponsable($correo)
    {
        $correo = base64_decode(urldecode($correo));
		
		if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
			$this->load->model('ModeloResponsable');
			$responsable =  $this->ModeloResponsable->obtenerResponsable($correo);
		   
			if($responsable){
                $datos = array(
                    'nombreDependencia' => $responsable['nombreDependencia'],
                    'sectorDependencia' => $responsable['sectorDependencia'],
                    'telefonoDependencia' => $responsable['telefonoDependencia'],
                    'extensionDependencia' => $responsable['extensionDependencia'],
                    'correoDependencia' => $responsable['correoDependencia'],
                    'estadoRepublicaDependencia' => $responsable['estadoRepublicaDependencia'],
                    'codigoPostalDependencia' => $responsable['codigoPostalDependencia'],
                    'ciudadDependencia' => $responsable['ciudadDependencia'],
                    'direccionDependencia' => $responsable['direccionDependencia'],
                    'numExteriorDependencia' => $responsable['numExteriorDependencia'],
                    'numInteriorDependencia' => $responsable['numInteriorDependencia'],
                    'usuariosDirectosDependencia' => $responsable['usuariosDirectosDependencia'],
                    'usuariosIndirectosDependencia' => $responsable['usuariosIndirectosDependencia'],
                    'nombreResponsable' => $responsable['nombreResponsable'],
                    'apellidosResponsable' => $responsable['apellidosResponsable'],
                    'cargoResponsable' => $responsable['cargoResponsable'],
                    'telefonoResponsable' => $responsable['telefonoResponsable'],
                    'extensionResponsable' => $responsable['extensionResponsable'],
                    'correoResponsable' => $responsable['correoUsuario']
                );
				$this->load->view('coordinador/EncabezadoCoordinador');
		        $this->load->view('coordinador/VistaEditarResponsable', $datos);
			}else{
				echo "RECURSO NO DISPONIBLE PARA EDICIÓN";
			}
		}else{
			echo "LOS DATOS NO SE RECIBIERON CORRECTAMENTE";
		}	
        
    }

    public function modificarResponsable()
    {
        $confirmacion = "";
        $this->load->model('ModeloUsuario');
        $this->load->model('ModeloResponsable'); 
        $this->load->model('ModeloDependencia');

        if($this->input->post()){
            $dependencia = array(
                'nombreDependencia' => mb_strtoupper($this->input->post('nombreDependencia')),
                'sectorDependencia' => mb_strtoupper($this->input->post('sectorDependencia')),
                'telefonoDependencia' => $this->input->post('telefonoDependencia'),
                'extensionDependencia' => $this->input->post('extDependencia'),
                'correoDependencia' => mb_strtoupper($this->input->post('correoDependencia')),
                'estadoRepublicaDependencia' => mb_strtoupper($this->input->post('estadoRepublica')),
                'codigoPostalDependencia' => $this->input->post('cpDependencia'),
                'ciudadDependencia' => mb_strtoupper($this->input->post('ciudadDependencia')),
                'direccionDependencia' => mb_strtoupper($this->input->post('direccionDependencia')),
                'numExteriorDependencia' => $this->input->post('numExterior'),
                'numInteriorDependencia' => $this->input->post('numInterior'),
                'usuariosDirectosDependencia' => $this->input->post('usuariosDirectos'),
                'usuariosIndirectosDependencia' => $this->input->post('usuariosIndirectos')
            );

            $responsable = array(
                'nombreResponsable' => mb_strtoupper($this->input->post('nombreResponsable')),
                'apellidosResponsable' => mb_strtoupper($this->input->post('apellidosResponsable')),
                'cargoResponsable' => mb_strtoupper($this->input->post('cargoResponsable')),
                'telefonoResponsable' => $this->input->post('telefonoResponsable'),
                'extensionResponsable' => $this->input->post('extResponsable')
            );
            $usuario = array(                
                'correoUsuario' => mb_strtoupper($this->input->post('correoResponsable1')),
            );

            $correoActual = mb_strtoupper($this->input->post('correoActual'));

            $this->form_validation->set_rules('nombreDependencia', 'NombreDependencia', 'trim|required|max_length[350]');
            $this->form_validation->set_rules('sectorDependencia', 'SectorDependencia', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('telefonoDependencia', 'TelefonoDependencia', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('extDependencia', 'ExtDependencia', 'trim|numeric|max_length[30]');
            $this->form_validation->set_rules('correoDependencia', 'CorreoDependencia', 'trim|required|valid_email|max_length[320]');
            $this->form_validation->set_rules('estadoRepublica', 'EstadoRepublica', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('cpDependencia', 'CpDependencia', 'trim|required|numeric|exact_length[5]');
            $this->form_validation->set_rules('ciudadDependencia', 'CiudadDependencia', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('direccionDependencia', 'DireccionDependencia', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('numExterior', 'NumExterior', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('numInterior', 'NumInterior', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('usuariosDirectos', 'UsuariosDirectos', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('usuariosIndirectos', 'UsuariosIndirectos', 'trim|required|numeric|max_length[20]');
            $this->form_validation->set_rules('nombreResponsable', 'NombreResponsable', 'trim|required|max_length[60]');
            $this->form_validation->set_rules('apellidosResponsable', 'ApellidosResponsable', 'trim|required|max_length[60]');
            $this->form_validation->set_rules('cargoResponsable', 'CargoResponsable', 'trim|required|max_length[120]');
            $this->form_validation->set_rules('telefonoResponsable', 'TelefonoResponsable', 'trim|required|numeric|max_length[30]');
            $this->form_validation->set_rules('extResponsable', 'ExtResponsable', 'trim|numeric|max_length[30]');
            $this->form_validation->set_rules('correoResponsable1', 'CorreoResponsable1', 'trim|required|valid_email|max_length[320]');
            $this->form_validation->set_rules('correoResponsable2', 'CorreoResponsable2', 'trim|required|matches[correoResponsable1]');

            if($this->form_validation->run() == TRUE){
                if($this->ModeloUsuario->verificarCorreo($correoActual) == '1'){
                    $idUsuario = $this->ModeloUsuario->obtenerIdUsuario($correoActual);
                    /**Si es el mismo correo solo guarda los otros datos y si no comprueba que el nuevo correo no exista */
                    if($this->ModeloUsuario->comprobarMismoCorreo($usuario['correoUsuario'], $idUsuario) == '1'){
                        $estatusModificarDependencia = $this->ModeloDependencia->modificarDependencia($dependencia, $idUsuario);
                        $estatusModificarResponsable = $this->ModeloResponsable->modificarResponsable($responsable, $idUsuario);
						if($estatusModificarResponsable == true || $estatusModificarDependencia == true){
							$confirmacion = true;
						}else{
							$confirmacion = false;
						}
					}else{
						if($this->ModeloUsuario->verificarCorreo($usuario['correoUsuario']) == '0'){
                            $estatusModificarDependencia = $this->ModeloDependencia->modificarDependencia($dependencia, $idUsuario);
                            $estatusModificarResponsable = $this->ModeloResponsable->modificarResponsable($responsable, $idUsuario);
                            $estatusModificarUsuario = $this->ModeloUsuario->modificarUsuario($usuario, $idUsuario);
							if($estatusModificarDependencia == true || $estatusModificarResponsable == true || $estatusModificarUsuario == true){
								$confirmacion = true;
							}else{
								$confirmacion = 'errorCorreo';
							}							
						}else{
							$confirmacion = "yaExiste";
						}
					}
                }else{
					$confirmacion = "correoInvalido";
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