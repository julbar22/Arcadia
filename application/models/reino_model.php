<?php
	require_once 'Profesor_model.php';

	class Reino_model extends CI_Model{

		protected $idReino;
		protected $nombre;
		protected $estado;
		protected $historia;
		protected $mision;
		protected $vision;
		protected $fechaCreacion;
		protected $imagen;
		protected $profesor = new Profesor_model();

		public function __construct(){
		
		}

		public function getReino(){	return $this->idReino;}

		public function getNombre(){return $this->nombre;}

		public function getEstado(){return $this->estado;}

		public function getHistoria(){return $this->historia;}

		public function getMision(){return $this->mision;}

		public function getVision(){return $this->vision;}

		public function getFechaCreacion(){return $this->fechaCreacion;}

		public function getImagen(){return $this->imagen;}

		public function setReino($reino){$this->idReino = $reino;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setEstado($estado){$this->estado = $estado;}

		public function setHistoria($historia){$this->historia = $historia;}

		public function setMision($mision){$this->mision = $mision;}

		public function setVision($vision){$this->vision = $vision;	}

		public function setFechaCreacion($fechaCreacion){$this->fechaCreacion = $fechaCreacion;	}

		public function setImagen($imagen){	$this->imagen = $imagen; }

		
	}
?>
