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
        $validar=$this->dao_cuestionario_model->verPreguntas($_GET['k_reino']);
        $arrayPreguntas = array();
        for($i=0;$i<count($validar);$i++){
            $arrayPreguntas[$i]=$validar[$i]->crearArregloPregunta($validar[$i]);
            $arrayPreguntas[$i]['respuestas']=$validar[$i]->ArregloRespuestas();
        }
        $response['preguntas']=$arrayPreguntas;
        $this->load->view('Profesor/ListadoPreguntas',$response);
    }

    function crearPregunta(){        
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
                
                $this->dao_cuestionario_model->crearPregunta($newPregunta,$_POST['reinoIdModal']);         
                
                
         
        $response['reinoId']=$_POST['reinoIdModal'];      
        $validar=$this->dao_cuestionario_model->verPreguntas($_POST['reinoIdModal']);
        $arrayPreguntas = array();
        for($i=0;$i<count($validar);$i++){
            $arrayPreguntas[$i]=$validar[$i]->crearArregloPregunta($validar[$i]);
            $arrayPreguntas[$i]['respuestas']=$validar[$i]->ArregloRespuestas();
        }
        $response['preguntas']=$arrayPreguntas;
        $this->load->view('Profesor/ListadoPreguntas',$response);
                   
    }

    function eliminarPregunta(){
        $eliminacion=$this->dao_cuestionario_model->borrarPregunta($_GET['k_pregunta']);

        $response['reinoId']=$_GET['k_reino'];      
        $validar=$this->dao_cuestionario_model->verPreguntas($_GET['k_reino']);
        $arrayPreguntas = array();
        for($i=0;$i<count($validar);$i++){
            $arrayPreguntas[$i]=$validar[$i]->crearArregloPregunta($validar[$i]);
            $arrayPreguntas[$i]['respuestas']=$validar[$i]->ArregloRespuestas();
        }
        $response['preguntas']=$arrayPreguntas;
        $this->load->view('Profesor/ListadoPreguntas',$response);

    }

    function getPreguntas($idReino){
      
        $validar=$this->dao_cuestionario_model->verPreguntas($idReino);
        $arrayPreguntas = array();
        for($i=0;$i<count($validar);$i++){
            $arrayPreguntas[$i]=$validar[$i]->crearArregloPregunta($validar[$i]);            
        }
        $response['preguntas']=$arrayPreguntas;
        return $response;
    }
}

?>
