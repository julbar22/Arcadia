<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "../Arcadia/application/controllers/Region.php";

class Reino extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_reino_model');
        $this->load->model('Datos/dao_estudiante_model');
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

    function listaEstudiantesReino(){
        $listaEstudiantes = $this->obtenerEstudiantesReino();
        sort($listaEstudiantes);
        $response['listaEstudiantes'] = $listaEstudiantes;
        $this->load->view('Profesor/ListaEstudiantes',$response);
    }

    function obtenerEstudiantesReino(){
      $listaEstudiantes = $this->dao_reino_model->obtenerEstudiantesReino($_GET['k_reino']);
      $listaEstudiantes = $this->dao_estudiante_model->obtenerListaEstudiantes($listaEstudiantes);
      return $listaEstudiantes;
    }

    function actividadesRegionEst(){
        $listaRegiones = $this->dao_reino_model->obtenerActividadesRegionEst($_GET['k_reino']);
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }
        $this->load->view('Estudiante/ActividadesPorRegion',$response);
    }

    function notasRegionEst(){
        $acumulados = new Region();
        $listaRegiones = $this->dao_reino_model->obtenerActividadesYNotaRegionEst($_GET['k_reino']);
        $notas = $acumulados->calcularNotaEnRegion($listaRegiones);
        $response['porcentajes'] = $notas['porcentaje'];
        $response['acumulados'] = $notas['nota'];
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }
        $this->load->view('Estudiante/NotasPorRegion',$response);
    }

    function notasTotales(){
      $response['estudiantes'] = $this->obtenerEstudiantesReino();
      $response['regiones'] = $this->dao_reino_model->obtenerActividadesRegion($_GET['k_reino']);
      sort($response['estudiantes']);
      for($i = 0; $i < count($response['regiones']); $i++){
        for($j = 0; $j < count($response['estudiantes']); $j++){
          $response['totales'][$i][$j] = 0;
          for($k = 0; $k < count($response['regiones'][$i]->getActividades()); $k++){
            $respuesta = $this->dao_actividad_model->obtenerRespuesta($response['regiones'][$i]->getActividades()[$k]->getActividad(), $response['estudiantes'][$j]->getNickname(), $response['regiones'][$i]->getActividades()[$k]->getTipoActividad());
            $response['notas'][$i][$j][$k] = $respuesta['nota'];
            $response['totales'][$i][$j] += $response['regiones'][$i]->getActividades()[$k]->getPorcentaje()*$respuesta['nota']/100;
          }
        }
      }
      $this->load->view('Profesor/Notas',$response);
    }
}

?>
