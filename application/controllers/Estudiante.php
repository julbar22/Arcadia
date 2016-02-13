<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller {
	function __construct(){
	     parent::__construct();
	   


	 }


function ingresarEstudiante(){
     $data = array(
        'codigo' => $_POST['inputCodigo'],
        'pass' =>   $_POST['contra']
    );
   

   $this->load->model('Datos/dao_estudiante_model');
   $validar=$this->dao_estudiante_model->estudianteLogin($data);
   if ($validar) {
    $this->load->view('inicioEstudiante.html');

   }else  $this->load->view('ArcadiaLogin.html');

}

function registrarEstudiante(){
   $data = array(
        'codigo' => $_POST['UsuarioE'],
        'pass' =>   $_POST['ContrE']
    );

   print_r($_POST);


   $this->load->model('Datos/dao_estudiante_model');  
   $validar=$this->dao_estudiante_model->estudianteReg($data,$_POST);
  if ($validar) {
    $this->load->view('ArcadiaLogin.html');
    echo '<script>alert (" Se ha registrado exitosamente");</script>'; 

   }else{  $this->load->view('ArcadiaLogin');
   echo '<script>alert ("No es un estudiante");</script>'; 

   }

}

}

?>