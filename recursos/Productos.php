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

		public function buscar($descripcion, $semana, $pagina){
			$registros = $this->entidad->buscar($descripcion, $semana, $pagina);
			return $registros;
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