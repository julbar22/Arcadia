<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/actividad_model.php";
require_once '../Arcadia/application/models/Datos/dao_actividad_model.php';
require_once "../Arcadia/application/models/anexo_model.php";
require_once '../Arcadia/application/models/Datos/dao_anexo_model.php';
require_once "../Arcadia/application/models/soporte_model.php";
require_once '../Arcadia/application/models/Datos/dao_soporte_model.php';
require_once '../Arcadia/application/models/Datos/dao_region_model.php';
require_once "../Arcadia/application/models/reino_model.php";

class Dao_soporte_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insertarSoporteActividad(Soporte_model $soporte){
        $configbd = new configbd_model();
        $dbconn4= $configbd->abrirSesion('estudiante');
        $insert = "INSERT INTO SOPORTE (k_soporte,k_actividad_resuelta,n_nombre,n_description)
                   VALUES (nextval('sec_soportes'),". $soporte->getActividadResuelta(). ", '" . $soporte->getNombre(). "','" . $soporte->getDescripcion() . "')";
        $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
        $configbd->cerrarSesion();
        return true;
    }

}

?>
