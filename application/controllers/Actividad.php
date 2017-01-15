<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "../Arcadia/application/controllers/Actividad.php";
require_once "../Arcadia/application/controllers/Pregunta.php";

class Actividad extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_actividad_model');
        $this->load->model('actividad_model');
        $this->load->model('Datos/dao_anexo_model');
        $this->load->model('anexo_model');
        $this->load->model('Datos/dao_reino_model');
        $this->load->model('Reino_model');
        $this->load->model('actividad_resuelta_model');
        $this->load->model('Datos/dao_soporte_model');
        $this->load->model('Datos/dao_estudiante_model');
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
                // add more headers for other content types here
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
            $result = $this->updateFile();
            if($result[0]==true){

            $newActividad = new Actividad_model;
            $newActividad = $newActividad->crearActividad(1,$_POST['nombre'],$_POST['descripcion'],$_POST['intentos'],$_POST['porcentaje'],"",$_POST['fechaVencimiento'],"",$_POST['tipoActividad'],"","");
            $idRegion = $_GET['k_region'];
            $responseActividad = $this->dao_actividad_model->actividadReg($newActividad, $idRegion);

            $newAnexo = new Anexo_model;
            $newAnexo = $newAnexo->crearAnexo(1,$responseActividad,$result[2],"Descripcion");
            $responseAnexo = $this->dao_anexo_model->anexoReg($newAnexo);
        }
        }else{
            $newActividad = new Actividad_model;
            $newActividad = $newActividad->crearActividad(1,$_POST['nombre'],$_POST['descripcion'],$_POST['intentos'],$_POST['porcentaje'],"",$_POST['fechaVencimiento'],"",$_POST['tipoActividad'],"","");
            $idRegion = $_GET['k_region'];
            for($h=0;$h<$_POST['cantidadDePreguntas'];$h++){
                $preguntas[$h]=$_POST['pregunta'.($h+1)];
            }

            $responseActividad = $this->dao_actividad_model->actividadCuestionario($newActividad, $idRegion,$preguntas);
        }
            $listaRegiones = $this->dao_reino_model->obtenerActividadesRegion($_GET['k_reino']);
            for($i=0;$i<count($listaRegiones);$i++){
                $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
            }

            $this->load->view('Profesor/ActividadesPorRegion',$response);
    }

    function crearActividadResuelta(){
        $intentos = $_GET['n_intentos'];
        $intentos = explode("/",$intentos);
        if($this->dao_actividad_model->validarIntentosActividad($_SESSION['codigo'],$_GET['k_actividad']) < $intentos[1] AND $this->verificarFechaActividad($_GET['k_actividad']) != 1)
        {
            $result = $this->updateFile();

            if($result[0]==true)
            {

                if($intentos[0]<$intentos[1])
                {
                    $newActividadResuelta = new Actividad_Resuelta_model;
                    $newActividadResuelta = $newActividadResuelta->crearActividadResuelta(1,$_SESSION['codigo'],$_GET['k_actividad'],"",1,$_GET['n_intentos']+1);
                    $responseActividadResuelta = $this->dao_actividad_model->actividadResueltaEst($newActividadResuelta);

                    $newSoporte = new Soporte_model;
                    $newSoporte = $newSoporte->crearSoporte(1,$responseActividadResuelta,$result[2],"Descripcion");
                    $responseSoporte = $this->dao_soporte_model->soporteActEst($newSoporte);
                }
           }
        }

        $listaRegiones = $this->dao_reino_model->obtenerActividadesRegionEst($_GET['k_reino']);

        for($i=0;$i<count($listaRegiones);$i++){
            $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
        }

        $this->load->view('Estudiante/ActividadesPorRegion',$response);
    }

    function updateFile(){
        $result;
        if(!$_FILES['fileActividad']['error'])
        {
            $file_name = $_FILES['fileActividad']['name'];
            $file_type = $_FILES['fileActividad']['type'];
            $rename = true;
            while($rename)
            {
                $rename = $this->validarArchivoDuplicado($file_name);
                if ($rename)
                {
                    $file_name = $this->renameFile($file_name);
                }
            }
            move_uploaded_file($_FILES['fileActividad']['tmp_name'], 'uploads/'.$file_name);
            $result[0] =  true;
            $result[1] =  'Congratulations!  Your file was accepted.';
            $result[2] =  $file_name;
            $result[3] =  $file_type;
        }
        else
        {
            $result[0] =  false;
            $result[1] = 'Ooops!  Your upload triggered the following error:  '.$_FILES['fileActividad']['error'];
        }
        return $result;
    }

    function validarArchivoDuplicado($file_name)
    {
        $dir = "uploads/";
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
         $listaRegiones = $this->dao_reino_model->obtenerActividadesRegion($_GET['k_reino']);
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
        $listaRegiones = $this->dao_reino_model->obtenerActividadesRegion($_GET['k_reino']);
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
       while ($key = current($_POST)) {
            $keys[$i] = key($_POST);
            $i++;
            next($_POST);
        }
       $this->dao_actividad_model->actualizarNota($_POST, $keys);
       $this->listaMisionesEstudiante();
     }
}

?>
