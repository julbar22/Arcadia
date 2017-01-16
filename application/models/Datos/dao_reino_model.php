<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/reino_model.php";
require_once '../Arcadia/application/models/Datos/dao_region_model.php';
require_once '../Arcadia/application/models/Datos/dao_actividad_model.php';
require_once "../Arcadia/application/models/anexo_model.php";

class Dao_reino_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Datos/dao_actividad_model');
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

    function obtenerReinoEspecifico($data,$rol){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion($rol);

        $consult = "SELECT * FROM REINO WHERE K_REINO='".$data['k_reino']."'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);
        $reino = new Reino_model();
        $reino = $reino->crearReino($line['k_reino'],$line['n_nombre'],"","",$line['f_creacion'],$line['n_historia'],"",$line['n_mision'],$line['n_vision'],"");

        $configbd->cerrarSesion();
        return $reino;
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
                        $actividad=$actividad->crearActividad($line2['k_actividad'],$line2['n_nombre'],$line2['n_descripcion'],$line2['q_intentos'],$line2['v_porcentaje'],$line2['f_creacion'],$line2['f_vencimiento'],$line2['k_prerequisito'],$line2['k_tipo_actividad'],"",$line2['i_estado']);
                        $regiones[$h]->agregarActividad($actividad);
                    }
            }
        }

        $configbd->cerrarSesion();
        return $regiones;

    }

    function obtenerActividadesRegionEst($idReino){

        $region = new dao_region_model();
        $regiones=$region->obtenerRegionesPorReinoEst($idReino);
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('estudiante');
        $consultView ="SELECT * FROM VIEW_ACTIVIDADES_REINO WHERE K_REINO=".$idReino;
        $resultView =  pg_query($consultView) or die('La consulta fallo: ' . pg_last_error());
        $consultAnexos = "SELECT * FROM anexo WHERE K_ACTIVIDAD=";
        $consultRespuestas = "SELECT * FROM actividad_resuelta WHERE K_ACTIVIDAD=";

        while ($line2 = pg_fetch_array($resultView, null, PGSQL_ASSOC)) {
            $actividad = new Actividad_model();
            for($h=0;$h<count($regiones);$h++){
                    if($line2['n_nombre_reg']==$regiones[$h]->getNombre()){

                        if ($line2['i_estado'] == "Activa" AND $this->dao_actividad_model->validarFechaVencimientoActividad($line2['f_vencimiento'], $line2['k_actividad'])){
                                $line2['i_estado'] = "Cerrada";
                        }

                        $actividad=$actividad->crearActividad($line2['k_actividad'],$line2['n_nombre'],$line2['n_descripcion'],$line2['q_intentos'],$line2['v_porcentaje'],$line2['f_creacion'],$line2['f_vencimiento'],$line2['k_prerequisito'],$line2['k_tipo_actividad'],"",$line2['i_estado']);
                        $regiones[$h]->agregarActividad($actividad);

                        if ($line2['k_tipo_actividad']==1){
                            $resultQuery = pg_query($consultAnexos.$line2['k_actividad']) or die('La consulta fallo: ' . pg_last_error());
                            $line3 = pg_fetch_array($resultQuery, null, PGSQL_ASSOC);

                            $anexo = new Anexo_model();
                            $anexo = $anexo->crearAnexo($line3['k_anexo'],$line3['k_actividad'],$line3['n_nombre'],$line3['n_description']);
                            $actividad->agregarAnexo($anexo);
                        }
                          $query = $consultRespuestas.$line2['k_actividad']." AND K_NICKNAME='".$_SESSION['codigo']."'";
                          $resultQuery = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

                          $intentos = 0;
                          while ($line4 = pg_fetch_array($resultQuery, null, PGSQL_ASSOC))
                          {
                              $intentos++;
                          }
                          $actividad->setIntentosRealizados($intentos);
              }
            }
        }
        $configbd->cerrarSesion();
        return $regiones;
    }

    function obtenerActividadesYNotaRegionEst($idReino){

        $region = new dao_region_model();
        $regiones=$region->obtenerRegionesPorReinoEst($idReino);
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('estudiante');
        $consultView ="SELECT * FROM VIEW_ACTIVIDADES_REINO WHERE K_REINO=".$idReino;
        $resultView =  pg_query($consultView) or die('La consulta fallo: ' . pg_last_error());
        $consultAnexos = "SELECT * FROM anexo WHERE K_ACTIVIDAD=";
        $consultRespuestas = "SELECT * FROM actividad_resuelta WHERE K_ACTIVIDAD=";

        while ($line2 = pg_fetch_array($resultView, null, PGSQL_ASSOC)) {
            $actividad = new Actividad_model();
            for($h=0;$h<count($regiones);$h++){
                if($line2['n_nombre_reg']==$regiones[$h]->getNombre()){
                    $actividad=$actividad->crearActividad($line2['k_actividad'],$line2['n_nombre'],$line2['n_descripcion'],$line2['q_intentos'],$line2['v_porcentaje'],$line2['f_creacion'],$line2['f_vencimiento'],$line2['k_prerequisito'],$line2['k_tipo_actividad'],"",$line2['i_estado']);
                    $regiones[$h]->agregarActividad($actividad);
                        if ($line2['k_tipo_actividad']==1){
                            $resultQuery = pg_query($consultAnexos.$line2['k_actividad']) or die('La consulta fallo: ' . pg_last_error());
                            $line3 = pg_fetch_array($resultQuery, null, PGSQL_ASSOC);
                            $anexo = new Anexo_model();
                            $anexo = $anexo->crearAnexo($line3['k_anexo'],$line3['k_actividad'],$line3['n_nombre'],$line3['n_description']);
                            $actividad->agregarAnexo($anexo);
                        }
                        $query = $consultRespuestas.$line2['k_actividad']." AND K_NICKNAME='".$_SESSION['codigo']."'";
                        $resultQuery = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
                        $nota = 0.00;
                        $intentos = 0;
                        while ($line4 = pg_fetch_array($resultQuery, null, PGSQL_ASSOC))
                        {
                            $nota = $line4['v_nota'];
                            $intentos++;
                        }
                        $actividad->setIntentosRealizados($intentos);
                        $actividad->setNota($nota);
                    }
                }
        }
        $configbd->cerrarSesion();
        return $regiones;
    }

    function obtenerEstudiantesReino($idReino){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
        $consulta = "SELECT * FROM CALIFICACION_EN_REINO WHERE K_REINO =".$idReino;
        $resultQuery = pg_query($consulta) or die('La consulta fallo: ' . pg_last_error());
        $counter = 0;
        while ($line4 = pg_fetch_array($resultQuery, null, PGSQL_ASSOC))
        {
            $estudiantes[$counter] = $line4['k_nickname'];
            $counter++;
        }
        return $estudiantes;
    }

}

?>
