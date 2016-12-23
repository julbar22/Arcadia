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
            $newActividad = $newActividad->crearActividad(1,$_POST['nombre'],$_POST['descripcion'],$_POST['intentos'],$_POST['porcentaje'],"",$_POST['fechaVencimiento'],"",$_POST['tipoActividad'],"");
            $idRegion = $_GET['k_region'];
            $responseActividad = $this->dao_actividad_model->actividadReg($newActividad, $idRegion);

            $newAnexo = new Anexo_model;
            $newAnexo = $newAnexo->crearAnexo(1,$responseActividad,$result[2],"Descripcion");
            $responseAnexo = $this->dao_anexo_model->anexoReg($newAnexo);
        }
        }else{
            $newActividad = new Actividad_model;
            $newActividad = $newActividad->crearActividad(1,$_POST['nombre'],$_POST['descripcion'],$_POST['intentos'],$_POST['porcentaje'],"",$_POST['fechaVencimiento'],"",$_POST['tipoActividad'],"");
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

    function updateFile(){
        $result;
        if(!$_FILES['fileActividad']['error'])
        {
            $file_name = $_FILES['fileActividad']['name'];
            $file_type = $_FILES['fileActividad']['type'];
            $rename = true;
            while($rename)
            {
                $rename = $this->validateDuplicateFile($file_name);
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

    function validateDuplicateFile($file_name)
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
}

?>
