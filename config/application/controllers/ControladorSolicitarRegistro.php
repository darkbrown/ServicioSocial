<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorSolicitarRegistro extends CI_Controller {


	public function index()
	{
        $this->load->view('EncabezadoVacio');
		$this->load->view('registro/VistaSolicitarRegistro');
    }
    

    public function formularioAlumno($usuario)
    {
        if($usuario == 'nuevo'){
            $this->load->view('EncabezadoVacio');
        }elseif($usuario =='coordinador'){
            $this->load->view('coordinador/EncabezadoCoordinador');
        }      
		$this->load->view('registro/VistaRegistrarAlumno');
    }

    public function registrarAlumno()
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
        
            $alumno = array(
                'nombre' => mb_strtoupper($this->input->post('nombre')),
                'apellidos' => mb_strtoupper($this->input->post('apellidos')),
                'matricula' => mb_strtoupper($this->input->post('matricula')),
                'bloque' => $this->input->post('bloque'),
                'seccion' => $this->input->post('seccion'),               
                'telefono' => $this->input->post('telefono')
            );
            $contrasena = $this->input->post('contrasena');
            $usuario = array(                
                'correo' => mb_strtoupper($this->input->post('correo')),
                'tipo' => 'ALUMNO',
                'contrasena' => hash("sha256", $contrasena),
                'estatus' => 'ACTIVO'
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
                $this->form_validation->set_rules('matricula', 'Matricula', 'trim|required|min_length[9]|max_length[9]|is_unique[alumno.matricula]');
                $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email|is_unique[usuario.correo]');
                if($this->form_validation->run() == TRUE){
                    $this->load->model('ModeloUsuario');                   
                    $resultado = $this->ModeloUsuario->registrarUsuario($usuario);
                    if($resultado['respuesta'] == '1'){
                        $alumno['Usuario_idUsuario'] = $resultado['idUsuario'];
                        $this->load->model('ModeloAlumno');                        
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
            $confirmacion =  "vacio";
        }

        echo $confirmacion;
    }

    public function formularioDependencia()
    {
        $this->load->view('EncabezadoVacio');
		$this->load->view('registro/VistaRegistrarDependencia');
    }

    public function registrarDependencia()
    {
        $confirmacion = "";
        
        if($this->input->post()){
            $this->load->model('ModeloUsuario');
            $this->load->model('ModeloResponsable'); 
            $this->load->model('ModeloDependencia');        

            $dependencia = array(
                'nombre' => strtoupper($this->input->post('nombreDependencia')),
                'sector' => strtoupper($this->input->post('sectorDependencia')),
                'telefono' => $this->input->post('telefonoDependencia'),
                'extension' => $this->input->post('extDependencia'),
                'correo' => strtoupper($this->input->post('correoDependencia')),
                'estadoRepublica' => strtoupper($this->input->post('estadoRepublica')),
                'codigoPostal' => $this->input->post('cpDependencia'),
                'ciudad' => strtoupper($this->input->post('ciudadDependencia')),
                'direccion' => strtoupper($this->input->post('direccionDependencia')),
                'numExterior' => $this->input->post('numExterior'),
                'numInterior' => $this->input->post('numInterior'),
                'usuariosDirectos' => $this->input->post('usuariosDirectos'),
                'usuariosIndirectos' => $this->input->post('usuariosIndirectos')
            );

            $responsable = array(
                'nombre' => strtoupper($this->input->post('nombreResponsable')),
                'apellidos' => strtoupper($this->input->post('apellidosResponsable')),
                'cargo' => strtoupper($this->input->post('cargoResponsable')),
                'telefono' => $this->input->post('telefonoResponsable'),
                'extension' => $this->input->post('extResponsable')
            );
            $contrasena = $this->input->post('contrasenaResponsable1');
            $usuario = array(                
                'correo' => strtoupper($this->input->post('correoResponsable1')),
                'contrasena' => hash("sha256", $contrasena),
                'tipo' => 'RESPONSABLE',
                'estatus' => 'ACTIVO'
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
            
                if($this->ModeloUsuario->verificarCorreo($usuario['correo']) == '0'){                         
                    $resultado = $this->ModeloUsuario->registrarUsuario($usuario);
                    if($resultado['respuesta'] == '1'){
                        $responsable['Usuario_idUsuario'] = $resultado['idUsuario'];
                        $dependencia['Responsable_idUsuario'] = $resultado['idUsuario'];
                        $this->ModeloResponsable->registrarResponsable($responsable);                   
                        $confirmacion = $this->ModeloDependencia->registrarDependencia($dependencia);                           
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
?>