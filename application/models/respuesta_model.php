<?php
	
	class Respuesta_model extends CI_Model{

		protected $idRespuesta;
		protected $idPregunta;		
		protected $opcionVerdadera;	
		protected $respuesta;
		

		public function __construct(){		 
        
		}

		public function getIdPregunta(){	return $this->idPregunta;}

		public function getIdRespuesta(){return $this->idRespuesta;}

		public function getOpcionVerdadera(){return $this->opcionVerdadera;}

		public function getRespuesta(){return $this->respuesta;}

		public function setIdPregunta($idPregunta){$this->idPregunta = $idPregunta;}

		public function setIdRespuesta($idRespuesta){$this->idRespuesta = $idRespuesta;}

		public function setOpcionVerdadera($opcionVerdadera){$this->opcionVerdadera = $opcionVerdadera;}

		public function setRespuesta($respuesta){$this->respuesta = $respuesta;}
		

		public function crearRespuesta($idRespuesta,$idPregunta,$opcionVerdadera,$respuesta){
			$newRespuesta= new Respuesta_model();
			$newRespuesta->setIdRespuesta($idRespuesta);
			$newRespuesta->setIdPregunta($idPregunta);
			$newRespuesta->setOpcionVerdadera($opcionVerdadera);
			$newRespuesta->setRespuesta($respuesta); 

			return $newRespuesta;
    }

		public function crearArregloRespuesta(Respuesta_model $newRespuesta){
			$respuesta['k_respuesta']= $newRespuesta->getIdRespuesta();
            $respuesta['k_pregunta']= $newRespuesta->getIdPregunta();
			$respuesta['o_opcion']= $newRespuesta->getOpcionVerdadera();
			$respuesta['o_respuesta']= $newRespuesta->getRespuesta();

			return $respuesta;
		}

		
	}
?>
