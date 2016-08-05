          <?php
          defined('BASEPATH') OR exit('No direct script access allowed');

        
          require_once "../Arcadia/application/models/reino_model.php";       
     
         
          session_start();
          
          /**
          * 
          */
          class Dao_reino_model extends CI_Model
          {
        
          function __construct()
          {                
          parent::__construct();
          }
          

          function crearReino($reino) 
          {
            error_reporting(0);
           $user =$_SESSION['codigo'];
           $pass =$_SESSION['pass'];     
           
             $conn_string = "host=localhost dbname=arcadiav2 user=p".strtolower($user)." password=".$pass;
             $dbconn4 = pg_connect($conn_string) 
             or die('No se ha podido conectar: ' . pg_last_error());   

             $consult="SELECT K_CEDULA FROM PROFESOR WHERE O_NICKNAME='p".$user."'";
             $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());             
             $profesor = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);      
             
             print_r($profesor);

             $insert ="INSERT INTO REINO (K_REINO,K_CEDULA,N_NOMBRE,I_ESTADO,N_HISTORIA,N_MISION,N_VISION,F_CREACION,K_IMAGEN_REINO,O_CODIGO) 
                         VALUES (nextval('sec_reinos'),".floatval($profesor['k_cedula']).", '".$reino['nombre']."', 'Act', '".$reino['historia']."',
                         '".$reino['mision']."', '".$reino['vision']."',current_date,".floatval($reino['imagen']).",'".$reino['codigo']."')";
             $resultInser= pg_query($insert) or die('La consulta fallo: ' . pg_last_error());                                                         
              pg_close($dbconn4);
              return true;
           
              }

          function vincularReino($reino){
                
            //error_reporting(0);
           $user=$_SESSION['codigo'];
           $pass=$_SESSION['pass'];

             $conn_string = "host=localhost dbname=arcadiav2 user=e".strtolower($user)." password=".$pass;
             $dbconn4 = pg_connect($conn_string) 
             or die('No se ha podido conectar: ' . pg_last_error());  

             $consult="SELECT O_CODIGO FROM REINO WHERE K_REINO='".$reino['k_reino']."'"; 
             $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());  
             $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);
             if ($line['o_codigo']==$reino['codigo']) {
                     $insert ="INSERT INTO CALIFICACION_EN_REINO (K_NICKNAME,K_REINO) 
                         VALUES ('".$user."', ".$reino['k_reino'].")";
                     $resultInser= pg_query($insert) or die('La consulta fallo: ' . pg_last_error());               
              pg_close($dbconn4);  
              return true;
              }else{
                return false;
              }


                     
                   
          } 

          function obtenerReinosCreados(){
              //error_reporting(0);
           $user=$_SESSION['codigo'];
           $pass=$_SESSION['pass'];

             $conn_string = "host=localhost dbname=arcadiav2 user=e".strtolower($user)." password=".$pass;
             $dbconn4 = pg_connect($conn_string) 
             or die('No se ha podido conectar: ' . pg_last_error());   

             $consult="SELECT R.K_REINO, R.N_NOMBRE,R.N_HISTORIA,IR.O_IMAGEN,P.O_NICKNAME FROM REINO R,PROFESOR P, REINO_AVATAR IR WHERE R.K_CEDULA=P.K_CEDULA AND R.K_IMAGEN_REINO=IR.K_IMAGEN_REINO AND R.I_ESTADO='Act'";
             $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());             
             
             $reinos = array();
             $i=0;
             while($line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC)){
             $reinos[$i]= $line;
             $i++;
             }  
                                                                  
              pg_close($dbconn4);       
              return $reinos;    

          }     

          function obtenerImagenReinos(){
                 //error_reporting(0);
                 $user=$_SESSION['codigo'];
                 $pass=$_SESSION['pass'];

                 $conn_string = "host=localhost dbname=arcadiav2 user=p".strtolower($user)." password=".$pass;
                 $dbconn4 = pg_connect($conn_string) 
                 or die('No se ha podido conectar: ' . pg_last_error());   
                 
                 $consult="SELECT * FROM REINO_AVATAR";
                 $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());  
                 $reinosAvatar = array();
                 $i=0;
                 while($line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC)){
                 $reinosAvatar[$i]= $line;
                 $i++;
                 } 

                 pg_close($dbconn4);   
                 return $reinosAvatar;  
          } 

          }          
          ?>