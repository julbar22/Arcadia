<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reino extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function vincularReinoC() {
        $this->load->model('Datos/dao_reino_model');
        $data = array(
            'k_reino' => $_POST['reinoIdModal'],
            'codigo' => $_POST['codigo'],
        );
        $validar = $this->dao_reino_model->vincularReino($data);
        if ($validar == true) {
            echo '<script>alert ("se ha vinculado al Reino");</script>';
            $this->load->view('Estudiante/inicioEstudiante');
        } else {

            echo '<script>alert ("No se ha podido vincular al Reino");</script>';
            $this->load->view('Estudiante/inicioEstudiante');
        }
    }

    function crearReinoC() {
        $data = array(
            'nombre' => $_POST['nombre'],
            'historia' => $_POST['historia'],
            'mision' => $_POST['mision'],
            'vision' => $_POST['vision'],
            'codigo' => $_POST['codigo'],
            'imagen' => $_POST['imagenModalId'],
        );
        $this->load->model('Datos/dao_reino_model');
        $validar = $this->dao_reino_model->crearReino($data);
        if ($validar == true) {
            echo '<script>alert ("se ha registrado su Reino");</script>';
            $this->load->view('Profesor/inicioProfesor');
        } else {

            echo '<script>alert ("No se ha podido registrar su Reino");</script>';
            $this->load->view('Profesor/inicioProfesor');
        }
    }

    function obtenerReinosC() {
        $this->load->model('Datos/dao_reino_model');
        $validar['reinos'] = $this->dao_reino_model->obtenerReinosCreados();
        $this->load->view('Estudiante/vincularReino', $validar);
    }

    function obtenerImagenReinosC() {
        $this->load->model('Datos/dao_reino_model');
        $validar['reinos'] = $this->dao_reino_model->obtenerImagenReinos();
        $this->load->view('Profesor/crearReino', $validar);
    }

    function obtenerReinoProfesorC() {
        $this->load->model('Datos/dao_reino_model');
        $data = array(
            'k_reino' => $_POST['k_reino'],
        );
        $validar = $this->dao_reino_model->obtenerReinoEspecifico($data);
        $this->load->view('Profesor/PlantillaReinoProfesor', $validar);
    }

    function obtenerReinoEstudianteC() {
        $this->load->model('Datos/dao_reino_model');
        $data = array(
            'k_reino' => $_POST['k_reino'],
        );
        $validar = $this->dao_reino_model->obtenerReinoEspecifico($data);
        $this->load->view('Estudiante/PlantillaReinoEstudiante', $validar);
    }

}

?>
