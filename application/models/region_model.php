<?php
	require_once 'Actividad_model.php';

	class Region_model extends CI_Model{

		protected $idRegion;
		protected $nombre;
		protected $estado;		
		protected $actividades;
		protected $xMapa;
		protected $yMapa;
		protected $imagen;



		public function __construct(){		

		}

		public function getRegion(){	return $this->idRegion;}

		public function getNombre(){return $this->nombre;}

		public function getEstado(){return $this->estado;}

		public function getxMapa(){return $this->xMapa;}

		public function getyMapa(){return $this->yMapa;}

		public function getImagen(){	return $this->imagen;}
		
		public function getActividades(){return $this->actividades;}

		public function setRegion($Region){$this->idRegion = $Region;}

		public function setNombre($nombre){$this->nombre = $nombre;}

		public function setEstado($estado){$this->estado = $estado;}

		public function setxMapa($xMapa){$this->xMapa = $xMapa;}

		public function setyMapa($yMapa){$this->yMapa = $yMapa;}

		public function setImagen($imagen){$this->imagen = $imagen;}		

		public function setActividades($actividades){	$this->actividades = $actividades; }

		public function crearRegion($idregion,$nombre,$estado,$xMapa,$yMapa,$imagen){
			$newRegion= new Region_model();
			$newRegion->setRegion($idregion);
			$newRegion->setNombre($nombre);			
			$newRegion->setEstado($estado);	
			$newRegion->setxMapa($xMapa);
			$newRegion->setyMapa($yMapa);
			$newRegion->setImagen($imagen);

			return $newRegion;
    }

		public function crearArregloRegion(Region_model $newRegion){
            $region['k_region']= $newRegion->getRegion();
			$region['n_nombre']= $newRegion->getNombre();		
			$region['i_estado']= $newRegion->getEstado();	
			$region['posicionX'] = $newRegion->getxMapa();
			$region['posicionY'] = $newRegion->getyMapa();
			$region['imagen'] = $newRegion->getImagen();
			$region['actividades']=$newRegion->arregloActividades();		
            
			return $region;
		}

		public function arregloActividades(){
			$actividadesArreglo= array();
			for($i=0;$i<count($this->actividades);$i++){
				$actividadesArreglo[$i]=$this->actividades[$i]->crearArregloActividad($this->actividades[$i]);

			}
			return $actividadesArreglo;
		}

		public function agregarActividad(Actividad_model $actividad){

             $this->actividades[count($this->actividades)]=$actividad;

		}

		
	}


?>
