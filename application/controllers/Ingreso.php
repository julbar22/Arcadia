<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingreso extends CI_Controller {
	function __construct(){
	     parent::__construct();
	     $this->load->model('conexionbd_model');


	 }


function recibirDatos(){
	$data = array(
        'codigo' => $this->input->post('inputCodigo'),
        'pass' => $this->input->post('inputPass')
		);
	$this->conexionbd_model->verUsuario($data);
	$this->load->view('Apoyo_Alimentario/funcionario');
}

}

?>