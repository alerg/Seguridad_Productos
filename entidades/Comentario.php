<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Comentario extends Entidad{

		public $IdProducto;
		public $FechaComentario;
		public $IdComentario;
		public $CuerpoComentario;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('comentario');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtenerPorId(){
			
			if($this->IdProducto != null){
				parent::setFiltrarPor(array(array('IdProducto', $this->IdProducto)));
			}

			$entidades = parent::obtenerTodos();
			return $entidades;
		}

	}
?>