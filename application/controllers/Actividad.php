<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "../Arcadia/application/controllers/Actividad.php";
require_once "../Arcadia/application/controllers/Pregunta.php";
require_once "../Arcadia/application/controllers/Region.php";
require_once "../Arcadia/application/controllers/Reino.php";

class Actividad extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_actividad_model');
        $this->load->model('Datos/dao_anexo_model');
        $this->load->model('Datos/dao_reino_model');
        $this->load->model('Datos/dao_soporte_model');
        $this->load->model('Datos/dao_estudiante_model');
        $this->load->model('actividad_model');
        $this->load->model('anexo_model');
        $this->load->model('Reino_model');
        $this->load->model('actividad_resuelta_model');
        $this->load->model('Soporte_model');
    }

    function descargarDocumentoActividad() {
        $path = "uploads/"; // change the path to fit your websites document structure
        $dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $_GET['download_file']); // simple file name validation
        $fullPath = $path.$dl_file;

        if ($fd = fopen ($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "pdf":
                header("Content-type: application/pdf");
                header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
                break;
                default;
                header("Content-type: application/octet-stream");
                header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
                break;
            }
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while(!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
        fclose ($fd);
        exit;
    }

    function formularioCrearActividad() {
        $pregunta = new Pregunta();
        $response=$pregunta->getPreguntas($_GET['k_reino']);
        $this->load->view('Profesor/CrearActividad',$response);
    }

    function crearActividad(){
        if($_POST['tipoActividad']==1){
            $result = $this->updateFile('uploads/', $_FILES['fileActividad']['error'],$_FILES['fileActividad']['name'],$_FILES['fileActividad']['tmp_name']);
            if($result[0]==true){
                $newActividad = new Actividad_model;
                $newActividad = $newActividad->crearActividad(1,$_POST['nombre'],$_POST['descripcion'],$_POST['intentos'],$_POST['porcentaje'] / 100,"",$_POST['fechaVencimiento'],"",$_POST['tipoActividad'],"","");
                $idRegion = $_GET['k_region'];
                $responseActividad = $this->dao_actividad_model->actividadReg($newActividad, $idRegion);
                $newAnexo = new Anexo_model;
                $newAnexo = $newAnexo->crearAnexo(1,$responseActividad,$result[2],"Descripcion");
                $responseAnexo = $this->dao_anexo_model->insertarAnexoActividad($newAnexo);
                $this->dao_reino_model->insertarNovedad("El profesor ".$_SESSION['codigo']." creo la actividad ".$_POST['nombre'], $_GET['k_reino'], 'profesor');
            }
        }else{
            $newActividad = new Actividad_model;
            $newActividad = $newActividad->crearActividad(1,$_POST['nombre'],$_POST['descripcion'],$_POST['intentos'],$_POST['porcentaje'],"",$_POST['fechaVencimiento'],"",$_POST['tipoActividad'],"","");
            $idRegion = $_GET['k_region'];
            for($h=0;$h<$_POST['cantidadDePreguntas'];$h++){
                $preguntas[$h]=$_POST['pregunta'.($h+1)];
            }
            $responseActividad = $this->dao_actividad_model->actividadCuestionario($newActividad, $idRegion,$preguntas);
            $this->dao_reino_model->insertarNovedad("El profesor ".$_SESSION['codigo']." creo la actividad ".$_POST['nombre'], $_GET['k_reino'], 'profesor');
        }
        $listaRegiones = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "profesor");
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }
        $this->load->view('Profesor/ActividadesPorRegion',$response);
    }

    function crearActividadResuelta(){
        $intentos = $_GET['n_intentos'];
        $intentos = explode("/",$intentos);
        if($this->dao_actividad_model->validarIntentosActividad($_SESSION['codigo'],$_GET['k_actividad']) < $intentos[1] AND $this->verificarFechaActividad($_GET['k_actividad']) != 1){
            $result = $this->updateFile('uploads/',$_FILES['fileActividad']['error'],$_FILES['fileActividad']['name'],$_FILES['fileActividad']['tmp_name']);
            if($result[0]==true){
                if($intentos[0]<$intentos[1]){
                    $newSoporte = new Soporte_model;
                    $newActividadResuelta = new Actividad_Resuelta_model;
                    $newActividadResuelta = $newActividadResuelta->crearActividadResuelta(1,$_SESSION['codigo'],$_GET['k_actividad'],"",0,$_GET['n_intentos']+1);
                    $responseActividadResuelta = $this->dao_actividad_model->InsertarActividadResueltaEst($newActividadResuelta);
                    $newSoporte = $newSoporte->crearSoporte(1,$responseActividadResuelta,$result[2],"Descripcion");
                    $responseSoporte = $this->dao_soporte_model->insertarSoporteActividad($newSoporte);
                }
            }
        }
        $listaRegiones = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "estudiante");
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }
        $this->load->view('Estudiante/ActividadesPorRegion',$response);
    }

    function updateFile($ruta, $error, $name, $tmpName){
        $result;
        if(!$error){
            $file_name = $name;
      //      $file_type = $_FILES['fileActividad']['type'];
            $file_name = preg_replace("/[^a-z0-9_\.\-[:space:]]/i", "_", $file_name);
            $rename = true;
            while($rename){
                $rename = $this->validarArchivoDuplicado($file_name,$ruta);
                if ($rename){
                    $file_name = $this->renameFile($file_name);
                }
            }
            move_uploaded_file($tmpName, $ruta.$file_name);
            $result[0] =  true;
            $result[1] =  'Congratulations!  Your file was accepted.';
            $result[2] =  $file_name;
        //    $result[3] =  $file_type;
        } else {
            $result[0] =  false;
            $result[1] = 'Ooops!  Your upload triggered the following error:  '.$error;
        }
        return $result;
    }

    function validarArchivoDuplicado($file_name, $dir){
        $rename = false;
        if (is_dir($dir)){
              if ($dh = opendir($dir)){
                  while (($file = readdir($dh)) !== false){
                      if ($file_name == $file){
                          $rename = true;
                      }
              }
              closedir($dh);
            }
        }
        return $rename;
    }

    function renameFile($file_name){
        $temp = explode(".", $file_name);
        $file_name = $temp[0]."(1)".".".$temp[1];
        return $file_name;
    }

     function actualizarActividad(){
         $newActividad = new Actividad_model();
         $newActividad=$newActividad->crearActividad($_POST['actividadIdModal'],"","","","","","","","","",$_POST['Estado']);
         $validar = $this->dao_actividad_model->actualizarActividad($newActividad);
         $listaRegiones = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "profesor");
         for($i=0;$i<count($listaRegiones);$i++){
             $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
         }

         $this->load->view('Profesor/ActividadesPorRegion',$response);
     }

     function verificarFechaActividad($k_actividad){
        $fechaVencimiento = $this->dao_actividad_model->obtenerFechaVencimiento($k_actividad);
        return $this->dao_actividad_model->validarFechaVencimientoActividad($fechaVencimiento, $k_actividad);
     }

     function listaMisionesEstudiante(){
        $listaRegiones = $this->dao_reino_model->obtenerActividadesReino($_GET['k_reino'], "profesor");
        for ($i = 0; $i < count($listaRegiones); $i++){
            for($j = 0; $j < count($listaRegiones[$i]->getActividades()); $j++){
              $idActividad = $listaRegiones[$i]->getActividades()[$j]->getActividad();
              $tipoActividad = $listaRegiones[$i]->getActividades()[$j]->getTipoActividad();
              $response['respuestas'][$i][$j] = $this->dao_actividad_model->obtenerRespuesta($idActividad, $_GET['k_estudiante'], $tipoActividad);
            }
        }
        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }
        $Estudiante[0]=$_GET['k_estudiante'];
        $response['Estudiante'] = $this->dao_estudiante_model->obtenerListaEstudiantes($Estudiante);
        $this->load->view('Profesor/MisionesEstudiante',$response);
     }

     function actualizarNota(){
         $i = 0;
         $reino = new Reino();
         while ($key = current($_POST)) {
              $keys[$i] = key($_POST);
              $i++;
              next($_POST);
          }
         $this->dao_actividad_model->actualizarNota($_POST, $keys);
         $estudiante[0] = $_GET['k_estudiante'];
         $this->calcularNotaReino($estudiante, $_GET['k_reino']);
         $this->dao_reino_model->insertarNovedad("El profesor ".$_SESSION['codigo']." actualizó las notas en el reino ", $_GET['k_reino'], 'profesor');
         $reino->listaEstudiantesReino();
     }

     function actualizarActividadNota(){
         $i = 0;
         $reino = new Reino();
         while ($key = current($_POST)) {
            if (key($_POST) != "btnSubmit"){
                $keys[$i] = key($_POST);
            }
            $i++;
            next($_POST);
         }
         $this->dao_actividad_model->actualizarNota($_POST, $keys);
         $listaEstudiantes = $this->dao_reino_model->obtenerEstudiantesReino($_GET['k_reino']);
         $this->calcularNotaReino($listaEstudiantes, $_GET['k_reino']);
         $this->dao_reino_model->insertarNovedad("El profesor ".$_SESSION['codigo']." actualizó las notas en el reino ", $_GET['k_reino'], 'profesor');
         $reino->actividadesRegion();
     }

     function listaEstudianteEnMision(){
         $listaEstudiantes = $this->dao_reino_model->obtenerEstudiantesReino($_GET['k_reino']);
         $listaEstudiantes = $this->dao_estudiante_model->obtenerListaEstudiantes($listaEstudiantes);
         sort($listaEstudiantes);
         $actividad = $this->dao_actividad_model->obtenerActividad($_GET['k_actividad']);
         $response['actividad'] = $actividad;
         $response['estudiantes'] = $listaEstudiantes;
         for ($i = 0; $i < count($listaEstudiantes); $i++){
               $response['respuestas'][$i] = $this->dao_actividad_model->obtenerRespuesta($_GET['k_actividad'], $listaEstudiantes[$i]->getNickname(), $actividad->getTipoActividad());
         }
        $this->load->view('Profesor/MisionRespuestas',$response);
     }

     function promedioActividad($notas){
         $promedio = 0;
         for($i = 0; $i < count($notas); $i++){
           $promedio += $notas[$i];
         }
         return number_format((float)($promedio/count($notas)), 2, '.', '');
     }

     function calcularNotaReino($estudiantes, $reino){
       $actividad = new actividad_model();
       for ($i = 0; $i < count($estudiantes); $i++){
         $actividades = $this->dao_reino_model->obtenerActividadesReino($reino, "profesor");
         $porcentaje[$i] = 0;
         for($j = 0; $j < count($actividades); $j++){
           for ($k = 0; $k < count($actividades[$j]->getActividades()); $k++){
             $respuestas = $this->dao_actividad_model->obtenerRespuesta($actividades[$j]->getActividades()[$k]->getActividad(), $estudiantes[$i], $actividades[$j]->getActividades()[$k]->getTipoActividad());
             $porcentaje[$i] += $actividades[$j]->getActividades()[$k]->getPorcentaje();
             $nota[$j][$k] = $respuestas['nota'];
             $porcentajeParcial[$j][$k] = $actividades[$j]->getActividades()[$k]->getPorcentaje();
           }
         }
         $notaActual = $this->dao_estudiante_model->notaEnReino($estudiantes[$i], $reino, "profesor");
         $nivel = $this->calcularNivelReino($nota,$porcentajeParcial,$porcentaje[$i],$notaActual['valor'],$notaActual['clase'],$estudiantes[$i]);
         $this->dao_reino_model->actualizarNotaReino($reino, $estudiantes[$i], $nivel['nivel'], $nivel['valor']);
       }
     }

     function calcularNivelReino($nota, $porcentajeP, $porcentajeT, $notaActual, $clase, $estudiante){
       $respuesta['subioNivel'] = "false";
       $respuesta['valor'] = 0;
       if($porcentajeT < 100){
         $porcentajeT=100;
       }
       for ($i = 0; $i<count($nota); $i++){
        for($j = 0; $j<count($nota[$i]); $j++){
            $respuesta['valor'] += $nota[$i][$j] * $porcentajeP[$i][$j] / $porcentajeT;
          }
       }
       if($respuesta['valor'] >= 0 and $respuesta['valor'] <= 2.5){
         $respuesta['nivel'] = ($clase * 4) + 0;
       }
       if($respuesta['valor'] > 2.5 and $respuesta['valor'] <= 5){
         if($notaActual <= 2.5){
           $respuesta['subioNivel'] = "true";
         }
         $respuesta['nivel'] = ($clase * 4) + 1;
       }
       if($respuesta['valor'] > 5 and $respuesta['valor'] <= 7.5){
         if($notaActual <= 5){
           $respuesta['subioNivel'] = "true";
         }
         $respuesta['nivel'] = ($clase * 4) + 2;
       }
       if($respuesta['valor'] > 7.5 and $respuesta['valor'] <= 10){
         if($notaActual <= 7.5){
           $respuesta['subioNivel'] = "true";
         }
         $respuesta['nivel'] = ($clase * 4) + 3;
       }
       if($respuesta['subioNivel'] == "true"){
          $this->dao_estudiante_model->verificarNivelNuevo($respuesta['nivel'], $estudiante, "profesor");
          $this->dao_reino_model->insertarNovedad("FELICIDADES!!! ".$estudiante." subió de nivel ", $_GET['k_reino'], 'profesor');
       }
       return $respuesta;
     }
}

?>
