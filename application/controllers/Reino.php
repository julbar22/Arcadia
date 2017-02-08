<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "../Arcadia/application/controllers/Region.php";
require_once "../Arcadia/application/controllers/Actividad.php";

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
            $this->dao_estudiante_model->vinvularPremiosEstudiante($data['k_reino']);
            echo '<script>alert ("se ha vinculado al Reino");</script>';
            $this->load->view('Estudiante/inicioEstudiante');
            $this->dao_reino_model->insertarNovedad("El estudiante ".$_SESSION['codigo']." se unió al reino ", $data['k_reino'], 'estudiante');
        } else {

            echo '<script>alert ("No se ha podido vincular al Reino");</script>';
            $this->load->view('Estudiante/inicioEstudiante');
        }
    }

    function crearReinoC() {
        print_r($_POST);
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
        $validar = $this->listarInfoEstudiante('profesor');
        $this->load->view('Profesor/PlantillaReinoProfesor', $validar);
    }

    function obtenerReinoEstudianteC() {
        $validar = $this->listarInfoEstudiante('estudiante');
        $this->load->view('Estudiante/PlantillaReinoEstudiante', $validar);
    }

    function cargarGaleria() {
      $validar = $this->listarInfoEstudiante('estudiante');
      $this->load->view('Estudiante/galeriaEstudiante', $validar);
    }

    function cargarGaleriaProfesor() {
      $validar = $this->listarInfoEstudiante('pofesor');
      $this->load->view('Profesor/galeriaProfesor', $validar);
    }

    function listarInfoEstudiante($sesion){
      $data = array(
          'k_reino' => $_GET['k_reino'],
      );
      $newReino = $this->dao_reino_model->obtenerReinoEspecifico($data,$sesion); //objeto reino
      $validar['perfilR'][0]=$newReino->crearArregloReino($newReino);
      $validar['galeria'] = $this->dao_reino_model->obtenerGaleria($_GET['k_reino'], $sesion);
      $validar['novedades'] = $this->dao_reino_model->obtenerNovedades($_GET['k_reino'],$sesion);
      if($sesion == 'estudiante'){
        $validar['honores'] = $this->dao_estudiante_model->obtenerHonores($_SESSION['codigo'], $sesion);
        $validar['premios'] = $this->dao_estudiante_model->obtenerPremios($_SESSION['codigo'], $_GET['k_reino'],$sesion);
        $validar['nivel'] = $this->dao_estudiante_model->notaEnReino($_SESSION['codigo'], $_GET['k_reino'],$sesion);
      }
      return $validar;
    }

    function mapaActividadesProfesorC(){
        $listaRegiones = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "profesor");
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }

        $this->load->view('Profesor/mapaProfesor',$response);
	}

    function actividadesRegion(){
        $reino = new dao_reino_model();
        $listaRegiones = $reino->obtenerActividadesReino($_GET['k_reino'], "profesor");
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
      $reinoModel = new Dao_reino_model();
      $estudianteModel = new Dao_estudiante_model();
      $listaEstudiantes = $reinoModel->obtenerEstudiantesReino($_GET['k_reino']);
      $listaEstudiantes = $estudianteModel->obtenerListaEstudiantes($listaEstudiantes);
      return $listaEstudiantes;
    }

    function actividadesRegionEst(){
        $listaRegiones = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "estudiante");
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }
        $this->load->view('Estudiante/ActividadesPorRegion',$response);
    }

    function notasRegionEst(){
        $acumulados = new Region();
        $listaRegiones = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "estudiante");
        $notas = $acumulados->calcularNotaEnRegion($listaRegiones);
        $response['porcentajes'] = $notas['porcentaje'];
        $response['acumulados'] = $notas['nota'];
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }
        $this->load->view('Estudiante/NotasPorRegion',$response);
    }

    function notasTotales(){
      $promedio = new Actividad();
      $response['estudiantes'] = $this->obtenerEstudiantesReino();
      $response['regiones'] = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "profesor");
      sort($response['estudiantes']);
      for($i = 0; $i < count($response['regiones']); $i++){
        for($j = 0; $j < count($response['estudiantes']); $j++){
          $response['totales'][$i][$j] = 0;
          for($k = 0; $k < count($response['regiones'][$i]->getActividades()); $k++){
            $respuesta = $this->dao_actividad_model->obtenerRespuesta($response['regiones'][$i]->getActividades()[$k]->getActividad(), $response['estudiantes'][$j]->getNickname(), $response['regiones'][$i]->getActividades()[$k]->getTipoActividad(), "profesor");
            $response['notas'][$i][$j][$k] = $respuesta['nota'];
            $response['totales'][$i][$j] += $response['regiones'][$i]->getActividades()[$k]->getPorcentaje()*$respuesta['nota']/100;
            $response['promAct'][$i][$k][$j] = $respuesta['nota'];
          }
        }
        for($k = 0; $k < count($response['regiones'][$i]->getActividades()); $k++){
          $response['promAct'][$i][$k] = $promedio->promedioActividad($response['promAct'][$i][$k]);
        }
      }
      $this->load->view('Profesor/Notas',$response);
    }

    function actualizarGaleria(){
      switch ($_POST['tipoA']) {
        case 2:
        case 0:
          $documento = new Actividad();
          $result = $documento->updateFile('assets/imagenes/images/gallery/',$_FILES['fileArchivoNuevo']['error'], $_FILES['fileArchivoNuevo']['name'],$_FILES['fileArchivoNuevo']['tmp_name']);
          if($result[0]==true){
              $this->dao_reino_model->insertarMultimedia($_GET['k_reino'],$_POST['tipoA'],"","","/Arcadia/assets/imagenes/images/gallery/".$result[2]);
          }
          break;
        case 1:
            $video = explode("=",$_POST['video']);
            if(count($video) == 2){
              $this->dao_reino_model->insertarMultimedia($_GET['k_reino'],$_POST['tipoA'],"","","https://www.youtube.com/embed/".$video[1]);
            }
          break;
        default:
          break;
      }
      $this->dao_reino_model->insertarNovedad("El profesor ".$_SESSION['codigo']." insertó un elemento en la galeria ", $_GET['k_reino'], 'profesor');
      $this->cargarGaleriaProfesor();
    }

    function crearNovedad(){
      $this->dao_reino_model->insertarNovedad($_POST['novedad'], $_GET['k_reino'], 'profesor');
      $this->obtenerReinoProfesorC();
    }
}

?>
