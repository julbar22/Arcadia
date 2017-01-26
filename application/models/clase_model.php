<?php
	//require_once 'Profesor_model.php';

	class Clase_model extends CI_Model{

		protected $idClase;
		protected $nombre;
		protected $descripcion;
		protected $avatar;
		protected $genero;

		public function __construct(){

		}

		public function getClase(){	return $this->idClase;}

		public function getNombre(){return $this->nombre;}

		public function getDescripcion(){return $this->descripcion;}

		public function getAvatar(){return $this->avatar;}

		public function getGenero(){return $this->genero;}

		public function setClase($idClase){$this->idClase = $idClase;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setDescripcion($descripcion){	$this->descripcion = $descripcion; }

		public function setAvatar($avatar){$this->avatar = $avatar;}

		public function setGenero($genero){$this->genero = $genero;}

		public function crearClase($idClase,$nombre,$descripcion,$genero){
			$newClase = new Clase_model();
			$newClase->setClase($idClase);
			$newClase->setNombre($nombre);
			$newClase->setDescripcion($descripcion);
			$newClase->setGenero($genero);
			return $newClase;
    }

		public function crearArregloClase(Clase_model $newClase){
      $clase['k_clase']= $newClase->getClase();
			$clase['n_nombre']= $newClase->getNombre();
			$clase['n_descripcion']= $newClase->getDescripcion();
			$clase['avatar']= $newClase->getAvatar();
			$clase['n_genero']= $newClase->getGenero();
			$clase['avatar']= "";
			return $clase;
		}

	}
?>
