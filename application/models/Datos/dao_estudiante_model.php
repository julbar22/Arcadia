<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/estudiante_model.php";
require_once '../Arcadia/application/models/Datos/dao_reino_model.php';



class Dao_estudiante_model extends CI_Model {

    function __construct() {
        // $this->load->database();
        parent::__construct();
    }

    function verNickname(){

        return $_SESSION['codigo'];
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

            $insert = "INSERT INTO ESTUDIANTE (K_NICKNAME,N_NOMBRE,N_APELLIDO,O_CORREO,F_NACIMIENTO,O_SEXO,O_NUM_TEL,N_COLEGIO,O_GRADO_ACTUAL,K_CLASE)
                         VALUES ('" . $estudiante->getNickname() . "', '" . $estudiante->getNombre() . "','" . $estudiante->getApellido() . "', '" . $estudiante->getCorreo() . "',
                         '" . $estudiante->getFechaNacimiento() . "', '" . $estudiante->getSexo() . "'," . $estudiante->getNumTel() . ",'" . $estudiante->getColegio() . "'," . $estudiante->getGradoActual() ." , ". $estudiante->getClase() ." )";
            $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());

            $insertTitulo = "INSERT INTO honor_estudiante (k_honor_estudiante, k_nickname, k_tipo_honor, n_description, q_cantidad, i_estado)
                              VALUES (nextval('sec_honores'), '".$estudiante->getNickname()."' , 0 , '".$valores['titulo']."',1, 'Activo')";
            $resultInserTitulo = pg_query($insertTitulo) or die('La consulta fallo: ' . pg_last_error());

            $createAvatar = "INSERT INTO AVATAR_ESTUDIANTE(K_AVATAR,K_NICKNAME,I_ESTADO) VALUES (" . $estudiante->getAvatar() . ",'" . $estudiante->getNickname() . "','Activo')";
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

