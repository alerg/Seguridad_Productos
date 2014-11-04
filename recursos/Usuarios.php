<?php
	class Recurso_Usuarios{
		public $id;
		public $email;
		public $contrasena;
		public $nombre;
		public $apellido;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->email = null;
			$this->contrasena = null;
			$this->nombre = null;
			$this->apellido = null;

			$this->entidad = new Entidad_Usuario();
		}

		public function crear($email, $contrasena, $nombre, $apellido){
			//TODO: validar usuario y contraseña
			$this->entidad->Email = $email;
			$this->entidad->Password = $contrasena;
			$this->entidad->Nombre = $nombre;
			$this->entidad->Apelllido = $apellido;
			
			$retorno = $this->entidad->crear();
			if($retorno){
				$this->id = $this->entidad->getId();
				return true;
			}else{
				return false;
			}
		}

		public function login($email, $contrasena){
			$this->email = $email;
			$this->contrasena = $contrasena;

			$entidad = $this->entidad->obtenerPorEmail($this->email);
			if($entidad != null && $entidad->Contrasena == $this->contrasena){
				//TODO: Generar TOKEN
				return TRUE;
			}
			return FALSE;
		}

		public function obtener(){

		}
	}
?>