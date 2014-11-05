<?php
	class Recurso_Productos{
		public $id;
		public $tipo;
		public $descripcion;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->tipo = null;
			$this->descripcion = null;
			$this->entidad = new Entidad_Producto();
		}

		public function obtener(){
			$this->entidad->IdProducto = $this->id;
			$entidad = $this->entidad->obtener();
			$this->id = $entidad->IdProducto;
			$this->tipo = $entidad->IdTipoProducto;
			$this->descripcion = $entidad->Descripcion;
			return $this;
		}

		public function obtenerTodos(){
			$entidades = $this->entidad->obtenerTodos();
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Productos();
				$recurso->id = $value->IdProducto;
				$recurso->tipo = $value->IdTipoProducto;
				$recurso->descripcion = $value->Descripcion;
				array_push($recursos, $recurso);
			}
			return $recursos;
		}

		public function obtenerTodosPorTipo($tipo){
			$this->entidad->IdTipoProducto = $tipo;
			$entidades = $this->entidad->obtenerTodosPorTipo();
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Productos();
				$recurso->id = $value->IdProducto;
				$recurso->tipo = $value->IdTipoProducto;
				$recurso->descripcion = $value->Descripcion;
				array_push($recursos, $recurso);
			}
			return $recursos;
		}

		public function crear(){
			$this->entidad->idProducto = $this->id;
			$this->entidad->descripcion = $this->descripcion;
			$this->entidad->idTipoProducto = $this->tipo;

			$this->id = (string)$this->entidad->crear();

			return $this;
		}
	}
?>