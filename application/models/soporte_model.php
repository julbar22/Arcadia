<?php
	//require_once 'Profesor_model.php';

	class Soporte_model extends CI_Model{

		protected $idSoporte;
		protected $idActividadResuelta;
		protected $nombre;
		protected $descripcion;

		public function __construct(){

		}

		public function getSoporte(){return $this->idSoporte;}

	  public function getActividadResuelta(){	return $this->idActividadResuelta;}

		public function getNombre(){return $this->nombre;}

		public function getDescripcion(){return $this->descripcion;}

		public function setSoporte($idSoporte){$this->idSoporte = $idSoporte;}

		public function setActividadResuelta($idActividadResuelta){	$this->idActividadResuelta = $idActividadResuelta; }

		public function setNombre($nombre){	$this->nombre = $nombre; }

		public function setDescripcion($descripcion){	$this->descripcion= $descripcion; }

		public function crearSoporte($idSoporte,$idActividadResuelta,$nombre,$descripcion){

			$newSoporte= new Soporte_model();
			$newSoporte->setSoporte($idSoporte);
			$newSoporte->setActividadResuelta($idActividadResuelta);
			$newSoporte->setNombre($nombre);
			$newSoporte->setDescripcion($descripcion);

			return $newSoporte;
    }

		public function crearArreglosoporte(soporte_model $newsoporte){
      $soporte['k_soporte']= $newSoporte->getSoporte();
			$soporte['k_actividadResuelta']= $newSoporte->getActividadResuelta();
			$soporte['n_nombre']= $newSoporte->getNombre();
			$soporte['n_descripcion']= $newSoporte->getDescripcion();
			return $soporte;
		}



	}
?>
