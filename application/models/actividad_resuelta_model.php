<?php
	//require_once 'Profesor_model.php';

	class Actividad_Resuelta_model extends CI_Model{

		protected $idActividadResuelta;
		protected $nickname;
		protected $actividad;
		protected $observacion;
		protected $nota;
		protected $intento;
		protected $soporte;

		public function __construct(){

		}

		public function getActividadResuelta(){	return $this->idActividadResuelta;}

		public function getNickname(){return $this->nickname;}

		public function getActividad(){return $this->actividad;}

		public function getObservacion(){return $this->observacion;}

		public function getNota(){return $this->nota;}

		public function getIntento(){return $this->intento;}

		public function getSoporte(){return $this->soporte;}

		public function setActividadResuelta($idActividadResuelta){$this->idActividadResuelta = $idActividadResuelta;}

		public function setNickname($nickname){$this->nickname = $nickname;}

		public function setActividad($actividad){	$this->actividad = $actividad; }

		public function setObservacion($observacion){	$this->observacion = $observacion; }

		public function setNota($nota){	$this->nota= $nota; }

		public function setIntento($intento){	$this->intento= $intento; }

		public function setSoporte($soporte){	$this->soporte= $soporte; }

		public function crearActividadResuelta($idActividadResuelta, $nickname, $actividad, $observacion, $nota, $intento){
			$newActividadResuelta= new Actividad_Resuelta_model();
			$newActividadResuelta->setActividadResuelta($idActividadResuelta);
			$newActividadResuelta->setNickname($nickname);
			$newActividadResuelta->setActividad($actividad);
			$newActividadResuelta->setObservacion($observacion);
			$newActividadResuelta->setNota($nota);
			$newActividadResuelta->setIntento($intento);

			return $newActividadResuelta;
    }

		public function crearArregloActividadResuelta(Actividad_Resuelta_model $newActividadResuelta){
      $actividadResuelta['k_actividadResuelta']= $newActividadResuelta->getActividadResuelta();
			$actividadResuelta['n_nickname']= $newActividadResuelta->getNickname();
			$actividadResuelta['k_actividad']= $newActividadResuelta->getActividad();
			$actividadResuelta['n_observacion']= $newActividadResuelta->getObservacion();
			$actividadResuelta['v_nota']= $newActividadResuelta->getNota();
			$actividadResuelta['v_intento']= $newActividadResuelta->getIntento();
			$actividadResuelta['k_soporte']= $newActividadResuelta->getSoporte();

			return $actividad;
		}

		public function agregarSoporte(Soporte_model $soporte){

             $this->soporte=$soporte;

		}

	}
?>
