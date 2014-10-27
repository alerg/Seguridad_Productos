<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Tipo_Avion extends Entidad{

		public $id_tipo;
		public $fila_primera;
		public $fila_economy;
		public $columnas_economic;
		public $columnas_primera;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('tipo_avion');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtenerPor($nombreCampo){
			if($nombreCampo != null)
				$this->setFiltrarPor(array(array($nombreCampo, $this->$nombreCampo)));
			$this->obtener();
		}
	}
?>