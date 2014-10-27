<?php

	class Recurso_Vuelos extends Recurso{
		public $precioPrimera;
		public $precioEconomy;
		public $id;
		public $fecha;
		public $asientosDisponiblesPrimera;
		public $asientosDisponiblesEconomica;

		public function obtenerPorRecorrido($origen, $destino){
			$entidadRecorrido = new Entidad_Recorrido();
			$entidadRecorrido->id_ciudad_origen = $origen;
			$entidadRecorrido->id_ciudad_destino = $destino;
			$entidadRecorrido->obtener();
			$recursos = array();
			if($entidadRecorrido->id_recorrido != null){
				$entidadVuelo = new Entidad_Vuelo();
				$entidadVuelo->id_recorrido = $entidadRecorrido->id_recorrido;

				$filtroFecha = array('fecha');
				if($this->fecha == null){
					$fechaActual = new DateTime("now");
					$entidadVuelo->fecha = $fechaActual->format('Y-m-d');
					array_push($filtroFecha, '>=');
				}else{
					$entidadVuelo->fecha = $this->fecha;
					array_push($filtroFecha, '=');
				}

				$vuelos = $entidadVuelo->obtenerTodosPor(array(array('id_recorrido'), $filtroFecha));
				$recursos = $this->entidadesARecursos($vuelos);
				for ($i=0; $i < count($recursos); $i++) { 
					$recursos[$i]->precioPrimera = $entidadRecorrido->precio_primera;
					$recursos[$i]->precioEconomy = $entidadRecorrido->precio_economy;
				}
			}
			return $recursos;
		}

		public function obtenerPorId($id){
			$entidadVuelo = new Entidad_Vuelo();
			$entidadVuelo->id_vuelo = $id;
			$entidadVuelo->obtenerPor('id_vuelo');
			$recurso = $this->entidadARecurso($entidadVuelo);

			$entidadAvion = new Entidad_Avion();
			$entidadAvion->id_avion = $entidadVuelo->id_avion;
			$entidadAvion->obtenerPor('id_avion');
			$recursoTipoAvion = new Recurso_Tipo_Avion();
			$recursoTipoAvion->obtenerPorId($entidadAvion->tipo_avion);
			$recurso->asientos = $recursoTipoAvion;

			$recursoPasaje = new Recurso_Pasajes();
			$pasajes = $recursoPasaje->obtenerTodosPorVueloConEstadoCheckin($id);

			$recurso->asientosOcupados = array();
			foreach ($pasajes as $index => $value) {
				$checkin = new Entidad_Checkin();
				$checkin->id_pasaje = $value->id;
				$checkin->obtenerPor('id_pasaje');
				$asiento = new Asiento($checkin->columna, $checkin->fila, $value->categoria);
				array_push($recurso->asientosOcupados, $asiento);
			}
			return $recurso;
		}

		/**************METODOS PRIVADOS******************/

		protected function entidadARecurso($entidad){
			$recurso = new Recurso_Vuelos();
			$recurso->id = $entidad->id_vuelo;
			$recurso->fecha = $entidad->fecha;
			$recurso->asientosDisponiblesPrimera = $entidad->asientos_disponibles_primera;
			$recurso->asientosDisponiblesEconomica = $entidad->asientos_disponibles_economy;
			$recurso->asientosExcedidos = $entidad->asientos_exedidos;
			return $recurso;
		}
	}
?>