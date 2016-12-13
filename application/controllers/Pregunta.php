<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pregunta extends CI_Controller {

    function __construct() {
        parent::__construct();
         $this->load->model('Datos/dao_cuestionario_model'); 
          $this->load->model('pregunta_model');
          $this->load->model('respuesta_model');

    }

    function listadoPreguntasC(){
        $this->load->view('Profesor/ListadoPreguntas');
    }

    function crearPregunta(){
        if ($_POST['inlineRadioOptions']=="abierta"){
                  $newPregunta = new Pregunta_model();                                                                                                                                                        
                  $newPregunta = $newPregunta->crearPregunta("","abierta",$_POST['pregunta']);
                  $newRespuesta = new Respuesta_model();
                  $newRespuesta = $newRespuesta->crearRespuesta("","",true,$_POST['r1']);
                  $newPregunta->setRespuesta($newRespuesta);
                  $this->dao_cuestionario_model->crearPregunta($newPregunta);
             
        }else{
                $newPregunta = new Pregunta_model();                                                                                                                                                        
                $newPregunta = $newPregunta->crearPregunta("","cerrada",$_POST['pregunta']);
                $respuestas =array();
                for($i=0;$i<4;$i++){
                    $newRespuesta = new Respuesta_model();
                    $option= "option".($i+1);
                    if($_POST['RadioOptions']==$option){
                        $newRespuesta = $newRespuesta->crearRespuesta("","","true",$_POST[$option]);
                    }else{                        
                       
                        $newRespuesta = $newRespuesta->crearRespuesta("","","false",$_POST[$option]);
                    }
                    
                    $respuestas[$i]=$newRespuesta;
                }

                $newPregunta->setRespuesta($respuestas);
                $this->dao_cuestionario_model->crearPregunta($newPregunta);                
            
                
        }              
    }
}

?>
