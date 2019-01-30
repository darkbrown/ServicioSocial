<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'ControladorIniciarSesion';

/**ESTOS ROUTES ESTAN ORDENADOS DE ACUERDO A LOS QUE USA CADA USUARIO */

/** REGISTRO E INICIO DE SESIÓN*/
$route['iniciarSesion'] = 'ControladorIniciarSesion/iniciarSesion';
$route['tipoCuenta'] = '/ControladorIniciarSesion/seleccionarNuevaCuenta';

$route['FormularioAlumno/(:any)'] = 'ControladorAlumno/formularioAlumno/$1';//+Coordinador
$route['FormularioDependencia'] = 'ControladorResponsable/formularioDependencia';

$route['RegistrarAlumno'] = '/ControladorAlumno/registrarAlumno'; //+Coordinador
$route['RegistrarDependencia'] = '/ControladorResponsable/registrarDependencia';



/**COORDINADOR */
$route['Coordinador'] = 'ControladorCoordinador/index';
$route['FormularioAlumnoCoordinador'] = 'ControladorAlumno/formularioAlumno';
$route['Alumnos'] = 'ControladorAlumno/listaAlumnos';
$route['Responsables'] = 'ControladorCoordinador/listaResponsables';
$route['EditarAlumno/(:any)'] = 'ControladorAlumno/editarAlumno/$1';
$route['ConsultarAlumno/(:any)'] = 'ControladorAlumno/consultarAlumno/$1';
$route['CambiarMatricula/(:any)'] = 'ControladorAlumno/cambiarMatricula/$1';
$route['ModificarMatricula'] = 'ControladorAlumno/modificarMatricula';
$route['CambiarContrasenaAlumno/(:any)'] = 'ControladorAlumno/cambiarContrasenaAlumno/$1';
$route['ModificarContrasenaAlumno'] = 'ControladorAlumno/modificarContrasenaAlumno';
$route['ModificarAlumno'] = 'ControladorAlumno/modificarAlumno';
$route['ModificarEstatusAlumno'] = 'ControladorAlumno/modificarEstatusAlumno';

/** ALUMNO */
$route['inicioAlumno'] = 'ControladorAlumno/index';


/**OTROS */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
