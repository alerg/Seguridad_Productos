<?php
	class Recurso_Productos{
		public $id;
		public $nombre;
		public $descripcion;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->nombre = null;
			$this->descripcion = null;
			$this->precio = null;
			$this->entidad = new Entidad_Producto();
		}

		public function buscar($nombre, $semana, $pagina){
			$registros = $entidad->buscar($nombre, $semana, $pagina);
			foreach ($registros as $key => $value) {
				$value->precio = $this->getPrecio($value->id);
			}
		}

		public function crear(){
			$this->entidad->id = $this->id;
			$this->entidad->descripcion = $this->descripcion;
			$this->entidad->nombre = $this->nombre;

			$this->id = (string)$this->entidad->crear();

			return $this;
		}	

		private function getPrecio($producto){
			$entidad = new Entidad_Precio();
			return $entidad->obtenerPorProducto($producto);	
		}
	}
?>