<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/pregunta_model.php";
require_once '../Arcadia/application/models/Datos/configbd_model.php';

class Dao_cuestionario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function crearPregunta(pregunta_model $pregunta) {        
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
            $insert = "INSERT INTO pregunta (K_PREGUNTA,N_TIPO_PREGUNTA,O_PREGUNTA) 
                       VALUES (nextval('sec_preguntas'),'" . $pregunta->getTipoPregunta(). "', '" . $pregunta->getPregunta(). "')";
            $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
            $idpreguntaConsult ="SELECT currval('sec_preguntas') AS id";
            $resultConsultId =pg_query($idpreguntaConsult) or die('La consulta fallo: ' . pg_last_error());
            $line = pg_fetch_array( $resultConsultId, null, PGSQL_ASSOC);

        if($pregunta->getTipoPregunta()=="abierta"){
            $insertRespuesta = "INSERT INTO respuesta (K_RESPUESTA,K_PREGUNTA,O_OPCION,O_RESPUESTA) 
                       VALUES (nextval('sec_respuestas')," . $line['id'] . ",'" . $pregunta->getRespuesta()->getRespuesta(). "',true)";
                     
            $resultInser = pg_query($insertRespuesta) or die('La consulta fallo: ' . pg_last_error());
        }else{
            for($i=0;$i<4;$i++){
                print_r($pregunta->getRespuesta());
             $insertRespuesta = "INSERT INTO respuesta (K_RESPUESTA,K_PREGUNTA,O_OPCION,O_RESPUESTA) 
                       VALUES (nextval('sec_respuestas')," . $line['id'] . ",'" . $pregunta->getRespuesta()[$i]->getRespuesta(). "',".$pregunta->getRespuesta()[$i]->getOpcionVerdadera().")";
                        
             $resultInser = pg_query($insertRespuesta) or die('La consulta fallo: ' . pg_last_error());

            }

        }



        $configbd->cerrarSesion();
        return true;
    }


}

?>
