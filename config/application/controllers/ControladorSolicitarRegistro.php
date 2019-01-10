<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorSolicitarRegistro extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
    
    }

	public function index()
	{
        $this->load->view('EncabezadoVacio');
		$this->load->view('VistaSolicitarRegistro');
    }
    

    public function registrarAlumno()
    {
        $this->load->view('EncabezadoVacio');
		$this->load->view('alumno/VistaRegistrarAlumno');
    }
}
?>