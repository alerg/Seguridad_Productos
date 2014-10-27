<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Aeropuerto extends Entidad{

		public $codigo;
		public $ciudad;
		public $provincia;
		public $nombre;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('aeropuerto');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtenerPorCodigo(){
			if($this->codigo != null){
				parent::setFiltrarPor(array(array('codigo', $this->codigo)));
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