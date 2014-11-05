<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Producto extends Entidad{

		public $IdProducto;
		public $IdTipoProducto;
		public $Descripcion;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('producto');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtener(){
			if($this->IdProducto != null){
				parent::setFiltrarPor(array(array('IdProducto', $this->IdProducto)));
			}

			$entidad = parent::obtener();
			if(count($entidad) == 1)
				return $entidad[0];
			else
				return null;
		}

		public function obtenerTodos(){
			$entidades = parent::obtenerTodos();
			return $entidades;
		}

		public function obtenerTodosPorTipo(){
			parent::setFiltrarPor(array(array('IdTipoProducto', $this->IdTipoProducto)));
			$entidades = parent::obtenerTodos();
			return $entidades;
		}

	}
?>