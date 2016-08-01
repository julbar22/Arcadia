<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reino extends CI_Controller {
	function __construct(){
	     parent::__construct();
	   


	 }



function vincularReinoC(){
  $this->load->model('Datos/dao_reino_model');  
   $this->load->view('vincularReino');
 
}

function crearReinoC(){ 
  $data = array(
        'nombre'=> $_POST['nombre'],
        'historia'=> $_POST['historia'],
        'mision'=> $_POST['mision'],
        'vision'=> $_POST['vision'],
        'codigo'=> $_POST['codigo'],    
        'imagen'=> $_POST['imagenModalId'],   
      );
   $this->load->model('Datos/dao_reino_model');  
  $validar =$this->dao_reino_model->crearReino($data);

    echo '<script>alert ("se ha registrado su Reino");</script>';
 
  

}

function obtenerReinosC(){
  $this->load->model('Datos/dao_reino_model');  
  $validar['reinos']=$this->dao_reino_model->obtenerReinosCreados();
}

function obtenerImagenReinosC(){
  $this->load->model('Datos/dao_reino_model');  
  $validar['reinos']=$this->dao_reino_model->obtenerImagenReinos();
  $this->load->view('crearReino',$validar);
}



}

?>