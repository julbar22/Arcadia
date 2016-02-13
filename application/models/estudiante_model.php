<?php
	class Estudiante_model extends CI_Model{

		protected $nickname;
		protected $nombre;
		protected $apellido;
		protected $correo;
		protected $f_nacimiento;
		protected $sexo;
		protected $num_tel;
		protected $hermandad;
		protected $pueblo;
		protected $avatar;
		protected $reino;

		public function __construct(){
			
		}

		public function getNickname(){return $this->nickname;}

		public function getNombre(){return $this->nombre;}

		public function getApellido(){return $this->apellido;}

		public function getCorreo(){	return $this->correo;}

		public function getFechaNacimiento(){	return $this->f_nacimiento;}

		public function getSexo(){	return $this->sexo;}

		public function getNumTel(){	return $this->num_tel;}

		public function getHermandad(){	return $this->hermandad;}

		public function getPueblo(){	return $this->pueblo;}

		public function setNickname($nickname){	$this->nickname = $nickname;}

		public function setNombre($nombre){	$this->nombre = $nombre;}

		public function setApellido($apellido){	$this->apellido = $apellido;}

		public function setCorreo($correo){	$this->correo = $correo;}

		public function setFechaNacimiento($f_nacimiento){	$this->f_nacimiento = $f_nacimiento;}

		public function setSexo($sexo){	$this->sexo = $sexo;}

		public function setNumTel($num_tel){	$this->num_tel = $num_tel;}

		public function setHermandad($hermandad){	$this->hermandad = $hermandad;}

		public function setPueblo($pueblo){	$this->pueblo = $pueblo;}
		
	}
?>
