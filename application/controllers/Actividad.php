<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once "../Arcadia/application/controllers/Actividad.php";

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
        $this->load->view('Profesor/CrearActividad');
    }

    function crearActividad(){
        $result = $this->updateFile();
        if($result[0]==true){

          $newActividad = new Actividad_model;
          $newActividad = $newActividad->crearActividad(1,$_POST['nombre'],$_POST['descripcion'],$_POST['intentos'],$_POST['porcentaje'],"",$_POST['fechaVencimiento'],"",$_POST['tipoActividad'],"");
          $idRegion = 1;
          $responseActividad = $this->dao_actividad_model->actividadReg($newActividad, $idRegion);
//ARREGLAR ID REGION
          $newAnexo = new Anexo_model;
          $newAnexo = $newAnexo->crearAnexo(1,$responseActividad,$result[2],"Descripcion");
          $responseAnexo = $this->dao_anexo_model->anexoReg($newAnexo);

          $listaRegiones = $this->dao_reino_model->obtenerActividadesRegion(0);
          for($i=0;$i<count($listaRegiones);$i++){
              $response['regiones'][$i]=$listaRegiones[$i]->crearArregloRegion($listaRegiones[$i]);
          }
//ARREGLAR ID REINO
          $this->load->view('Profesor/ActividadesPorRegion',$response);
        }

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
