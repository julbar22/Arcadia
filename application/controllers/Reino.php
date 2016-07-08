<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reino extends CI_Controller {
	function __construct(){
	     parent::__construct();
	   


	 }



function vincularReinoC(){
  $this->load->model('Datos/dao_reino_model');  
 
}

function crearReinoC(){
  $this->load->model('Datos/dao_reino_model');  
  $validar=$this->dao_reino_model->crearReino($_POST);

}

function obtenerReinosC(){
  $this->load->model('Datos/dao_reino_model');  
  $validar['reinos']=$this->dao_reino_model->obtenerReinos();
  


}

}

?>