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
            //error_reporting(0);
           $user=$_SESSION['codigo']
           $pass=$_SESSION['pass'] 
          //OBTENER CON EL NICKNAME LA CEDULA
           //MIRAR AUTONUMERICOS 
           //fecha de creacion del sistema
           //imagenes disponibles para los reinos
             $conn_string = "host=localhost dbname=arcadiav1 user=p".$user." password=".$pass;
             $dbconn4 = pg_connect($conn_string) 
             or die('No se ha podido conectar: ' . pg_last_error());   

             $consult="SELECT K_CEDULA FROM PROFESOR WHERE O_NICKNAME='p".$user;
             $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());             
             $profesor = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);       

             $insert ="INSERT INTO REINO (K_CEDULA,N_NOMBRE,I_ESTADO,N_HISTORIA,N_MISION,N_VISION,F_CREACION) 
                         VALUES (".$profesor['K_CEDULA'].", '".$reino['nombre']."', 'Act', '".$reino['historia']."',
                         '".$reino['mision']."', '".$reino['vision']."','".$reino['date']."'' )";
             $resultInser= pg_query($insert) or die('La consulta fallo: ' . pg_last_error());  
                                           
              
              pg_close($dbconn4);
              return true;
           
              }

          function vincularReino($reino){
                
            //error_reporting(0);
           $user=$_SESSION['codigo']
           $pass=$_SESSION['pass'] 

             $conn_string = "host=localhost dbname=arcadiav1 user=e".$user." password=".$pass;
             $dbconn4 = pg_connect($conn_string) 
             or die('No se ha podido conectar: ' . pg_last_error());       

             $insert ="INSERT INTO CALIFICACION_EN_REINO (K_NICKNAME,K_REINO) 
                         VALUES ('".$user."', ".$reino['id'].")";
             $resultInser= pg_query($insert) or die('La consulta fallo: ' . pg_last_error());                                            
              
              pg_close($dbconn4);  
              return true;         
                   
          } 

          function obtenerReinos(){
              //error_reporting(0);
           $user=$_SESSION['codigo']
           $pass=$_SESSION['pass'] 

             $conn_string = "host=localhost dbname=arcadiav1 user=e".$user." password=".$pass;
             $dbconn4 = pg_connect($conn_string) 
             or die('No se ha podido conectar: ' . pg_last_error());   

             $consult="SELECT R.N_NOMBRE,R.N_HISTORIA,R.O_IMAGEN,P.O_NICKNAME FROM REINO R,PROFESOR P WHERE R.K_CEDULA=P.K_CEDULA";
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
          }          
          ?>