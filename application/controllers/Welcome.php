<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('Estudiante/ArcadiaLogin.html');
	}

	public function registro()
	{
		$this->load->model('Datos/dao_estudiante_model');
		$this->load->model('Datos/dao_clase_model');
		$this->load->model('clase_model');
		$data['clases']=$this->dao_clase_model->obtenerClases();
		$data['avatares']=$this->dao_estudiante_model->avatarEst();
		$data['clases'] = $this->dao_clase_model->anexarAvatares($data['avatares'],$data['clases']);
		$this->load->view('Estudiante/Registro_Estudiante',$data);
	}

	public function loginProfesor(){
		$this->load->view('Profesor/loginProfesor.html');
	}

	public function registroProfesor()
	{
		$this->load->model('Datos/dao_profesor_model');
		$data['avatares']=$this->dao_profesor_model->avatarEst();
		$this->load->view('Profesor/Registro_Profesores',$data);
	}


}
