<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Comentario_Usuario_Registrado extends Entidad{

		public $IdComentario;
		public $IdUsuario;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('comentariousuarioRegistrado');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function crear(){
			return parent::crear();
		}

		public function obtener(){
			if($this->IdComentario != null){
				parent::setFiltrarPor(array(array('IdComentario', $this->IdComentario)));
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

	}
?>