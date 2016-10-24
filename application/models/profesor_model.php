<?php

    require_once 'Reino_model.php';  
   // require "phpmailer/class.phpmailer.php";

	class Profesor_model extends CI_Model{

		protected $cedula;
		protected $nombre;
		protected $apellido;
		protected $correo;
		protected $nickname;
		protected $colegio;
		protected $numTel;
		protected $reinos;
		protected $avatar;


		public function __construct(){
			
		}

		public function ArregloReinos(){
			$reinosProfesor= array();
			for($i=0;$i<count($this->reinos);$i++){
				$reinosProfesor[$i]=$this->reinos[$i]->crearArregloReino($this->reinos[$i]);

			}
			return $reinosProfesor;
		}

		public function crearProfesor($cedula,$nombre,$apellido,$correo,$nickname,$colegio,$numTel,$avatar){
			$newProfesor = new Profesor_model();
			$newProfesor->setCedula($cedula);
			$newProfesor->setNombre($nombre);
			$newProfesor->setApellido($apellido);
			$newProfesor->setCorreo($correo);
			$newProfesor->setNickname($nickname);
			$newProfesor->setColegio($colegio);
			$newProfesor->setNumTel($numTel);
			$newProfesor->setAvatar($avatar);

			return $newProfesor;
		}

		public function crearArregloProfesor(Profesor_model $newProfesor){
            $profesor['k_cedula'] = $newProfesor->getCedula();
			$profesor['n_nombre'] = $newProfesor->getNombre();
			$profesor['n_apellido'] = $newProfesor->getApellido();
			$profesor['o_correo'] = $newProfesor->getCorreo();
			$profesor['n_nickname'] =$newProfesor->getNickname();
			$profesor['n_colegio'] = $newProfesor->getColegio();
			$profesor['o_num_tel'] = $newProfesor->getNumTel();
			$profesor['o_imagen'] = $newProfesor->getAvatar();

			return $profesor;
		}

		public function getCedula(){return $this->cedula;}

		public function getNombre(){return $this->nombre;}

		public function getApellido(){return $this->apellido;}

		public function getCorreo(){return $this->correo;}

		public function getNickname(){return $this->nickname;}

		public function getColegio(){return $this->colegio;	}

		public function getNumTel(){return $this->numTel;}

		public function getAvatar(){return $this->avatar;}

		public function getReinos(){return $this->reinos;}

		public function setCedula($cedula){$this->cedula = $cedula;}

		public function setNombre($nombre){$this->nombre = $nombre;	}

		public function setApellido($apellido){$this->apellido = $apellido;}

		public function setCorreo($correo){$this->correo = $correo;}

		public function setNickname($nickname){$this->nickname = $nickname;}

		public function setColegio($colegio){$this->colegio = $colegio;}

		public function setNumTel($numTel){$this->numTel = $numTel;}

		public function setAvatar($avatar){$this->avatar = $avatar;}

		public function setReinos($reinos){$this->reinos = $reinos;}

		



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
