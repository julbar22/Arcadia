<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reino extends CI_Controller {
	function __construct(){
	     parent::__construct();   

	 }



function vincularReinoC(){
  $this->load->model('Datos/dao_reino_model');  
  $data = array(
      'k_reino'=> $_POST['reinoIdModal'],
      'codigo'=> $_POST['codigo'],
    );
  $validar=$this->dao_reino_model->vincularReino($data);
  if ($validar==true) {
      echo '<script>alert ("se ha vinculado al Reino");</script>';
       $this->load->view('inicioEstudiante');
  }else{

    echo '<script>alert ("No se ha podido vincular al Reino");</script>';
     $this->load->view('inicioEstudiante');
  }
  
 
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
  if ($validar==true) {
      echo '<script>alert ("se ha registrado su Reino");</script>';
       $this->load->view('inicioProfesor');
  }else{

    echo '<script>alert ("No se ha podido registrar su Reino");</script>';
     $this->load->view('inicioProfesor');
  }

}

function obtenerReinosC(){
  $this->load->model('Datos/dao_reino_model');  
  $validar['reinos']=$this->dao_reino_model->obtenerReinosCreados();
   $this->load->view('vincularReino',$validar);
}

function obtenerImagenReinosC(){
  $this->load->model('Datos/dao_reino_model');  
  $validar['reinos']=$this->dao_reino_model->obtenerImagenReinos();
  $this->load->view('crearReino',$validar);
}

function obtenerReinosProfesorC(){
   $this->load->model('Datos/dao_reino_model');
   $validar['reinos']=$this->dao_reino_model->obtenerReinosProfesor();
   $this->load->view('reinosProfesor',$validar);

}

function obtenerReinosEstudianteC(){

}

function obtenerReinoProfesorC(){
  $this->load->model('Datos/dao_reino_model');
   $data = array(
        'k_reino'=> $_POST['k_reino'],           
      );

  $this->load->view('PlantillaReinoProfesor');

}

}

?>