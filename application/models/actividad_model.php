<?php
	//require_once 'Profesor_model.php';

	class Actividad_model extends CI_Model{

		protected $idActividad;
		protected $nombre;
		protected $descripcion;
		protected $intentos;
		protected $porcentaje;
		protected $fechaCreacion;
		protected $fechaVencimiento;
		protected $preRequisito;
		protected $tipoActividad;
		protected $planDePremios;
		protected $anexo;
		protected $intetosRealizados;
		protected $nota;
		protected $estado;

		public function __construct(){

		}

		public function getActividad(){	return $this->idActividad;}

		public function getNombre(){return $this->nombre;}

		public function getDescripcion(){return $this->descripcion;}

		public function getIntentos(){return $this->intentos;}

		public function getPorcentaje(){return $this->porcentaje;}

		public function getFechaCreacion(){return $this->fechaCreacion;}

		public function getFechaVencimiento(){return $this->fechaVencimiento;}

		public function getPreRequisito(){return $this->preRequisito;}

		public function getTipoActividad(){return $this->tipoActividad;}

		public function getPlanDePremios(){return $this->planDePremios;}

		public function getAnexo(){return $this->anexo;}

		public function getIntentosRealizados(){return $this->intetosRealizados;}

		public function getNota(){return $this->nota;}

		public function getEstado(){return $this->estado;}

		public function setActividad($Actividad){$this->idActividad = $Actividad;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setDescripcion($descripcion){	$this->descripcion = $descripcion; }

		public function setIntentos($intentos){	$this->intentos = $intentos; }

		public function setPorcentaje($porcentaje){	$this->porcentaje= $porcentaje; }

		public function setFechaCreacion($fechaCreacion){	$this->fechaCreacion= $fechaCreacion; }

		public function setFechaVencimiento($fechaVencimiento){	$this->fechaVencimiento= $fechaVencimiento; }

		public function setPreRequisito($preRequisito){	$this->preRequisito = $preRequisito; }

		public function setTipoActividad($tipoActividad){	$this->tipoActividad = $tipoActividad; }

		public function setPlanDePremios($planDePremios){$this->planDePremios = $planDePremios;}

		public function setAnexo($anexo){$this->anexo = $anexo;}

		public function setIntentosRealizados($intetosRealizados){$this->intetosRealizados = $intetosRealizados;}

		public function setNota($nota){$this->nota = $nota;}

		public function setEstado($estado){$this->estado= $estado;}

		public function crearActividad($idActividad,$nombre,$descripcion,$intentos,$porcentaje,$fechaCreacion,$fechaVencimiento,$preRequisito,$tipoActividad,$planDePremios,$estado){
			$newActividad= new Actividad_model();
			$newActividad->setActividad($idActividad);
			$newActividad->setNombre($nombre);
			$newActividad->setDescripcion($descripcion);
			$newActividad->setIntentos($intentos);
			$newActividad->setPorcentaje($porcentaje * 100);
			$newActividad->setFechaCreacion($fechaCreacion);
			$newActividad->setFechaVencimiento($fechaVencimiento);
			$newActividad->setPreRequisito($preRequisito);
			$newActividad->setTipoActividad($tipoActividad);
			$newActividad->setPlanDePremios($planDePremios);
			$newActividad->setEstado($estado);

			return $newActividad;
    }

		public function crearArregloActividad(Actividad_model $newActividad){
      $actividad['k_actividad']= $newActividad->getActividad();
			$actividad['n_nombre']= $newActividad->getNombre();
			$actividad['n_descripcion']= $newActividad->getDescripcion();
			$actividad['q_intentos']= $newActividad->getIntentos();
			$actividad['v_porcentaje']= $newActividad->getPorcentaje();
			$actividad['f_vencimiento']= $newActividad->getFechaVencimiento();
			$actividad['f_creacion']= $newActividad->getFechaCreacion();
			$actividad['k_prerequisito']= $newActividad->getPreRequisito();
			$actividad['k_tipo_actividad']= $newActividad->getTipoActividad();
			$actividad['k_plan_premios']= $newActividad->getPlanDePremios();
			$actividad['n_anexo']= $newActividad->getAnexo();
			$actividad['n_intentos_realizados']= $newActividad->getIntentosRealizados();
			$actividad['n_nota']= $newActividad->getNota();
			$actividad['i_estado']= $newActividad->getEstado();

			return $actividad;
		}

		public function agregarAnexo(Anexo_model $anexo){

             $this->anexo=$anexo;

		}

	}
?>
