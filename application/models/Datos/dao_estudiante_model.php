          <?php
          defined('BASEPATH') OR exit('No direct script access allowed');

        
          require_once "../Arcadia/application/models/estudiante_model.php";         
       //   require_once '../Arcadia/application/models/profesor_model.php'; 
         

          session_start();
          
          /**
          * 
          */
          class Dao_estudiante_model extends CI_Model
          {
        
          function __construct()
          {
         // $this->load->database();        
          parent::__construct();
          }
          
          
          function estudianteLogin($valores) 
          {
            error_reporting(0);
            $_SESSION['codigo']=$valores['codigo'];
            $_SESSION['pass']=$valores['pass']; 

             $conn_string = "host=localhost dbname=arcadiav3 user= e".strtolower($valores['codigo'])." password=".$valores['pass'];
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


          function estudianteReg($valores,$estudiante){
                
           $conn_string = "host=localhost dbname=arcadiav3 user=admin_arcadia password=arcadia";
             $dbconn4 = pg_connect($conn_string)
             or die('No se ha podido conectar: ' . pg_last_error());  
             $consult="SELECT * FROM ESTUDIANTE WHERE K_NICKNAME='".$valores['codigo']."'";
             $resultConsult = pg_query($consult) or die('La consulta fallo: ' . pg_last_error());             
             $line = pg_fetch_array($resultConsult, null, PGSQL_ASSOC);     

             if ($line['k_nickname']==null) {
              
               $insert ="INSERT INTO ESTUDIANTE (K_NICKNAME,N_NOMBRE,N_APELLIDO,O_CORREO,F_NACIMIENTO,O_SEXO,O_NUM_TEL,N_COLEGIO,O_GRADO_ACTUAL) 
                         VALUES ('".$estudiante['UsuarioE']."', '".$estudiante['nombreE']."','".$estudiante['ApellidoE']."', '".$estudiante['correoE']."',
                         '".$estudiante['f_nacimiento']."', '".$estudiante['SexoE']."',".$estudiante['TelE'].",'".$estudiante['InsEduE']."',".$estudiante['GradActE']." )";
                         
                $resultInser= pg_query($insert) or die('La consulta fallo: ' . pg_last_error());
                $selectIdAvatar = "SELECT K_AVATAR FROM AVATAR WHERE O_IMAGEN= '".$estudiante['Icono']."'";
                $queryAvatar=pg_query($selectIdAvatar) or die('La consulta fallo: ' . pg_last_error());
                $line2 = pg_fetch_array($queryAvatar,null, PGSQL_ASSOC);
                $createAvatar = "INSERT INTO AVATAR_ESTUDIANTE(K_AVATAR,K_NICKNAME) VALUES (".$line2['k_avatar'].",'".$estudiante['UsuarioE']."')";
                $queryCreate = pg_query($createAvatar) or die('La consulta fallo: ' . pg_last_error());
                $query = "CREATE USER e".$valores['codigo']." IN GROUP estudiantes PASSWORD '".$valores['pass']."'";
                $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
                pg_close($dbconn4);    
                return true;

             }
             else 
              {
                return $estudiante;

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