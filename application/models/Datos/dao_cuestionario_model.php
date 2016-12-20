<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/pregunta_model.php";
require_once '../Arcadia/application/models/Datos/configbd_model.php';

class Dao_cuestionario_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function crearPregunta(Pregunta_model $pregunta,$idReino) {        
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
            $insert = "INSERT INTO pregunta (K_PREGUNTA,N_TIPO_PREGUNTA,O_PREGUNTA,K_REINO) 
                       VALUES (nextval('sec_preguntas'),'" . $pregunta->getTipoPregunta(). "', '" . $pregunta->getPregunta(). "',".$idReino.")";
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

    function verPreguntas($idReino){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
        $query = "SELECT * FROM PREGUNTA WHERE K_REINO=".$idReino;
        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
        $preguntas = array();
        $i = 0;
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {            
            $newPregunta = new Pregunta_model();
            $newPregunta=$newPregunta->crearPregunta($line['k_pregunta'],$line['n_tipo_pregunta'],$line['o_pregunta']);
            $queryRespuestas = "SELECT * FROM RESPUESTA WHERE K_PREGUNTA=".$line['k_pregunta'];
            $resultRespuestas = pg_query($queryRespuestas) or die('La consulta fallo: ' . pg_last_error());
            $respuestas = array();
            $j= 0;
            while ($lineRespuestas = pg_fetch_array($resultRespuestas, null, PGSQL_ASSOC)) { 
                $newRespuesta= new Respuesta_model();
                $newRespuesta=$newRespuesta->crearRespuesta($lineRespuestas['k_respuesta'],$lineRespuestas['k_pregunta'],$lineRespuestas['o_opcion'],$lineRespuestas['o_respuesta']);
                $respuestas[$j]=$newRespuesta;
                $j++;
            }
            $newPregunta->setRespuesta($respuestas);
            $preguntas[$i] = $newPregunta;
            $i++;
        }
        $configbd->cerrarSesion();
        return $preguntas;
    }

    function borrarPregunta($idPregunta){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');

        $queryRespuestas = "DELETE FROM RESPUESTA WHERE K_PREGUNTA=".$idPregunta;
        $resultRespuestas = pg_query($queryRespuestas) or die('La consulta fallo: ' . pg_last_error());

        $query = "DELETE FROM PREGUNTA WHERE K_PREGUNTA=".$idPregunta;
        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());               
      
        $configbd->cerrarSesion();

        return true;

    }


}

?>
