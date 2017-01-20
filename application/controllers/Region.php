<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_region_model');
        $this->load->model('Region_model');
    }

    function crearRegion() {
        $reino = new Reino_model();
        $reino=$reino->crearReino("",$_POST['nombre'],$_POST['codigo'],"","",$_POST['historia'],$_POST['imagenModalId'],$_POST['mision'],$_POST['vision'],"");

        $validar = $this->dao_region_model->crearRegion($reino);
        if ($validar == true) {
            echo '<script>alert ("se ha registrado su Reino");</script>';
            $this->load->view('Profesor/inicioProfesor');
        } else {

            echo '<script>alert ("No se ha podido registrar su Reino");</script>';
            $this->load->view('Profesor/inicioProfesor');
        }
    }

    function calcularNotaEnRegion($regiones){
        for($i = 0; $i <count($regiones); $i++){
            $response['porcentaje'][$i] = 0;
            $response['nota'][$i] = 0;
            for ($j = 0; $j < count($regiones[$i]->getActividades()); $j++){
                $response['porcentaje'][$i] += $regiones[$i]->getActividades()[$j]->getPorcentaje();
                $response['nota'][$i] +=  $regiones[$i]->getActividades()[$j]->getPorcentaje()*$regiones[$i]->getActividades()[$j]->getNota()/100;
            }
        }
        return $response;
    }
}

?>
