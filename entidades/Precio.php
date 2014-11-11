<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Precio extends Entidad{

		public $IdProducto;
		public $IdUsuario;
		public $FechaPrecio;
		public $Monto;

		private $filtro;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('precio');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function crear(){
			return parent::crear();
		}

		public function modificar(){
			parent::setFiltrarPor($this->filtro);
			return parent::modificar();
		}

		public function obtenerPorSemana($fecha){
			$semana = $fecha->format('W');
			$año = $fecha->format('Y');
			$fechaInicial = date(datetime::ISO8601, strtotime($año."W".$semana));
			$fechaFinal = date(datetime::ISO8601, strtotime($año."W".$semana."7"));
			$fechaFinal = new dateTime($fechaFinal);
			date_add($fechaFinal, date_interval_create_from_date_string('1 day'));

			$query = "SELECT * FROM precio ".
					"WHERE IdProducto = $0 AND FechaPrecio >= '$1' AND FechaPrecio <= '$2'";
			return parent::ejecutarQuery($query, array($this->IdProducto, $fechaInicial, $fechaFinal->format(datetime::ISO8601)));
		}

		public function obtenerPorSemanaPorUsuario($fecha){
			$semana = $fecha->format('W');
			$año = $fecha->format('Y');
			$fechaInicial = date(datetime::ISO8601, strtotime($año."W".$semana));
			$fechaFinal = date(datetime::ISO8601, strtotime($año."W".$semana."7"));
			$fechaFinal = new dateTime($fechaFinal);
			date_add($fechaFinal, date_interval_create_from_date_string('1 day'));

			$query = "SELECT * FROM precio ".
					"WHERE IdProducto = $0 AND IdUsuario=$3 AND FechaPrecio >= '$1' AND FechaPrecio <= '$2'";
			return parent::ejecutarQuery($query, array($this->IdProducto, $fechaInicial, $fechaFinal->format(datetime::ISO8601), $this->IdUsuario));
		}

		public function obtenerPorProductoUsuario(){
			parent::setFiltrarPor(array(array('IdUsuario', $this->IdUsuario),array('IdProducto', $this->IdProducto)));
			$entidades = parent::obtenerTodos();
			return $entidades;
		}

		public function setfiltro($param){
			$this->filtro = $param;
		}
	}
?>