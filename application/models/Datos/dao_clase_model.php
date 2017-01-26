<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once "../Arcadia/application/models/clase_model.php";

class Dao_clase_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

   function obtenerClases(){
        $configbd = new configbd_model();
        $clase = new clase_model();
        $dbconn4=$configbd->abrirSesion('admin');
        $consulta = "SELECT * FROM clase";
        $resultConsulta = pg_query($consulta) or die('La consulta fallo: ' . pg_last_error());
        $i = 0;
        while ($line = pg_fetch_array($resultConsulta, null, PGSQL_ASSOC)) {
            $clases[$i] = $clase->crearClase($line['k_clase'],$line['n_nombre'],$line['n_poder'],$line['n_genero']);
            $clases[$i] = $clase->crearArregloClase($clases[$i]);
            $i++;
        }
        $configbd->cerrarSesion();
        return $clases;
    }

    function anexarAvatares($avatares, $clases){
        $clase = new Clase_model();
        for($i = 0; $i < count($avatares); $i++){
            for($j = 0; $j < count($clases); $j++){
                if($clases[$j]['n_nombre'] == "Guerrero" AND $avatares[$i]['n_nombre'] == "Granjero"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
                if($clases[$j]['n_nombre'] == "Mago" AND $avatares[$i]['n_nombre'] == "Aprendiz"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
                if($clases[$j]['n_nombre'] == "Slayer" AND $avatares[$i]['n_nombre'] == "Amazona"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
                if($clases[$j]['n_nombre'] == "CambiaFormas" AND $avatares[$i]['n_nombre'] == "Insecto"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
                if($clases[$j]['n_nombre'] == "Ranger" AND $avatares[$i]['n_nombre'] == "Elfo"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
                if($clases[$j]['n_nombre'] == "Guerrera" AND $avatares[$i]['n_nombre'] == "Cuidadora de Vacas"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
                if($clases[$j]['n_nombre'] == "Maga" AND $avatares[$i]['n_nombre'] == "Estudiosa"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
                if($clases[$j]['n_nombre'] == "CambiaPieles" AND $avatares[$i]['n_nombre'] == "Oruga"){
                    $clases[$j]['avatar'] = $avatares[$i];
                }
            }
        }
        return $clases;
    }

}

?>
