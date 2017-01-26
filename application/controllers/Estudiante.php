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
            'pass' => $_POST['ContrE'],
            'titulo' => $_POST['titulo']
        );
        $newEstudiante = new Estudiante_model();
        $newEstudiante=$newEstudiante->crearEstudiante($_POST['UsuarioE'],$_POST['nombreE'],$_POST['ApellidoE'],$_POST['correoE'],$_POST['f_nacimiento'],$_POST['SexoE'],$_POST['TelE'],$_POST['InsEduE'],$_POST['GradActE'],$_POST['Icono'],$_POST['ClaseE']);

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
        $response['honores'] = $this->dao_estudiante_model->obtenerTitulos($_SESSION['codigo'], 'estudiante');
        $response['avatares'] = $this->dao_estudiante_model->obtenerAvatares($_SESSION['codigo'], 'estudiante');
        print_r($response['avatares']);
        $arreglo=$validar->crearArregloEstudiante($validar);
        $response['perfil']=$arreglo;
        $response['icono'] = $this->iconoClase($arreglo['k_clase']);
        $this->load->view('Estudiante/reinosEstudiante', $response);
    }

    function actualizarDatosEstudiante(){
        $newEstudiante = new Estudiante_model();
        $newEstudiante=$newEstudiante->crearEstudiante($_POST['NicknameE'],"","",$_POST['CorreoE'],"","",$_POST['TelefonoE'],$_POST['ColegioE'],$_POST['GradoE'],"", "");
        $validar = $this->dao_estudiante_model->updatePerfilEstudiante($newEstudiante);
        $this->dao_estudiante_model->actualizarAvatar($_POST['avatarEstudiante'],$_POST['NicknameE'],'estudiante');
        $this->dao_estudiante_model->actualizarTitulo($_POST['TituloE'],$_POST['NicknameE'],'estudiante');
        $this->perfilEstudianteC();
    }

    function iconoClase($clase){
      $icono;
      switch ($clase) {
        case 'Guerrera':
        case 'Guerrero':
          $icono['pequeño'] = "/Arcadia/assets/Imagenes/arcadiaIcon7.png";
          $icono['mediano'] = "/Arcadia/assets/Imagenes/arcadiaIcon17.png";
          $icono['grande'] = "/Arcadia/assets/Imagenes/arcadiaIcon11.png";
          break;
        case 'Mago':
        case 'Maga':
          $icono['pequeño'] = "/Arcadia/assets/Imagenes/arcadiaIcon8.png";
          $icono['mediano'] = "/Arcadia/assets/Imagenes/arcadiaIcon16.png";
          $icono['grande'] = "/Arcadia/assets/Imagenes/arcadiaIcon12.png";
            break;
        case 'CambiaFormas':
        case 'CambiaPieles':
          $icono['pequeño'] = "/Arcadia/assets/Imagenes/arcadiaIcon9.png";
          $icono['mediano'] = "/Arcadia/assets/Imagenes/arcadiaIcon18.png";
          $icono['grande'] = "/Arcadia/assets/Imagenes/arcadiaIcon13.png";
            break;
        case 'Ranger':
        case 'Slayer':
          $icono['pequeño'] = "/Arcadia/assets/Imagenes/arcadiaIcon3.png";
          $icono['mediano'] = "/Arcadia/assets/Imagenes/arcadiaIcon15.png";
          $icono['grande'] = "/Arcadia/assets/Imagenes/arcadiaIcon10.png";
            break;
        default:
            break;
      }
      return $icono;
    }

}

?>
