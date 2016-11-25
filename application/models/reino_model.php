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
		protected $codigo;
		protected $profesor;		
		protected $regiones=array();

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

		public function getCodigo(){return $this->codigo;}

		public function getProfesor(){return $this->profesor;}

		public function getRegiones(){return $this->regiones;}

		public function setReino($reino){$this->idReino = $reino;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setEstado($estado){$this->estado = $estado;}

		public function setHistoria($historia){$this->historia = $historia;}

		public function setMision($mision){$this->mision = $mision;}

		public function setVision($vision){$this->vision = $vision;	}

		public function setFechaCreacion($fechaCreacion){$this->fechaCreacion = $fechaCreacion;	}

		public function setImagen($imagen){	$this->imagen = $imagen; }

		public function setRegiones($regiones){	$this->regiones = $regiones; }

		public function setCodigo($codigo){	$this->codigo = $codigo; }

		public function setProfesor($profesor){	$this->profesor = $profesor; }

		public function crearReino($idreino,$nombre,$codigo,$estado,$fecha,$historia,$imagen,$mision,$vision,$profesor){
			$newReino= new Reino_model();
			$newReino->setReino($idreino);
			$newReino->setNombre($nombre);
			$newReino->setCodigo($codigo);
			$newReino->setEstado($estado);
			$newReino->setFechaCreacion($fecha);
			$newReino->setHistoria($historia);
			$newReino->setImagen($imagen);
			$newReino->setMision($mision);
			$newReino->setVision($vision);     
			$newReino->setProfesor($profesor);   

			return $newReino;
    }

		public function crearArregloReino(Reino_model $newReino){
            $reino['k_reino']= $newReino->getReino();
			$reino['n_nombre']= $newReino->getNombre();
			$reino['o_codigo']= $newReino->getCodigo();
			$reino['i_estado']= $newReino->getEstado();
			$reino['f_creacion']= $newReino->getFechaCreacion();
			$reino['n_historia']= $newReino->getHistoria();
			$reino['o_imagen']= $newReino->getImagen();
			$reino['n_mision']= $newReino->getMision();
			$reino['n_vision']= $newReino->getVision();     
			$reino['n_profesor']= $newReino->getProfesor(); 

			return $reino;
		}

		
	}
?>
