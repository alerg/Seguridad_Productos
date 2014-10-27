<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Pago extends Entidad{

		public $id_pasaje;
		public $forma_pago;
		public $precio;
		public $fecha;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('pago');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function crear(){
			parent::crear();
		}	
	}
?>