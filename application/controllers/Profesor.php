<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {
	function __construct(){
	     parent::__construct();
	   


	 }


function ingresarProfesor(){
     $data = array(
        'codigo' => $_POST['inputCodigo'],
        'pass' =>   $_POST['contra']
    );
   

   $this->load->model('Datos/dao_estudiante_model');
   $validar=$this->dao_estudiante_model->profesorLogin($data);
   if ($validar) {
    $this->load->view('inicioProfesor.html');

   }else{  $this->load->view('loginProfesor.html');
   echo '<script>alert ("El usuario o contraseña son incorrectas");</script>'; 
 }

}

function registrarProfesor(){
   $data = array(
        'codigo' => $_POST['UsuarioE'],
        'pass' =>   $_POST['ContrE']
    );
     print_r($_POST);
   $this->load->model('Datos/dao_estudiante_model');  
   $validar['profesor']=$this->dao_estudiante_model->profesorReg($data,$_POST);
   if (count($validar['profesor'])<2) {
    $this->load->view('loginProfesor.html');
    echo '<script>alert (" Se ha registrado exitosamente");</script>'; 

   }else{  
   $this->load->view('Registro_Profesores',$validar);
   echo '<script>alert ("El profesor ya tiene usuario registrado");</script>'; 

   }

}

}

?>