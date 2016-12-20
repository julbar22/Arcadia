<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    session_start();

    class Configbd_model extends CI_Model{
     
        public $dbconn4;

        public function __construct(){
            
        }

        public function inicioSesion($user,$pass){
             $_SESSION['codigo'] = $user;
             $_SESSION['pass'] = $pass;

        }

        public function abrirSesion($type){
           
        	switch ($type) {
        		case 'estudiante':
                    $user = $_SESSION['codigo'];
                    $pass = $_SESSION['pass'];                   
        			 $conn_string = "host=localhost dbname=arcadiav5 user= e" . strtolower($user) . " password=" .$pass;
                     $this->dbconn4 = pg_connect($conn_string);                     
                     return true;
        			break;
        		case 'profesor':
                    $user = $_SESSION['codigo'];
                    $pass = $_SESSION['pass'];
                    
        			$conn_string = "host=localhost dbname=arcadiav5 user= p" . strtolower($user) . " password=" .$pass;
                   
                     $this->dbconn4 = pg_connect($conn_string);
                     return true;
        			break;        				
        		
        		default:
        			$conn_string = "host=localhost dbname=arcadiav5 user='admin_arcadia' password='arcadia'";
                     $this->dbconn4 = pg_connect($conn_string);
                     return true;
        			break;
        	}

        }

        public function cerrarSesion(){

             pg_close($this->dbconn4);
        }

    }
?>
