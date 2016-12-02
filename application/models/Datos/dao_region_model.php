<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once "../Arcadia/application/models/region_model.php";
require_once '../Arcadia/application/models/Datos/configbd_model.php';

class Dao_region_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function regionesGenericas($idReino){
       
        $r1 = new Region_model();
        $r1=$r1->crearRegion("","Avalon","",100,100,"/Arcadia/assets/imagenes/Regiones/avalonlogo.png");
        $r2 = new Region_model();
        $r2=$r2->crearRegion("","Azeroth","",500,100,"/Arcadia/assets/imagenes/Regiones/azerothlogo.png");
        $r3 = new Region_model();
        $r3=$r3->crearRegion("","Icaria","",100,500,"/Arcadia/assets/imagenes/Regiones/icarialogo.png");
        $r4 = new Region_model();
        $r4=$r4->crearRegion("","Kalinov","",500,500,"/Arcadia/assets/imagenes/Regiones/kalinovlogo.png");
        $regiones[0]=$r1;
        $regiones[1]=$r2;
        $regiones[2]=$r3;
        $regiones[3]=$r4;
        
        for($i=0;$i<count($regiones);$i++){
            $this->crearRegionDao($regiones[$i],$idReino);
        }
        return true;
    }

    function crearRegionDao(Region_model $region,$idReino) {       
        //print_r($region);
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');

        $insert = "INSERT INTO REGION (K_REGION,K_REINO,N_NOMBRE,I_ESTADO,O_POSICIONX,O_POSICIONY,O_IMAGEN) 
                         VALUES (nextval('sec_regiones')," . $idReino . ", '" . $region->getNombre(). "', 'Act', " . $region->getxMapa() . ",
                         " . $region->getyMapa() . ", '" . $region->getImagen() . "')";
        $resultInser = pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
        $configbd->cerrarSesion();
        print_r($idReino);
        return true;
    }

    function obtenerRegionesPorReino($idReino){
        $configbd = new configbd_model();
        $dbconn4=$configbd->abrirSesion('profesor');
        $consult2 = "SELECT * FROM REGION WHERE K_REINO=" . $idReino;
        $resultConsult2 = pg_query($consult2) or die('La consulta fallo: ' . pg_last_error());
        $regiones = array();
        $i = 0;
        while ($line = pg_fetch_array($resultConsult2, null, PGSQL_ASSOC)) {
            
            $region = new Region_model();
            $regiones[$i] = $region->crearRegion($line['k_region'],$line['n_nombre'],$line['i_estado'],$line['o_posicionx'],$line['o_posiciony'],$line['o_imagen']);
            $i++;
        }
          $configbd->cerrarSesion();
          return $regiones;      

    }

}

?>
