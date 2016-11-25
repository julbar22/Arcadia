<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad extends CI_Controller {

    function __construct() {
        parent::__construct();

    }

    function formularioCrearActividad() {
        $this->load->view('Profesor/CrearActividad');
    }



}

?>
