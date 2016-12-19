<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once '../Arcadia/application/controllers/Pregunta.php';

class Actividad extends CI_Controller {

    function __construct() {
        parent::__construct();

    }

    function formularioCrearActividad() {        
        $pregunta = new Pregunta();
        $response=$pregunta->getPreguntas($_GET['k_reino']);        
        $this->load->view('Profesor/CrearActividad',$response);
    }



}

?>
