<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reino extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_reino_model');
        $this->load->model('Reino_model');
    }

    function vincularReinoC() {        
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
              
        $reino = new Reino_model();
        $reino=$reino->crearReino("",$_POST['nombre'],$_POST['codigo'],"","",$_POST['historia'],$_POST['imagenModalId'],$_POST['mision'],$_POST['vision'],"");
            
        $validar = $this->dao_reino_model->crearReino($reino);          
        if ($validar == true) {
            echo '<script>alert ("se ha registrado su Reino");</script>';
            $this->load->view('Profesor/inicioProfesor');
        } else {

            echo '<script>alert ("No se ha podido registrar su Reino");</script>';
            $this->load->view('Profesor/inicioProfesor');
        }
    }

    function obtenerReinosC() {
       
        $reinos=$this->dao_reino_model->obtenerReinosCreados();
        for($i=0;$i<count($reinos);$i++){
            $validar[$i]=$reinos[$i]->crearArregloReino($reinos[$i]);
        }
        $response['reinos'] = $validar;
        $this->load->view('Estudiante/vincularReino', $response);
    }

    function obtenerImagenReinosC() {
        
        $validar['reinos'] = $this->dao_reino_model->obtenerImagenReinos();
        $this->load->view('Profesor/crearReino', $validar);
    }

    function obtenerReinoProfesorC() {       
        $data = array(
            'k_reino' => $_GET['k_reino'],
        );
        $newReino = $this->dao_reino_model->obtenerReinoEspecifico($data,'profesor');// esto debe devolver objeto reino
        $validar['perfilR'][0]= $newReino->crearArregloReino($newReino);
        $this->load->view('Profesor/PlantillaReinoProfesor', $validar);
    }

    function obtenerReinoEstudianteC() {       
        $data = array(
            'k_reino' => $_GET['k_reino'],
        );
        $newReino = $this->dao_reino_model->obtenerReinoEspecifico($data,'estudiante'); //objeto reino
        $validar['perfilR'][0]=$newReino->crearArregloReino($newReino);
        $this->load->view('Estudiante/PlantillaReinoEstudiante', $validar);
    }

    function mapaActividadesProfesorC(){	
        $listaRegiones = $this->dao_reino_model->obtenerActividadesRegion($_GET['k_reino']);
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }

        $this->load->view('Profesor/mapaProfesor',$response);        
	}

    function actividadesRegion(){
        $listaRegiones = $this->dao_reino_model->obtenerActividadesRegion($_GET['k_reino']);
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }

        $this->load->view('Profesor/ActividadesPorRegion',$response);      
        
    }


}

?>
