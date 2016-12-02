<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pregunta extends CI_Controller {

    function __construct() {
        parent::__construct();

    }

    function listadoPreguntasC(){
        $this->load->view('Profesor/ListadoPreguntas');
    }



}

?>
