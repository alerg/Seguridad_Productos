<?php
	
	class Recurso_Pasajes extends Recurso{
		public $vuelo;
		public $nombre;
		public $email;
		public $fecha;
		public $dni;
		public $categoria;
		public $id;

		private $entidadPasaje;

		public function __construct() {
			$this->entidadPasaje = new Entidad_Pasaje();
		}

		public function crear(){
			$formato = 'd/m/Y';
			$fecha = DateTime::createFromFormat($formato, $this->fecha);

			$this->entidadPasaje->id_vuelo = $this->vuelo;
			$this->entidadPasaje->email = $this->email;
			$this->entidadPasaje->nombre = $this->nombre;
			$this->entidadPasaje->fecha_nacimiento = $fecha->format('Y-m-d');
			$this->entidadPasaje->dni = $this->dni;
			$this->entidadPasaje->categoria = $this->categoria;

			$this->id = (string)$this->entidadPasaje->crear();
			if($this->id <> null){
				$entidadVuelo = new Entidad_Vuelo();
				$entidadVuelo->id_vuelo = $this->entidadPasaje->id_vuelo;
				$entidadVuelo->descontarAsiento($this->entidadPasaje->categoria);
			}

			return $this->obtenerPorId($this->id);
		}

		public function obtenerPorId($id){

			$entidad = new Entidad_Pasaje();
			$entidad->id_pasaje = $id;
			$retorno = $entidad->obtenerPor(array("id_pasaje"));

			if($retorno <> false){

				$entidadVuelo = new Entidad_Vuelo();
				$entidadVuelo->id_vuelo = $entidad->id_vuelo;
				$entidadVuelo->obtenerPor("id_vuelo");
				$fechaVuelo = new DateTime($entidadVuelo->fecha);
				$this->fechaPartida = $fechaVuelo->format('d/m/Y');

				date_default_timezone_set('UTC');
				//Imprimimos la fecha actual dandole un formato
				$fechaActual = new DateTime("now");
				$interval = date_diff($fechaActual, $fechaVuelo);
				$horas = $interval->format('%r%h');
				$this->vencido = $horas < 0;
				
				$entidadRecorrido = new Entidad_Recorrido();
				$entidadRecorrido->id_recorrido = $entidadVuelo->id_recorrido;
				$entidadRecorrido->obtenerPor("id_recorrido");

				if($entidad->categoria == 'Primera')
					$this->precio = $entidadRecorrido->precio_primera;
				else
					$this->precio = $entidadRecorrido->precio_economy;

				$recursoAeropuertoOrigen = new Recurso_Aeropuertos();
				$recursoAeropuertoOrigen->codigo = $entidadRecorrido->id_ciudad_origen;
				$this->aeropuertoOrigen = $recursoAeropuertoOrigen->obtenerPorCodigo();
				$recursoAeropuertoDestino = new Recurso_Aeropuertos();
				$recursoAeropuertoDestino->codigo = $entidadRecorrido->id_ciudad_destino;
				$this->aeropuertoDestino = $recursoAeropuertoDestino->obtenerPorCodigo();

				if($entidad->id_estado == 2){
					$recursoCheckin = new Recurso_Checkin();
					$recursoCheckin->obtenerPorId($entidad->id_pasaje);
					$this->asiento = new Asiento($recursoCheckin->columna, $recursoCheckin->fila, $entidad->categoria);
				}

				$this->id = $entidad->id_pasaje;
				$this->vuelo = $entidad->id_vuelo;
				$this->email = $entidad->email;
				$this->nombre = $entidad->nombre;
				$this->fecha = $entidad->fecha_nacimiento;
				$this->dni = $entidad->dni;
				$this->categoria = $entidad->categoria;
				$this->estado = $entidad->id_estado;

				return $this;
			}else{
				return false;
			}
		}

		public function obtenerPasaje($id){
			$entidadPasaje = new Entidad_Pasaje();
			$registros = $entidadPasaje->obtenerPasaje($id);
			$registro = $registros[0];

			$fechaVuelo = new DateTime($registro['fecha_partida']);
			$this->fechaPartida = $fechaVuelo->format('d/m/Y');

			date_default_timezone_set('UTC');
			//Imprimimos la fecha actual dandole un formato
			$fechaActual = new DateTime("now");
			$interval = date_diff($fechaActual, $fechaVuelo);
			$horas = $interval->format('%r%h');
			$this->vencido = $horas < 0;

			if($registro['categoria'] == 'Primera')
					$this->precio = $registro['precio_primera'];
				else
					$this->precio = $registro['precio_economy'];

			$this->ciudadOrigen = $registro['ciudad_origen'];
			$this->provinciaOrigen = $registro['provincia_origen'];
			$this->ciudadDestino = $registro['ciudad_destino'];
			$this->provinciaDestino = $registro['provincia_destino'];

			if($registro['id_estado'] == 2){
				$this->asiento = new Asiento($registro['asiento_columna'], $registro['asiento_fila'], $registro['categoria']);
			}

			$this->id = $registro['id_pasaje'];
			$this->vuelo = $registro['id_vuelo'];
			$this->email = $registro['email'];
			$this->nombre = $registro['nombre'];
			$this->fecha = $registro['fecha_nacimiento'];
			$this->dni = $registro['dni'];
			$this->categoria = $registro['categoria'];
			$this->estado = $registro['id_estado'];

			return $this;
		}

		public function obtenerTodosPorVueloConEstadoCheckin($id){
			$entidad = new Entidad_Pasaje();
			$entidad->id_vuelo = $id;
			$entidad->id_estado = 2;
			$entidades = $entidad->obtenerPor(array("id_vuelo","id_estado"));
			return $this->entidadesARecursos($entidades);
		}

		protected function entidadARecurso($entidad){
			$recurso = new Recurso_Pasajes();
			$recurso->id = $entidad->id_pasaje;
			$recurso->vuelo = $entidad->id_vuelo;
			$recurso->email = $entidad->email;
			$recurso->nombre = $entidad->nombre;
			$recurso->fecha = $entidad->fecha_nacimiento;
			$recurso->dni = $entidad->dni;
			$recurso->categoria = $entidad->categoria;
			return $recurso;
		}
	}
?>