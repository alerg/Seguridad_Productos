<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Tipo_Producto extends Entidad{

		public $IdTipoProducto;
		public $Descripcion;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('tipoproducto');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtenerTodos(){
			$entidades = parent::obtenerTodos();
			return $entidades;
		}

	}
?>