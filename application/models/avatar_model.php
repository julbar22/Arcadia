<?php
	class Avatar_model extends CI_Model{

		protected $id;
		protected $valor;
		protected $estado;
		protected $imagen;
		
		public function __construct(){
		
		}

		public function getId(){ return $this->id;	}

		public function getValor(){return $this->valor;	}

		public function getEstado(){return $this->estado;}

		public function getImagen(){return $this->imagen;}

		public function setId($id){	$this->id = $id;}

		public function setValor($valor){$this->valor = $valor;	}

		public function setEstado($estado){	$this->estado = $estado;}

		public function setImagen($imagen){	$this->imagen = $imagen;}

	}
?>
