<?php
	//Representa la tabla recorridos de SQL.
	class Recurso_Checkin extends Recurso{

		public $pasaje;
		public $columna;
		public $fila;
		public $fecha;

		public function __construct() {
			$this->pasaje = null;
			$this->columna = null;
			$this->fila = null;
			$this->fecha = null;
		}

		public function crear(){
   			$this->fecha = date("Y-m-d", time());

			$entidad = new Entidad_Checkin();
			$entidad->id_pasaje = $this->pasaje;
			$entidad->columna = $this->columna;
			$entidad->fila = $this->fila;
			$entidad->fecha = $this->fecha;
			$entidad->crear();

			$entidadPasaje = new Entidad_Pasaje();
			$entidadPasaje->id_pasaje = $this->pasaje;
			$entidadPasaje->obtenerPor(array("id_pasaje"));

			$entidadPasaje->id_estado = 2;
			$entidadPasaje->modificar();

			return $this;
		}

		public function habilitadoCheckin($pasaje){
			$recursoPasaje = new Recurso_Pasajes();
			$recursoPasaje->obtenerPorId($pasaje);

			$recursoVuelo = new Recurso_Vuelos();
			$recursoVuelo = $recursoVuelo->obtenerPorId($recursoPasaje->vuelo);

			date_default_timezone_set('UTC');
			//Imprimimos la fecha actual dandole un formato
			$fechaActual = new DateTime("now");
			$fechaVuelo = date_create($recursoVuelo->fecha);
			$interval = date_diff($fechaActual, $fechaVuelo);
			$dias = $interval->format('%r%d');
			return ($dias < 2);
		}

		public function obtenerPorId($id){
			$entidadCheckin = new Entidad_Checkin();
			$entidadCheckin->id_pasaje = $id;
			$entidadCheckin->obtenerPor('id_pasaje');

			$this->pasaje = $entidadCheckin->id_pasaje;
			$this->columna = $entidadCheckin->columna;
			$this->fila = $entidadCheckin->fila;
			$this->fecha = $entidadCheckin->fecha;
			return $this;
		}
	}
?>