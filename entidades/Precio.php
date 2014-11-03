<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Precio extends Entidad{

		public $IdProducto;
		public $IdUsuario;
		public $FechaPrecio;
		public $Monto;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('precio');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtenerPorSemana($fecha){
			$semana = $fecha->format('W');
			$año = $fecha->format('Y');
			$fechaInicial = date(datetime::ISO8601, strtotime($año."W".$semana));
			$fechaFinal = date(datetime::ISO8601, strtotime($año."W".$semana."7"));
			
			$query = "SELECT * FROM precio ".
					"WHERE IdProducto = $0 AND FechaPrecio >= '$1' AND FechaPrecio <= '$2'";
			return parent::ejecutarQuery($query, array($this->IdProducto, $fechaInicial, $fechaFinal));
		}

	}
?>