        $consult = "SELECT * FROM VIEW_PERFIL_ESTUDIANTE WHERE K_NICKNAME='" . $_SESSION['codigo'] . "'";
        $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);
        $consultClase ="SELECT n_nombre FROM clase WHERE k_clase = ".$line['k_clase'];
        $resultConsultaClase = pg_query($consultClase) or die('La consulta fallo: ' . pg_last_error());
        $line2 = pg_fetch_array($resultConsultaClase, null, PGSQL_ASSOC);
        $estudiante = new Estudiante_model();
        $estudiante=$estudiante->crearEstudiante($line['k_nickname'],$line['n_nombre'],$line['n_apellido'],$line['o_correo'],"","",$line['o_num_tel'],$line['n_colegio'],$line['o_grado_actual'],$line['o_imagen'],$line2['n_nombre']);
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

    function obtenerListaEstudiantes($listaEstudiantes){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
        $consult = "SELECT * FROM ESTUDIANTE WHERE K_NICKNAME ='";
        for($j = 0; $j < count($listaEstudiantes); $j++){
            $resultConsult = pg_query($consult.$listaEstudiantes[$j]."'") or die('La consulta fallo: ' . pg_last_error());
            $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);
            $estudiante = new estudiante_model();
            $estudiante=$estudiante->crearEstudiante($line['k_nickname'],$line['n_nombre'],$line['n_apellido'],$line['o_correo'],"","",$line['o_num_tel'],$line['n_colegio'],$line['o_grado_actual'],"",$line['k_clase']);
            $arregloEstudiantes[$j] = $estudiante;
        }
        $configbd->cerrarSesion();
        return $arregloEstudiantes;
    }

    function vinvularPremiosEstudiante($reino){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('estudiante');
        $insert = "INSERT INTO PREMIO (K_PREMIO, K_REINO, K_NICKNAME, K_TIPO_PREMIO, N_NOMBRE, N_VALOR)
                   VALUES (nextval('sec_premios'),".$reino.",'".$_SESSION['codigo']."',0,'Oro',0)";
        $resultInsert = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
    }

    function obtenerHonores($nickname,$sesion){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion($sesion);
        $consultaHonores = "SELECT * FROM honor_estudiante WHERE k_nickname = '".$nickname."' AND i_estado = 'Activo'";
        $resultConsulta= pg_query($consultaHonores) or die('La consulta fallo: ' . pg_last_error());
        $respuesta;
        while ($line = pg_fetch_array($resultConsulta, null, PGSQL_ASSOC)) {
            if($line['k_tipo_honor'] == 0)
                $respuesta['titulo']=$line['n_description'];
        }
        $configbd->cerrarSesion();
        return $respuesta;
    }

    function obtenerTitulos($nickname,$sesion){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion($sesion);
        $consultaHonores = "SELECT * FROM honor_estudiante WHERE k_nickname = '".$nickname."'";
        $resultConsulta= pg_query($consultaHonores) or die('La consulta fallo: ' . pg_last_error());
        $respuesta;
        $i = 0;
        while ($line = pg_fetch_array($resultConsulta, null, PGSQL_ASSOC)) {
            if($line['k_tipo_honor'] == 0){
              $respuesta[$i]['titulo']=$line['n_description'];
              $respuesta[$i]['estado']=$line['i_estado'];
              $i++;
            }
        }
        $configbd->cerrarSesion();
        return $respuesta;
    }

    function obtenerAvatares($nickname,$sesion){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion($sesion);
        $consultaAvatares = "SELECT * FROM avatar_estudiante WHERE k_nickname = '".$nickname."'";
        $consultaAv = "SELECT * FROM AVATAR WHERE k_avatar =";
        $resultConsulta= pg_query($consultaAvatares) or die('La consulta fallo: ' . pg_last_error());
        $respuesta;
        $i = 0;
        while ($line = pg_fetch_array($resultConsulta, null, PGSQL_ASSOC)) {
              $resultConsultaAv= pg_query($consultaAv.$line['k_avatar']) or die('La consulta fallo: ' . pg_last_error());
              $line2 = pg_fetch_array($resultConsultaAv, null, PGSQL_ASSOC);
              $respuesta[$i]['avatar']=$line2['o_imagen'];
              $respuesta[$i]['nombre']=$line2['n_nombre'];
              $respuesta[$i]['id']=$line2['k_avatar'];
              $respuesta[$i]['estado']=$line['i_estado'];
              $i++;
        }
        $configbd->cerrarSesion();
        return $respuesta;
    }

      function obtenerPremios($nickname, $reino, $sesion){
          $configbd = new configbd_model();
          $dbconn4=$configbd->abrirSesion($sesion);
          $consultaPremios = "SELECT * FROM premio WHERE k_nickname = '".$nickname."' AND k_reino = ".$reino;
          $resultConsulta= pg_query($consultaPremios) or die('La consulta fallo: ' . pg_last_error());
          $respuesta;
          while ($line = pg_fetch_array($resultConsulta, null, PGSQL_ASSOC)) {
              if($line['k_tipo_premio'] == 0)
                  $respuesta['oro']=$line['n_valor'];
          }
          $configbd->cerrarSesion();
          return $respuesta;
      }

      function notaEnReino($nickname, $reino, $sesion){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion($sesion);
        $consultaNota = "SELECT * FROM calificacion_en_reino WHERE k_nickname = '".$nickname."' AND k_reino = ".$reino;
        $consultNivel = "SELECT * FROM nivel WHERE k_nivel = ";
        $resultConsultaCalificacion = pg_query($consultaNota) or die('La consulta fallo: ' . pg_last_error());
        $line = pg_fetch_array($resultConsultaCalificacion, null, PGSQL_ASSOC);
        $resultConsultaNivel = pg_query($consultNivel.$line['k_nivel']) or die('La consulta fallo: ' . pg_last_error());
        $line2 = pg_fetch_array($resultConsultaNivel, null, PGSQL_ASSOC);
        $nota['valor'] = $line['v_acumulado'];
        $nota['nivel'] = $line2['n_nombre'];
        $nota['clase'] = $line2['v_clase'];
        $configbd->cerrarSesion();
        return $nota;
      }

      function actualizarAvatar($k_avatar, $nickname, $sesion){
          $configbd = new configbd_model();
          $dbconn4=$configbd->abrirSesion($sesion);
          $update1 = "UPDATE avatar_estudiante SET i_estado = 'Inactivo' WHERE k_nickname = '".$nickname."'";
          $update2 = "UPDATE avatar_estudiante SET i_estado = 'Activo' WHERE k_nickname = '".$nickname."' AND k_avatar = ".$k_avatar;
          $resultUpdate = pg_query($update1) or die('La consulta fallo: ' . pg_last_error());
          $resultUpdate = pg_query($update2) or die('La consulta fallo: ' . pg_last_error());
          $configbd->cerrarSesion();
      }

      function actualizarTitulo($n_descripcion, $nickname, $sesion){
          $configbd = new configbd_model();
          $dbconn4=$configbd->abrirSesion($sesion);
          $update1 = "UPDATE honor_estudiante SET i_estado = 'Inactivo' WHERE k_nickname = '".$nickname."'";
          $update2 = "UPDATE honor_estudiante SET i_estado = 'Activo' WHERE k_nickname = '".$nickname."' AND n_description = '".$n_descripcion."'";
          $resultUpdate = pg_query($update1) or die('La consulta fallo: ' . pg_last_error());
          $resultUpdate = pg_query($update2) or die('La consulta fallo: ' . pg_last_error());
          $configbd->cerrarSesion();
      }

      function verificarNivelNuevo($nivel, $estudiante, $sesion){
          $configbd = new configbd_model();
          $dbconn4=$configbd->abrirSesion($sesion);
          $consulta = "SELECT * FROM nivel WHERE k_nivel = ".$nivel;
          $consulta2 = "SELECT * FROM honor_estudiante WHERE k_nickname = '".$estudiante."'";
          $consulta3 = "SELECT o_sexo FROM estudiante WHERE k_nickname = '".$estudiante."'";
          $consulta4 = "SELECT k_avatar FROM avatar WHERE n_nombre = '";
          $resultConsulta = pg_query($consulta) or die('La consulta fallo: ' . pg_last_error());
          $line = pg_fetch_array($resultConsulta, null, PGSQL_ASSOC);
          $resultConsulta2 = pg_query($consulta2) or die('La consulta fallo: ' . pg_last_error());
          $nivelNuevo = "true";
          while ($line2 = pg_fetch_array($resultConsulta2, null, PGSQL_ASSOC)) {
              $titulo = explode(" ",$line2['n_description']);
              $titulo2 = "";
              for($i = 1; $i<count($titulo); $i++){
                  $titulo2 = $titulo2.$titulo[$i]." ";
              }
        //      echo $titulo2." : ".$line['n_nombre']."<br>";
              if (strcmp($titulo2,$line['n_nombre'])){
                $nivelNuevo = "false";
              }
          }
          echo $nivelNuevo;
          if($nivelNuevo == "true"){
              echo "nivelNuevo";
              $resultConsulta3 = pg_query($consulta3) or die('La consulta fallo: ' . pg_last_error());
              $line4 = pg_fetch_array($resultConsulta3, null, PGSQL_ASSOC);
              if($line4['o_sexo'] == "M"){
                  $nuevoTitulo = "El ".$line['n_nombre'];
              } else {
                  $nuevoTitulo = "La ".$line['n_nombre'];
              }
              $insertTitulo = "INSERT INTO honor_estudiante (k_honor_estudiante, k_nickname, k_tipo_honor, n_description, q_cantidad, i_estado)
                                VALUES (nextval('sec_honores'), '".$estudiante."' , 0 , '".$nuevoTitulo."',1, 'Inactivo')";
              $resultInsert = pg_query($insertTitulo) or die('La consulta fallo: ' . pg_last_error());
              $resultConsulta4 = pg_query($consulta4.$line['n_nombre']."'") or die('La consulta fallo: ' . pg_last_error());
              $line5 = pg_fetch_array($resultConsulta4, null, PGSQL_ASSOC);
              $insertAvatar = "INSERT INTO AVATAR_ESTUDIANTE(K_AVATAR,K_NICKNAME,I_ESTADO) VALUES (" . $line5['k_avatar'] . ",'" . $estudiante . "','Inactivo')";
              $resultInsert2 = pg_query($insertAvatar) or die('La consulta fallo: ' . pg_last_error());
          }
          $configbd->cerrarSesion();
      }
}

?>
