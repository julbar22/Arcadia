<?php

	require_once "../Arcadia/application/models/reino_model.php";

	class Estudiante_model extends CI_Model{

		protected $nickname;
		protected $nombre;
		protected $apellido;
		protected $correo;
		protected $f_nacimiento;
		protected $sexo;
		protected $num_tel;
		protected $colegio;
		protected $gradoActual;
		protected $avatar;
		protected $reino;
		protected $clase;
		public function __construct(){

		}

		public function ArregloReinos(){
			$reinos= array();
			for($i=0;$i<count($this->reino);$i++){
				$reinos[$i]=$this->reino[$i]->crearArregloReino($this->reino[$i]);

			}
			return $reinos;
		}

		public function crearEstudiante($nickname,$nombre,$apellido,$correo,$fechaNacimiento,$sexo,$telefono,$colegio,$grado,$avatar,$clase){
				$newEstudiante = new Estudiante_model();
				$newEstudiante->setNickname($nickname);
				$newEstudiante->setNombre($nombre);
				$newEstudiante->setApellido($apellido);
				$newEstudiante->setCorreo($correo);
				$newEstudiante->setFechaNacimiento($fechaNacimiento);
				$newEstudiante->setSexo($sexo);
				$newEstudiante->setNumTel($telefono);
				$newEstudiante->setColegio($colegio);
				$newEstudiante->setGradoActual($grado);
				$newEstudiante->setAvatar($avatar);
				$newEstudiante->setClase($clase);
				return $newEstudiante;
		}

		public function crearArregloEstudiante(Estudiante_model $newEstudiante){

			$estudiante['k_nickname'] = $newEstudiante->getNickname();
			$estudiante['n_nombre'] = $newEstudiante->getNombre();
			$estudiante['n_apellido'] = $newEstudiante->getApellido();
			$estudiante['o_correo'] = $newEstudiante->getCorreo();
			$estudiante['f_nacimiento']= $newEstudiante->getFechaNacimiento();
			$estudiante['o_sexo']= $newEstudiante->getSexo();
			$estudiante['o_num_tel'] = $newEstudiante->getNumTel();
			$estudiante['n_colegio'] = $newEstudiante->getColegio();
			$estudiante['o_grado_actual'] = $newEstudiante->getGradoActual();
			$estudiante['o_imagen'] = $newEstudiante->getAvatar();
			$estudiante['k_clase'] = $newEstudiante->getClase();

			return $estudiante;
    }

		public function getNickname(){return $this->nickname;}

		public function getNombre(){return $this->nombre;}

		public function getApellido(){return $this->apellido;}

		public function getCorreo(){	return $this->correo;}

		public function getFechaNacimiento(){	return $this->f_nacimiento;}

		public function getSexo(){	return $this->sexo;}

		public function getNumTel(){ return $this->num_tel;}

		public function getColegio(){	return $this->colegio;}

		public function getGradoActual(){	return $this->gradoActual;}

		public function getAvatar(){	return $this->avatar;}

		public function getClase(){	return $this->clase;}

		public function getReino(){	return $this->reino;}

		public function setNickname($nickname){	$this->nickname = $nickname;}

		public function setNombre($nombre){	$this->nombre = $nombre;}

		public function setApellido($apellido){	$this->apellido = $apellido;}

		public function setCorreo($correo){	$this->correo = $correo;}

		public function setFechaNacimiento($f_nacimiento){	$this->f_nacimiento = $f_nacimiento;}

		public function setSexo($sexo){	$this->sexo = $sexo;}

		public function setNumTel($num_tel){	$this->num_tel = $num_tel;}

		public function setColegio($colegio){	$this->colegio = $colegio;}

		public function setGradoActual($gradoActual){	$this->gradoActual = $gradoActual;}

		public function setAvatar($avatar){	$this->avatar = $avatar;}

		public function setReino($reino){	$this->reino = $reino;}

		public function setClase($clase){	$this->clase = $clase;}

	}
?>
