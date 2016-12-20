<?php

	require_once "../Arcadia/application/models/respuesta_model.php";
	
	class Pregunta_model extends CI_Model{

		protected $idPregunta;
		protected $tipoPregunta;	
		protected $pregunta;
		protected $respuesta;	

		public function __construct(){		 
        
		}

		public function getIdPregunta(){	return $this->idPregunta;}

		public function getTipoPregunta(){return $this->tipoPregunta;}

		public function getPregunta(){return $this->pregunta;}
		
		public function getRespuesta(){return $this->respuesta;}

		public function setIdPregunta($idPregunta){$this->idPregunta = $idPregunta;}

		public function setTipoPregunta($tipoPregunta){$this->tipoPregunta = $tipoPregunta;}

		public function setPregunta($pregunta){$this->pregunta = $pregunta;}

		public function setRespuesta($respuesta){$this->respuesta= $respuesta;}
		

		public function crearPregunta($idPregunta,$tipoPregunta,$pregunta){
			$newPregunta= new Pregunta_model();
			$newPregunta->setIdPregunta($idPregunta);
			$newPregunta->setTipoPregunta($tipoPregunta);
			$newPregunta->setPregunta($pregunta); 

			return $newPregunta;
    }

		public function crearArregloPregunta(Pregunta_model $newPregunta){
            $pregunta['k_pregunta']= $newPregunta->getIdPregunta();
			$pregunta['n_tipo_pregunta']= $newPregunta->getTipoPregunta();
			$pregunta['o_pregunta']= $newPregunta->getPregunta();

			return $pregunta;
		}

		public function ArregloRespuestas(){
			$respuesta= array();
			for($i=0;$i<count($this->respuesta);$i++){
				$reinos[$i]=$this->respuesta[$i]->crearArregloRespuesta($this->respuesta[$i]);

			}
			return $reinos;
		}

		
	}
?>
