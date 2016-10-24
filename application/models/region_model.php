<?php
	//require_once 'Profesor_model.php';

	class Region_model extends CI_Model{

		protected $idRegion;
		protected $nombre;
		protected $estado;		
		protected $actividades=array();
		public $xMapa;
		public $yMapa;
		public $fxMapa;
		public $fyMapa;

		public function __construct(){		

		}

		public function getRegion(){	return $this->idRegion;}

		public function getNombre(){return $this->nombre;}

		public function getEstado(){return $this->estado;}
		
		public function getActividades(){return $this->actividades;}

		public function setRegion($Region){$this->idRegion = $Region;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setEstado($estado){$this->estado = $estado;}		

		public function setActividades($actividades){	$this->actividades = $actividades; }

		
	}
?>
