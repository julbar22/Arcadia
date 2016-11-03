<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/estudiante_model.php";
require_once '../Arcadia/application/models/Datos/dao_reino_model.php';



class Dao_estudiante_model extends CI_Model {

    function __construct() {
        // $this->load->database();
        parent::__construct();
    }

    function estudianteLogin($valores) {
      // error_reporting(0);

       $configbd = new configbd_model();
       $configbd->inicioSesion($valores['codigo'],$valores['pass']);
       $dbconn4=$configbd->abrirSesion('estudiante');            

        if ($dbconn4) {
            $configbd->cerrarSesion();
            return true;
        } else {
            $configbd->cerrarSesion();
            return false;
        }
    }

    function estudianteReg($valores,Estudiante_model $estudiante) {

        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('admin');
        $consult = "SELECT * FROM ESTUDIANTE WHERE K_NICKNAME='" . $valores['codigo'] . "'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);

        if ($line['k_nickname'] == null) {

            $insert = "INSERT INTO ESTUDIANTE (K_NICKNAME,N_NOMBRE,N_APELLIDO,O_CORREO,F_NACIMIENTO,O_SEXO,O_NUM_TEL,N_COLEGIO,O_GRADO_ACTUAL) 
                         VALUES ('" . $estudiante->getNickname() . "', '" . $estudiante->getNombre() . "','" . $estudiante->getApellido() . "', '" . $estudiante->getCorreo() . "',
                         '" . $estudiante->getFechaNacimiento() . "', '" . $estudiante->getSexo() . "'," . $estudiante->getNumTel() . ",'" . $estudiante->getColegio() . "'," . $estudiante->getGradoActual() . " )";       
            $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
            $selectIdAvatar = "SELECT K_AVATAR FROM AVATAR WHERE O_IMAGEN= '" . $estudiante->getAvatar() . "'";
            $queryAvatar = pg_query($selectIdAvatar) or die('La consulta fallo: ' . pg_last_error());
            $line2 = pg_fetch_array($queryAvatar, null, PGSQL_ASSOC);

            $createAvatar = "INSERT INTO AVATAR_ESTUDIANTE(K_AVATAR,K_NICKNAME) VALUES (" . $line2['k_avatar'] . ",'" . $estudiante->getNickname() . "')";
            $queryCreate = pg_query($createAvatar) or die('La consulta fallo: ' . pg_last_error());
            $query = "CREATE USER e" . $valores['codigo'] . " IN GROUP estudiantes PASSWORD '" . $valores['pass'] . "'";
            $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
            $configbd->cerrarSesion();
            return false;
        } else {
             $configbd->cerrarSesion();
            return $estudiante;
        }
    }

    function avatarEst() {
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('admin');
        $query = "SELECT * FROM AVATAR";
        $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
        $avatares = array();
        $i = 0;
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $avatares[$i] = $line;
            $i++;
        }

        $configbd->cerrarSesion();
        return $avatares;
    }

    function perfilEstudiante() {
       
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('estudiante');        

        $consult2 = "SELECT * FROM VIEW_PERFIL_ESTUDIANTE WHERE K_NICKNAME='" . $_SESSION['codigo'] . "'";
        $resultConsult2 = pg_query($consult2) or die('La consulta fallo: ' . pg_last_error());
        
        $line = pg_fetch_array($resultConsult2, null, PGSQL_ASSOC);
        $estudiante = new Estudiante_model();
        $estudiante=$estudiante->crearEstudiante($line['k_nickname'],$line['n_nombre'],$line['n_apellido'],$line['o_correo'],"","",$line['o_num_tel'],$line['n_colegio'],$line['o_grado_actual'],$line['o_imagen']);
                
        $configbd->cerrarSesion();
        $a = new dao_reino_model();
          
        $estudiante->setReino($a->obtenerReinosEstudiante());
          
        return $estudiante;
    }

    function updatePerfilEstudiante(Estudiante_model $estudiante){
      $configbd = new configbd_model();
      $dbconn4=$configbd->abrirSesion('admin'); //mirar permisode editar colegio
      $update = "UPDATE ESTUDIANTE SET o_correo = '".$estudiante->getCorreo()."', o_num_tel = ".$estudiante->getNumTel().", n_colegio = '".$estudiante->getColegio()."', o_grado_actual = ".$estudiante->getGradoActual(). " WHERE k_nickname = '" . $estudiante->getNickname()."';";
      $resultInser = pg_query($update) or die('La consulta fallo: ' . pg_last_error());
      $configbd->cerrarSesion();
    }

}

?>
