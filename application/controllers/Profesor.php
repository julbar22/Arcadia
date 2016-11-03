<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

    function __construct() {
        parent::__construct();
          $this->load->model('Datos/dao_profesor_model'); 
          $this->load->model('profesor_model');
    }

    function ingresarProfesor() {
        $data = array(
            'codigo' => $_POST['inputCodigo'],
            'pass' => $_POST['contra']
        );

        $validar = $this->dao_profesor_model->profesorLogin($data);
        if ($validar) {
            $this->load->view('Profesor/inicioProfesor');
        } else {
            $this->load->view('Profesor/loginProfesor.html');
            echo '<script>alert ("El usuario o contraseña son incorrectas");</script>';
        }
    }

    function inicioProfesor() {
        $this->load->view('Profesor/inicioProfesor');
    }

    function registrarProfesor() {
        $data = array(
            'codigo' => $_POST['UsuarioE'],
            'pass' => $_POST['ContrE']
        );
        $newProfesor = new Profesor_model();
                                                                                                                                                        
        $newProfesor = $newProfesor->crearProfesor($_POST['documento'],$_POST['nombreE'],$_POST['ApellidoE'],$_POST['correoE'],$_POST['UsuarioE'],$_POST['InsEduE'],$_POST['TelE'],$_POST['Icono']);
      
        $responseProfesor = $this->dao_profesor_model->profesorReg($data, $newProfesor);
       
        if ($responseProfesor==false) {
            $this->load->view('Profesor/loginProfesor.html');
            echo '<script>alert (" Se ha registrado exitosamente");</script>';
        } else {
            $response['profesor']=$_POST;
            $this->load->view('Profesor/Registro_Profesores', $response);
            echo '<script>alert ("El profesor ya tiene usuario registrado");</script>';
        }
    }

    function perfilProfesorC() {
        $validar = new Profesor_model();
        $validar = $this->dao_profesor_model->perfilProfesor();      
        $response['reinos']=$validar->ArregloReinos();
        $arreglo=$validar->crearArregloProfesor($validar);
        $response['perfil']=$arreglo;       
        $this->load->view('Profesor/reinosProfesor', $response);
    }
    
    function actualizarDatosProfesorC(){
        $newProfesor = new Profesor_model();        
        $newProfesor = $newProfesor->crearProfesor("","","",$_POST['CorreoE'],$_POST['NicknameE'],$_POST['ColegioE'],$_POST['TelefonoE'],"");
        $validar = $this->dao_profesor_model->actualizarDatosProfesor($newProfesor);
        $validar2 = $this->dao_profesor_model->perfilProfesor();
        $response['reinos']=$validar2->ArregloReinos();        
        $arreglo=$validar2->crearArregloProfesor($validar2);             
        $response['perfil']=$arreglo;
        $this->load->view('Profesor/reinosProfesor', $response);
    }


}

?>