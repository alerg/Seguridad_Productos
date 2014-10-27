<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Recorrido extends Entidad{

		public $id_recorrido;
		public $precio_primera;
		public $precio_economy;
		public $id_ciudad_origen;
		public $id_ciudad_destino;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('recorrido');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtener(){
			if($this->id_ciudad_origen != null && $this->id_ciudad_destino != null){
				parent::setFiltrarPor(array(array('id_ciudad_origen', $this->id_ciudad_origen),array('id_ciudad_destino', $this->id_ciudad_destino)));
			}
			$registros = parent::obtener();
			return $registros;
		}

		public function obtenerPor($filtro){
			parent::setFiltrarPor(array(array($filtro, $this->$filtro)));
			$entidades = parent::obtener();
			return $entidades;
		}
	}
?>