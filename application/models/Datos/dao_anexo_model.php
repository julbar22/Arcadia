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
    }

    function anexoReg(Anexo_model $anexo) {
      echo ($anexo);
      error_reporting(0);
      $configbd = new configbd_model();
      $dbconn4=$configbd->abrirSesion('profesor');
      $consult = "SELECT K_CEDULA FROM PROFESOR WHERE N_NICKNAME='" . $_SESSION['codigo'] . "'";
      $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
      $profesor = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);

      $insert = "INSERT INTO ANEXO (K_ANEXO,K_ACTIVIDAD,N_NOMBRE,N_DESCRIPTION)
                       VALUES (nextval('sec_anexos')," . floatval($anexo->getActividad()) . ", '" . $anexo->getNombre(). "','" . $anexo->getDescripcion() . "')";
      $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
      return true;

    }

}

?>
