<?php

    require_once 'Reino_model.php';
    require_once 'Solicitud_model.php';
    require "phpmailer/class.phpmailer.php";

	class Profesor_model extends CI_Model{

		protected $cedula;
		protected $nombre;
		protected $apellido;
		protected $correo;
		protected $nickname;
		protected $colegio;
		protected $numTel;
		protected $reino[];
		protected $avatar[];


		public function __construct(){
			
		}

		public function getCedula(){return $this->cedula;}

		public function getNombre(){return $this->nombre;}

		public function getApellido(){return $this->apellido;}

		public function getCorreo(){return $this->correo;}

		public function getNickname(){return $this->nickname;}

		public function getColegio(){return $this->colegio;	}

		public function getNumTel(){return $this->numTel;}

		public function setCedula($cedula){$this->cedula = $cedula;}

		public function setNombre($nombre){$this->nombre = $nombre;	}

		public function setApellido($apellido){$this->apellido = $apellido;}

		public function setCorreo($correo){$this->correo = $correo;}

		public function setNickname($nickname){$this->nickname = $nickname;}

		public function setColegio($colegio){$this->colegio = $colegio;}

		public function setNumTel($numTel){$this->numTel = $numTel;}

		



		// public function enviar_mail($destino){
		// 	$msg = null;
            
  //        $nombre = "BENEFICIARIO";
  //        $email = $destino;
  //        $asunto ="apoyo alimentario";
  //        $mensaje = "usted ha quedado seleccionado como beneficiario del apoyo alimentario";
           
        
    
  //         $mail = new PHPMailer;
		  
		  
  //         $mail->IsSMTP();
		  
  //         $mail->SMTPAuth = true;
  //         $mail->SMTPSecure = "ssl";

  //         $mail->Host = "smtp.gmail.com";

		//   $mail->Port = 465;

  //         $mail->Username = "julian318barbosa@gmail.com";
  //         $mail->Password = "luna9401";
       
  //         $mail->From = "julian301barbosa@gmail.com";
        
  //         $mail->FromName = "Apoyo Alimentario UD";
        
  //         $mail->Subject = $asunto;
        
  //         $mail->addAddress($email, $nombre);
        
  //         $mail->MsgHTML($mensaje);
               
    
        
  //         if($mail->Send())
  //       {
  //         return true;
   
  //   }
  //       else
  //       {
   
  //         return false;
  //   }

		// }

	}
?>
