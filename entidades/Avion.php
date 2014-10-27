<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Avion extends Entidad{

		public $id_avion;
		public $tipo_avion;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('avion');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtenerPor($nombreCampo){
			if($nombreCampo != null)
				$this->setFiltrarPor(array(array($nombreCampo, $this->$nombreCampo)));
			return $this->obtener();
		}
	}
?>