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

		public function crear(){
			return parent::crear();
		}

		public function obtenerPorSemana($fecha){
			$semana = $fecha->format('W');
			$año = $fecha->format('Y');
			$fechaInicial = date(datetime::ISO8601, strtotime($año."W".$semana));
			$fechaFinal = date(datetime::ISO8601, strtotime($año."W".$semana."7"));
			$fechaFinal = new dateTime($fechaFinal);
			date_add($fechaFinal, date_interval_create_from_date_string('1 day'));

			$query = "SELECT * FROM comentario ".
					"WHERE IdProducto = $0 AND FechaComentario >= '$1' AND FechaComentario <= '$2'".
					" ORDER BY FechaComentario DESC";
			return parent::ejecutarQuery($query, array($this->IdProducto, $fechaInicial, $fechaFinal->format(datetime::ISO8601)));
		}
	}
?>