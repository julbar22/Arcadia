<?php
	//require_once 'Profesor_model.php';

	class Actividad_model extends CI_Model{

		protected $idActividad;
		protected $nombre;
		protected $planDePremios;
		protected $tipoActividad;		
		protected $descripcion;
		protected $intentos;
		protected $porcentaje;
		protected $preRequisito;

		public function __construct(){		

		}

		public function getActividad(){	return $this->idActividad;}

		public function getNombre(){return $this->nombre;}

		public function getPlanDePremios(){return $this->planDePremios;}
		
		public function getTipoActividad(){return $this->tipoActividad;}

		public function getDescripcion(){return $this->descripcion;}

		public function getIntentos(){return $this->intentos;}

		public function getPorcentaje(){return $this->porcentaje;}

		public function getPreRequisito(){return $this->preRequisito;}

		public function setActividad($Actividad){$this->idActividad = $Actividad;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setPlanDePremios($planDePremios){$this->planDePremios = $planDePremios;}		

		public function setTipoActividad($tipoActividad){	$this->tipoActividad = $tipoActividad; }

		public function setDescripcion($descripcion){	$this->descripcion = $descripcion; }

		public function setIntentos($intentos){	$this->intentos = $intentos; }

		public function setPorcentaje($porcentaje){	$this->porcentaje= $porcentaje; }

		public function setPreRequisito($preRequisito){	$this->preRequisito = $preRequisito; }

		
	}
?>
