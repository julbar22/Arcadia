<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/profesor_model.php";
require_once '../Arcadia/application/models/Datos/dao_reino_model.php';


/**
 * 
 */
class Dao_profesor_model extends CI_Model {

    function __construct() {
        // $this->load->database();        
        parent::__construct();
    }

    function profesorLogin($valores) {
        
       $configbd = new configbd_model();
       $configbd->inicioSesion($valores['codigo'],$valores['pass']);
       $dbconn4=$configbd->abrirSesion('profesor');  

        if ($dbconn4) {
            $configbd->cerrarSesion();
            return true;
        } else {
            $configbd->cerrarSesion();
            return false;
        }
    }

    function profesorReg($valores, Profesor_model $profesor) {

        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('admin');        
        $consult = "SELECT * FROM PROFESOR WHERE N_NICKNAME='" . $valores['codigo'] . "' OR K_CEDULA=" . $profesor->getCedula();
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);

        if ($line['n_nickname'] == null) {

            $insert = "INSERT INTO PROFESOR (K_CEDULA,N_NOMBRE,N_APELLIDO,O_CORREO,N_NICKNAME,N_COLEGIO,O_NUM_TEL) 
                         VALUES (" . $profesor->getCedula(). ", '" . $profesor->getNombre() . "', '" . $profesor->getApellido() . "', '" . $profesor->getCorreo() . "',
                         '" . $profesor->getNickname() . "', '" . $profesor->getColegio() . "'," . $profesor->getNumTel() . " )";
            $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
            $selectIdAvatar = "SELECT K_AVATAR FROM AVATAR WHERE O_IMAGEN= '" . $profesor->getAvatar() . "'";
            $queryAvatar = pg_query($selectIdAvatar) or die('La consulta fallo: ' . pg_last_error());
            $line2 = pg_fetch_array($queryAvatar, null, PGSQL_ASSOC);

            $createAvatar = "INSERT INTO AVATAR_PROFESOR (K_AVATAR,K_CEDULA) VALUES (" . $line2['k_avatar'] . "," . $profesor->getCedula() . ")";
            $queryCreate = pg_query($createAvatar) or die('La consulta fallo: ' . pg_last_error());
            $query = "CREATE USER p" . $valores['codigo'] . " IN GROUP profesores PASSWORD '" . $valores['pass'] . "'";
            $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
            $configbd->cerrarSesion();
            return false;
        } else {
            $configbd->cerrarSesion();
            return $profesor;
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

    function perfilProfesor() {

        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');

        $consult2 = "SELECT * FROM VIEW_PERFIL_PROFESOR WHERE N_NICKNAME='" . $_SESSION['codigo'] . "'";
        $resultConsult2 = pg_query($consult2) or die('La consulta fallo: ' . pg_last_error());
       
        $line = pg_fetch_array($resultConsult2, null, PGSQL_ASSOC);
        
        $profesor=$this->crearProfesor($line);

        $configbd->cerrarSesion();
        $a = new dao_reino_model();

        $profesor->setReinos($a->obtenerReinosProfesor());
       
        return $profesor;      
    }

    function crearProfesor($profesor){

        $newProfesor= new profesor_model();
        $newProfesor->setCedula($profesor['k_cedula']);
        $newProfesor->setNickname($profesor['n_nickname']);
        $newProfesor->setNombre($profesor['n_nombre']);
        $newProfesor->setApellido($profesor['n_apellido']);
        $newProfesor->setCorreo($profesor['o_correo']);
        $newProfesor->setNumTel($profesor['o_num_tel']);
        $newProfesor->setColegio($profesor['n_colegio']);        
        $newProfesor->setAvatar($profesor['o_imagen']);            
        return $newProfesor;
               
    }

}

?>