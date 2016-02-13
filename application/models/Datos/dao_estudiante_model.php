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
            $_SESSION['codigo']=$valores['codigo'];
            $_SESSION['pass']=$valores['pass']; 

             $conn_string = "host=localhost dbname=arcadiav1 user=".$valores['codigo']." password=".$valores['pass'];
             $dbconn4 = pg_connect($conn_string)
             or die('No se ha podido conectar: ' . pg_last_error());
                         
                   
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
                
           $conn_string = "host=localhost dbname=arcadiav1 user=admin_arcadia password=arcadia";
             $dbconn4 = pg_connect($conn_string)
             or die('No se ha podido conectar: ' . pg_last_error());     
             $query = "CREATE USER ".$valores['codigo']." IN GROUP estudiantes PASSWORD '".$valores['pass']."'";
             $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
             pg_close($dbconn4);
             if($result)

              return true;
            else 
              return false;
            
                   
          } 

          function profesorReg($valores,$profesor){
                
           $conn_string = "host=localhost dbname=arcadiav1 user=admin_arcadia password=arcadia";
             $dbconn4 = pg_connect($conn_string)
             or die('No se ha podido conectar: ' . pg_last_error());     
             $query = "CREATE USER ".$valores['codigo']." IN GROUP profesores PASSWORD '".$valores['pass']."'";
             $result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
             pg_close($dbconn4);
             if($result)

              return true;
            else 
              return false;
            
                   
          } 

          function avatarEst(){
            $conn_string = "host=localhost dbname=arcadiav1 user=admin_arcadia password=arcadia";
            $dbconn4 = pg_connect($conn_string)
             or die('No se ha podido conectar: ' . pg_last_error()); 
             $query = "SELECT *FROM AVATAR";
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