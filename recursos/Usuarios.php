<?php
	class Recurso_Usuarios{
		public $id;
		public $email;
		public $nombre;
		public $apellido;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->email = null;
			$this->nombre = null;
			$this->apellido = null;

			$this->entidad = new Entidad_Usuario();
		}

		public function crear($email, $contrasena, $nombre, $apellido){
			//TODO: validar usuario y contraseña
			$this->entidad->Email = $email;
			$this->entidad->Password = $contrasena;
			$this->entidad->Nombre = $nombre;
			$this->entidad->Apellido = $apellido;
			
			$retorno = $this->entidad->crear();
			if($retorno){
				$this->id = $this->entidad->IdUsuario;
				return true;
			}else{
				return false;
			}
		}

		public function login($email, $contrasena){
			$entidad = $this->entidad->obtenerPorEmail($email);
			if($entidad != null && $entidad->Password == $contrasena){
				//TODO: Generar TOKEN
				return $entidad->IdUsuario;
			}
			return null;
		}

		public function obtener(){
			$this->entidad->IdUsuario = $this->id;
			$entidad = $this->entidad->obtener();
			$this->id = $entidad->IdUsuario;
			$this->nombre = $entidad->Nombre;
			$this->apellido = $entidad->Apellido;
			$this->email = $entidad->Email;
			return $this;
		}

		public function obtenerPorEmail($email){
			$entidad = $this->entidad->obtenerPorEmail($email);
			if($entidad != null){
				$this->id = $entidad->IdUsuario;
				$this->nombre = $entidad->Nombre;
				$this->apellido = $entidad->Apelido;
				$this->email = $entidad->Email;
				return true;
			}else{
				return false;
			}
		}

	}
?>