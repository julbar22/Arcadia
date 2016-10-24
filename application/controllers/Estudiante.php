<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_estudiante_model'); 
        $this->load->model('estudiante_model');       
    }

    function ingresarEstudiante() {
                 
        $data = array(
            'codigo' => $_POST['inputCodigo'],
            'pass' => $_POST['contra']
        );
       
        $validar = $this->dao_estudiante_model->estudianteLogin($data);

        if ($validar) {            
            $this->load->view('Estudiante/inicioEstudiante');
        } else {
            $this->load->view('Estudiante/ArcadiaLogin.html');
            echo '<script>alert ("Usuario o Contraseña erroneas");</script>';
        }
    }

    function inicioEstudiante() {
        $this->load->view('Estudiante/inicioEstudiante');
    }

    function registrarEstudiante() {
        $data = array(
            'codigo' => $_POST['UsuarioE'],
            'pass' => $_POST['ContrE']
        );
        $newEstudiante = new Estudiante_model();
        $newEstudiante=$newEstudiante->crearEstudiante($_POST['UsuarioE'],$_POST['nombreE'],$_POST['ApellidoE'],$_POST['correoE'],$_POST['f_nacimiento'],$_POST['SexoE'],$_POST['TelE'],$_POST['InsEduE'],$_POST['GradActE'],$_POST['Icono']);
        
        $responseEstudiante = $this->dao_estudiante_model->estudianteReg($data, $newEstudiante);

        if ($responseEstudiante== false) {
            $this->load->view('Estudiante/ArcadiaLogin.html');
            echo '<script>alert (" Se ha registrado exitosamente");</script>';
        } else {
            $response['estudiante']=$_POST;
            $this->load->view('Estudiante/Registro_Estudiante', $response);
            echo '<script>alert ("El estudiante ya tiene usuario registrado");</script>';
        }
    }

    function perfilEstudianteC() {
        $validar = new Estudiante_model();
        $validar = $this->dao_estudiante_model->perfilEstudiante();  
        $response['reinos']=$validar->ArregloReinos();        
        $arreglo=$validar->crearArregloEstudiante($validar);             
        $response['perfil']=$arreglo;    
        $this->load->view('Estudiante/reinosEstudiante', $response);
    }  

    function actualizarDatosEstudiante(){
        $this->load->model('Datos/dao_estudiante_model');
        $validar = $this->dao_estudiante_model->updatePerfilEstudiante($_POST);
        //actualizar Estudiantes
        $validar2 = $this->dao_estudiante_model->perfilEstudiante();
        $this->load->view('Estudiante/reinosEstudiante', $validar2);
    }

}

?>
