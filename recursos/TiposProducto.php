<?php
	class Recurso_Tipos_Producto{
		public $id;
		public $descripcion;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->descripcion = null;
			$this->entidad = new Entidad_Tipo_Producto();
		}

		public function obtenerTodos(){
			$entidades = $this->entidad->obtenerTodos();
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Tipos_Producto();
				$recurso->id = $value->IdTipoProducto;
				$recurso->descripcion = $value->Descripcion;
				array_push($recursos, $recurso);
			}
			return $recursos;
		}
	}
?>