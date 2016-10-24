<?php
	//require_once 'Profesor_model.php';

	class Reino_avatar_model extends CI_Model{

		protected $idReino_avatar;
		protected $nombre;
		protected $imagen;		
		protected $historia;

		public function __construct(){		

		}

		public function getReino_avatar(){	return $this->idReino_avatar;}

		public function getNombre(){return $this->nombre;}

		public function getImagen(){return $this->imagen;}
		
		public function getHistoria(){return $this->historia;}

		public function setReino_avatar($Reino_avatar){$this->idReino_avatar = $Reino_avatar;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setImagen($imagen){$this->imagen = $imagen;}		

		public function setHistoria($historia){	$this->historia = $historia; }

		
	}
?>
