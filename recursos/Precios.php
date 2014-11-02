<?php
	class Recurso_Precios{
		public $id;
		public $semana;
		public $valor;
		public $producto;
		public $usuario;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->semana = null;
			$this->valor = null;
			$this->entidad = new Entidad_Precio();
		}

		public function obtenerTodosPorProducto(){
			if($this->id != null){
				parent::setFiltrarPor(array(array('id', $this->codigo)));
			}
			$entidades = parent::obtenerTodos();
			return $entidades;
		}

		public function buscar($producto){
			$registros = $entidad->buscar($nombre, $semana, $pagina);
			foreach ($registros as $key => $value) {
				$value->precio = $this->getPrecio($value->id);
			}
		}

		public function crear(){
			$this->entidad->id = $this->id;
			$this->entidad->semana = $this->descripcion;
			$this->entidad->nombre = $this->nombre;

			$this->id = (string)$this->entidadPasaje->crear();

			return $this;
		}	

		private function getPrecio($producto){
			$entidad = new Entidad_Precio();
			return $entidad->obtenerPorProducto($producto);	
		}
	}
?>