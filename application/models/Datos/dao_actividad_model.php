<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/actividad_model.php";
require_once '../Arcadia/application/models/Datos/dao_actividad_model.php';
require_once '../Arcadia/application/models/Datos/dao_region_model.php';
require_once "../Arcadia/application/models/reino_model.php";

class Dao_actividad_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function actividadReg(Actividad_model $actividad, $regionId) {
      error_reporting(0);

      $configbd = new configbd_model();
      $dbconn4=$configbd->abrirSesion('profesor');
      $consult = "SELECT K_CEDULA FROM PROFESOR WHERE N_NICKNAME='" . $_SESSION['codigo'] . "'";
      $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
      $profesor = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);

      if($actividad->getPreRequisito()=="")
      {
        $insert = "INSERT INTO ACTIVIDAD (K_ACTIVIDAD,K_REGION,N_NOMBRE,N_DESCRIPCION,Q_INTENTOS,V_PORCENTAJE,F_CREACION,F_VENCIMIENTO,K_TIPO_ACTIVIDAD,I_ESTADO)
                         VALUES (nextval('sec_actividades')," . floatval($regionId) . ", '" . $actividad->getNombre(). "','" . $actividad->getDescripcion() . "', " . floatval($actividad->getIntentos()) . ",
                        " .floatval($actividad->getPorcentaje())/100 . ",current_date," . "(to_date('" . $actividad->getFechaVencimiento() . "', 'YYYY-MM-DD'))," . floatval($actividad->getTipoActividad()) . ",'Activa')";

      }else
      {
        $insert = "INSERT INTO ACTIVIDAD (K_ACTIVIDAD,K_REGION,N_NOMBRE,N_DESCRIPCION,Q_INTENTOS,V_PORCENTAJE,F_CREACION,F_VENCIMIENTO,K_PREREQUISITO,K_TIPO_ACTIVIDAD,I_ESTADO)
                         VALUES (nextval('sec_actividades')," . 1 . ", '" . $actividad->getNombre(). "','" . $actividad->getDescripcion() . "', " . floatval($actividad->getIntentos()) . ",
                         " .floatval($actividad->getPorcentaje())/100 . ",current_date," . "(to_date('" . $actividad->getFechaVencimiento() . "', 'YYYY-MM-DD'))," . floatval($actividad->getPreRequisito()) . "," . floatval($actividad->getTipoActividad()) . ",'Activa')";

      }
      $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());

      $idActividadConsult ="SELECT currval('sec_actividades') AS id";
      $resultConsultId =pg_query($idActividadConsult) or die('La consulta fallo: ' . pg_last_error());
      $line = pg_fetch_array( $resultConsultId, null, PGSQL_ASSOC);
      return $line['id'];
    }


        function actividadResueltaEst(Actividad_Resuelta_model $actividadResuelta)
        {
            error_reporting(0);

            $configbd = new configbd_model();
            $dbconn4= $configbd->abrirSesion('estudiante');
            $insert = "INSERT INTO ACTIVIDAD_RESUELTA (k_actividad_resuelta,k_nickname,k_actividad,n_observacion,v_nota,q_intento)
                             VALUES (nextval('sec_actividades_resueltas'),'".$actividadResuelta->getNickname()."',".$actividadResuelta->getActividad().",'".$actividadResuelta->getObservacion()."',".$actividadResuelta->getNota().",".$actividadResuelta->getIntento().")";
            $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());

            $query = "SELECT k_actividad_resuelta FROM ACTIVIDAD_RESUELTA WHERE k_nickname = '".$actividadResuelta->getNickname()."' AND k_actividad = ".$actividadResuelta->getActividad()." AND q_intento = ".$actividadResuelta->getIntento();
            $resultQuery = pg_query($query) or die('La consulta fallo: '. pg_last_error());
            $line = pg_fetch_array( $resultQuery, null, PGSQL_ASSOC);
            return $line['k_actividad_resuelta'];
        }

        function validarIntentosActividad($nickmane, $actividad)
        {
            error_reporting(0);
            $configbd = new configbd_model();
            $dbconn4= $configbd->abrirSesion('estudiante');

            $query =  "SELECT K_ACTIVIDAD_RESUELTA FROM ACTIVIDAD_RESUELTA WHERE K_NICKNAME='" . $nickmane . "' AND K_ACTIVIDAD = ".$actividad;
            $resultQuery = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
            $i = 0;

            while ($line = pg_fetch_array($resultQuery, null, PGSQL_ASSOC)) {
                  $i++;
            }

            return $i;
        }

    function actividadCuestionario(Actividad_model $actividad, $regionId,$preguntas){
      $configbd = new configbd_model();
      $dbconn4=$configbd->abrirSesion('profesor');

      if($actividad->getPreRequisito()=="")
      {
        $insert = "INSERT INTO ACTIVIDAD (K_ACTIVIDAD,K_REGION,N_NOMBRE,N_DESCRIPCION,Q_INTENTOS,V_PORCENTAJE,F_CREACION,F_VENCIMIENTO,K_TIPO_ACTIVIDAD,I_ESTADO)
                         VALUES (nextval('sec_actividades')," . floatval($regionId) . ", '" . $actividad->getNombre(). "','" . $actividad->getDescripcion() . "', " . floatval($actividad->getIntentos()) . ",
                         " .floatval($actividad->getPorcentaje())/100 . ",current_date," . "(to_date('" . $actividad->getFechaVencimiento() . "', 'YYYY-MM-DD'))," . floatval($actividad->getTipoActividad()) . ",'Activa')";

      }else
      {
        $insert = "INSERT INTO ACTIVIDAD (K_ACTIVIDAD,K_REGION,N_NOMBRE,N_DESCRIPCION,Q_INTENTOS,V_PORCENTAJE,F_CREACION,F_VENCIMIENTO,K_PREREQUISITO,K_TIPO_ACTIVIDAD,I_ESTADO)
                         VALUES (nextval('sec_actividades')," . 1 . ", '" . $actividad->getNombre(). "','" . $actividad->getDescripcion() . "', " . floatval($actividad->getIntentos()) . ",
                         " .floatval($actividad->getPorcentaje())/100 . ",current_date," . "(to_date('" . $actividad->getFechaVencimiento() . "', 'YYYY-MM-DD'))," . floatval($actividad->getPreRequisito()) . "," . floatval($actividad->getTipoActividad()) . ",'Activa')";
      }
      $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
      $idActividadConsult ="SELECT currval('sec_actividades') AS id";
      $resultConsultId =pg_query($idActividadConsult) or die('La consulta fallo: ' . pg_last_error());
      $line = pg_fetch_array( $resultConsultId, null, PGSQL_ASSOC);
 // se agregan las preguntas al cuestionario

      for($j=0;$j<count($preguntas);$j++){
        $insertCuestionario ="INSERT INTO CUESTIONARIO (K_PREGUNTA,K_ACTIVIDAD)
                              VALUES (".$preguntas[$j].",".$line['id'].")";
        $resultInser = pg_query($insertCuestionario) or die('La consulta fallo: ' . pg_last_error());
      }


      $configbd->cerrarSesion();

    }

   function actualizarActividad(Actividad_model $actividad){
      $configbd = new configbd_model();
      $dbconn4=$configbd->abrirSesion('profesor'); //mirar permisode editar colegio
      $update = "UPDATE ACTIVIDAD SET I_ESTADO = '".$actividad->getEstado()."' WHERE k_actividad = " . $actividad->getActividad().";";
      $resultInser = pg_query($update) or die('La consulta fallo: ' . pg_last_error());
      $configbd->cerrarSesion();
    }

}

?>
