<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/reino_model.php";
require_once '../Arcadia/application/models/Datos/dao_region_model.php';

class Dao_reino_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function crearReino(Reino_model $reino) {
        error_reporting(0);
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');

        $consult = "SELECT K_CEDULA FROM PROFESOR WHERE N_NICKNAME='" . $_SESSION['codigo'] . "'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $profesor = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);


        $insert = "INSERT INTO REINO (K_REINO,K_CEDULA,N_NOMBRE,I_ESTADO,N_HISTORIA,N_MISION,N_VISION,F_CREACION,K_IMAGEN_REINO,O_CODIGO) 
                         VALUES (nextval('sec_reinos')," . floatval($profesor['k_cedula']) . ", '" . $reino->getNombre(). "', 'Act', '" . $reino->getHistoria() . "',
                         '" . $reino->getMision() . "', '" . $reino->getVision() . "',current_date," . floatval($reino->getImagen()) . ",'" . $reino->getCodigo() . "')";
        $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
        $idReinoConsult ="SELECT currval('sec_reinos') AS id";
        $resultConsultId =pg_query($idReinoConsult) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array( $resultConsultId, null, PGSQL_ASSOC);
        $configbd->cerrarSesion();
        $region = new dao_region_model();
        $region->regionesGenericas($line['id']);

        return true;
    }

    function vincularReino($reino) {

        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('admin');//darle permiso al estudiante buscale una vista

        $consult = "SELECT O_CODIGO FROM REINO WHERE K_REINO='" . $reino['k_reino'] . "'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);
        if ($line['o_codigo'] == $reino['codigo']) {
            $insert = "INSERT INTO CALIFICACION_EN_REINO (K_NICKNAME,K_REINO) 
                         VALUES ('" . $_SESSION['codigo'] . "', " . $reino['k_reino'] . ")";
            $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
            $configbd->cerrarSesion();
            return true;
        } else {
            return false;
        }
    }

    function obtenerReinosCreados() {
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('estudiante');

        $consult = "SELECT * FROM VIEW_REINOS_CREADOS";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());

        $reinos = array();
        $i = 0;
        while ($line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC)) {
            $reino = new Reino_model();
            $reinos[$i] = $reino->crearReino($line['k_reino'],$line['n_nombre'],"","","",$line['n_historia'],$line['o_imagen'],"","",$line['n_nickname']); 
            $i++;
        }

        $configbd->cerrarSesion();
        return $reinos;
    }

    function obtenerImagenReinos() {
        //error_reporting(0);
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('admin');

        $consult = "SELECT * FROM REINO_AVATAR";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $reinosAvatar = array();
        $i = 0;
        while ($line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC)) {
            $reinosAvatar[$i] = $line;
            $i++;
        }

        $configbd->cerrarSesion();
        return $reinosAvatar;
    }

    function obtenerReinosProfesor() {
        //error_reporting(0);
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');

        $consult = "SELECT K_CEDULA FROM PROFESOR WHERE N_NICKNAME='" . $_SESSION['codigo']. "'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $profesor = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);

        $consult2 = "SELECT * FROM VIEW_REINOS_PROFESOR R WHERE R.K_CEDULA=" . floatval($profesor['k_cedula']) . "";
        $resultConsult2 = pg_query($consult2) or die('La consulta fallo: ' . pg_last_error());

        $reinosAvatar = array();
        $i = 0;
        while ($line = pg_fetch_array($resultConsult2, null, PGSQL_ASSOC)) {
            $reino = new Reino_model();
            $reinosAvatar[$i] = $reino->crearReino($line['k_reino'],$line['n_nombre'],"","",$line['f_creacion'],"",$line['o_imagen'],"","",$line['k_cedula']);
            $i++;
        }

        $configbd->cerrarSesion();
        return $reinosAvatar;
    }

    function obtenerReinosEstudiante() {
        //error_reporting(0);
         $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('estudiante');

        $consult2 = "SELECT * FROM VIEW_REINOS_ESTUDIANTE WHERE K_NICKNAME='" . $_SESSION['codigo']. "'";
        $resultConsult2 = pg_query($consult2) or die('La consulta fallo: ' . pg_last_error());

        $reinosAvatar = array();
        $i = 0;
        while ($line = pg_fetch_array($resultConsult2, null, PGSQL_ASSOC)) {
            
            $reino = new Reino_model();
            $reinosAvatar[$i] = $reino->crearReino($line['k_reino'],$line['n_nombre'],"","",$line['f_creacion'],"",$line['o_imagen'],"","",$line['n_nombre_profesor']);
            $i++;
        }
        $configbd->cerrarSesion();
        return $reinosAvatar;
    }

    function obtenerReinoEspecifico($data){
        //print_r($data['k_reino']);
        $conn_string = "host=localhost dbname=arcadiav4 user=admin_arcadia password=arcadia";
        $dbconn4 = pg_connect($conn_string) or die('No se ha podido conectar: ' . pg_last_error());
        $consult = "SELECT * FROM REINO WHERE K_REINO='".$data['k_reino']."'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());

        $datosReino = array();
        $i = 0;
        while ($line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC)) {
            $datosReino[$i] = $line;
            $i++;
        }
        //print_r($datosPerfil);
        pg_close($dbconn4);
        $b['perfilR'] = $datosReino;
        return $b;
    }

    function obtenerActividadesRegion($idReino){
        
        $region = new dao_region_model();
        $regiones=$region->obtenerRegionesPorReino($idReino);
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
        $consultView ="SELECT * FROM VIEW_ACTIVIDADES_REINO WHERE K_REINO=".$idReino;
        $resultView =  pg_query($consultView) or die('La consulta fallo: ' . pg_last_error());
        
        while ($line2 = pg_fetch_array($resultView, null, PGSQL_ASSOC)) {            
            $actividad = new Actividad_model();            
            for($h=0;$h<count($regiones);$h++){
                    if($line2['n_nombre_reg']==$regiones[$h]->getNombre()){                        
                        $actividad=$actividad->crearActividad($line2['k_actividad'],$line2['n_nombre'],$line2['n_descripcion'],$line2['q_intentos'],$line2['v_porcentaje'],$line2['f_creacion'],$line2['f_vencimiento'],$line2['k_prerequisito'],$line2['k_tipo_actividad'],"");
                        $regiones[$h]->agregarActividad($actividad);
                    }
            }          
        }

        $configbd->cerrarSesion();
        return $regiones;

    }

}

?>
