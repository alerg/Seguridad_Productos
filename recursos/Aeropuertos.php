<?php
	class Recurso_Aeropuertos{
		public $codigo = null;
		public $ciudad;
		public $provincia;
		public $nombre;

		private $entidad;

		public function __construct() {
			$this->codigo = null;
			$this->ciudad = null;
			$this->provincia = null;
			$this->nombre = null;
			$this->entidad = new Entidad_Aeropuerto();
		}

		public function obtenerPorCodigo(){
			$this->entidad->codigo = $this->codigo;
			$entidad = $this->entidad->obtenerPorCodigo();
			$this->codigo = $entidad->codigo;
			$this->ciudad = $entidad->ciudad;
			$this->provincia = $entidad->provincia;
			$this->nombre = $entidad->nombre;
			return $this;
		}

		public function obtenerTodos(){
			$entidades = $this->entidad->obtenerTodos();
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Aeropuertos();
				$recurso->codigo = $value->codigo;
				$recurso->ciudad = $value->ciudad;
				$recurso->provincia = $value->provincia;
				$recurso->nombre = $value->nombre;
				array_push($recursos, $recurso);
			}
			return $recursos;
		}


	}
?>