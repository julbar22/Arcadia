<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/actividad_model.php";
require_once '../Arcadia/application/models/Datos/dao_actividad_model.php';
require_once "../Arcadia/application/models/anexo_model.php";
require_once '../Arcadia/application/models/Datos/dao_anexo_model.php';
require_once '../Arcadia/application/models/Datos/dao_region_model.php';
require_once "../Arcadia/application/models/reino_model.php";

class Dao_anexo_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_anexo_model');
    }

    function insertarAnexoActividad(Anexo_model $anexo) {
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
        $consult = "SELECT K_CEDULA FROM PROFESOR WHERE N_NICKNAME='" . $_SESSION['codigo'] . "'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $profesor = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);
        $insert = "INSERT INTO ANEXO (K_ANEXO,K_ACTIVIDAD,N_NOMBRE,N_DESCRIPTION)
                   VALUES (nextval('sec_anexos')," . floatval($anexo->getActividad()) . ", '" . $anexo->getNombre(). "','" . $anexo->getDescripcion() . "')";
        $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
        $configbd->cerrarSesion();
        return true;
    }

    function obtenerAnexoActividad($tipoAct){
        $anexo = new anexo_model();
        $consultAnexos = "SELECT * FROM anexo WHERE K_ACTIVIDAD = ";
        $resultQuery = pg_query($consultAnexos.$tipoAct) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array($resultQuery, null, PGSQL_ASSOC);
        $anexo = $anexo->crearAnexo($line['k_anexo'],$line['k_actividad'],$line['n_nombre'],$line['n_description']);
        return $anexo;
    }

}

?>
