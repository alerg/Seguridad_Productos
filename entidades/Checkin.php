<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Checkin extends Entidad{

		public $id_pasaje;
		public $columna;
		public $fila;
		public $fecha;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('check_in');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function crear(){
			parent::crear();
		}

		public function obtenerPor($nombreCampo){
			if($nombreCampo != null)
				$this->setFiltrarPor(array(array($nombreCampo, $this->$nombreCampo)));
			$this->obtener();
		}
	}
?>