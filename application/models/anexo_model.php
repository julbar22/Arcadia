<?php
	//require_once 'Profesor_model.php';

	class Anexo_model extends CI_Model{

		protected $idAnexo;
		protected $idActividad;
		protected $nombre;
		protected $descripcion;

		public function __construct(){

		}

		public function getAnexo(){return $this->idAnexo;}

	  public function getActividad(){	return $this->idActividad;}

		public function getNombre(){return $this->nombre;}

		public function getDescripcion(){return $this->descripcionntos;}

		public function setAnexo($idAnexo){$this->idAnexo = $idAnexo;}

		public function setActividad($idActividad){	$this->idActividad = $idActividad; }

		public function setNombre($nombre){	$this->nombre = $nombre; }

		public function setDescripcion($descripcion){	$this->descripcion= $descripcion; }

		public function crearAnexo($idAnexo,$idActividad,$nombre,$descripcion){
			$newAnexo= new Anexo_model();
			$newAnexo->setAnexo($idAnexo);
			$newAnexo->setActividad($idActividad);
			$newAnexo->setNombre($nombre);
			$newAnexo->setDescripcion($descripcion);

			return $newAnexo;
    }

		public function crearArregloAnexo(Anexo_model $newAnexo){
      $anexo['k_anexo']= $newAnexo->getAnexo();
			$anexo['k_actividad']= $newAnexo->getActividad();
			$anexo['n_nombre']= $newAnexo->getNombre();
			$anexo['n_descripcion']= $newAnexo->getDescripcion();
			return $anexo;
		}



	}
?>
