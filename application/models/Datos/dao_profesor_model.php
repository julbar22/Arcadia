          <?php
          defined('BASEPATH') OR exit('No direct script access allowed');

        
          require_once "../Arcadia/application/models/profesor_model.php";       
     
         
          session_start();
          
          /**
          * 
          */
          class Dao_profesor_model extends CI_Model
          {
        
          function __construct()
          {
         // $this->load->database();        
          parent::__construct();
          }
          

          function profesorLogin($valores) 
          {
            error_reporting(0);
            $_SESSION['codigo']=$valores['codigo'];
            $_SESSION['pass']=$valores['pass']; 

             $conn_string = "host=localhost dbname=arcadiav3 user=p".strtolower($valores['codigo'])." password=".$valores['pass'];
             $dbconn4 = pg_connect($conn_string);          
                                           
             if ($dbconn4){ 
              pg_close($dbconn4);
              return true;
            }
            else {
              pg_close($dbconn4);
              return false;
                    }
              }

          function profesorReg($valores,$profesor){
                
           $conn_string = "host=localhost dbname=arcadiav3 user=admin_arcadia password=arcadia";
             $dbconn4 = pg_connect($conn_string)
             or die('No se ha podido conectar: ' . pg_last_error());    
             $consult="SELECT * FROM PROFESOR WHERE N_NICKNAME='".$valores['codigo']."' OR K_CEDULA=".$profesor['documento'];
             $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());             
             $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);            
             
             if ($line['n_nickname']==null) {
              
               $insert ="INSERT INTO PROFESOR (K_CEDULA,N_NOMBRE,N_APELLIDO,O_CORREO,N_NICKNAME,N_COLEGIO,O_NUM_TEL) 
                         VALUES (".$profesor['documento'].", '".$profesor['nombreE']."', '".$profesor['ApellidoE']."', '".$profesor['correoE']."',
                         '".$profesor['UsuarioE']."', '".$profesor['InsEduE']."',".$profesor['TelE']." )";
               $resultInser= pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
               $selectIdAvatar = "SELECT K_AVATAR FROM AVATAR WHERE O_IMAGEN= '".$profesor['Icono']."'";
               $queryAvatar=pg_query($selectIdAvatar) or die('La consulta fallo: ' . pg_last_error());
               $line2 = pg_fetch_array($queryAvatar,null, PGSQL_ASSOC);
               $createAvatar = "INSERT INTO AVATAR_PROFESOR (K_AVATAR,K_CEDULA) VALUES (".$line2['k_avatar'].",".$profesor['documento'].")";
               $queryCreate = pg_query($createAvatar) or die('La consulta fallo: ' . pg_last_error());
               $query = "CREATE USER p".$valores['codigo']." IN GROUP profesores PASSWORD '".$valores['pass']."'";
               $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
               pg_close($dbconn4);    
               return true;

             }
             else{
              return $profesor;
             
             }           
                   
          } 

          function avatarEst(){
            $conn_string = "host=localhost dbname=arcadiav3 user=admin_arcadia password=arcadia";
            $dbconn4 = pg_connect($conn_string)
             or die('No se ha podido conectar: ' . pg_last_error()); 
             $query = "SELECT * FROM AVATAR";
             $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
             $avatares = array();
             $i=0;
             while($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
             $avatares[$i]= $line;
             $i++;
           }

            pg_close($dbconn4);
            return $avatares;           

          }         
          }          
          ?>