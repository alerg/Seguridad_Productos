<?php
	class Recurso_Pagos{
		public $idPasaje;
		public $formaPago;
		public $precio;
		public $fecha;

		private $entidad;

		public function __construct() {
			$this->idPasaje = null;
			$this->formaPago = null;
			$this->precio = null;
			$this->fecha = null;
		}

		public function crear(){
			$entidad = new Entidad_Pago();
			$entidad->idPasaje = $this->idPasaje;
			$entidad->forma_pago = $this->formaPago;

			$now = time();
   			$this->fecha = date("Y", $now) .'-'. date("m", $now) .'-'. date("d", $now);

   			$pasaje = new Entidad_Pasaje();
   			$pasaje->id_pasaje = $this->idPasaje;
   			$pasaje->obtenerPor(array("id_pasaje"));
   			$categoria = $pasaje->categoria;

   			$vuelo = new Entidad_Vuelo();
   			$vuelo->id_vuelo = $pasaje->id_vuelo;;
   			$vuelo->obtenerPor("id_vuelo");

   			$recorrido = new Entidad_Recorrido();
   			$recorrido->id_recorrido = $vuelo->id_recorrido;
   			$recorrido->obtenerPor("id_recorrido");
   			
   			if($categoria == "Primera")
   				$this->precio = $recorrido->precio_primera;
			else
				$this->precio = $recorrido->precio_economy;

			$entidad->fecha = $this->fecha;
			$entidad->precio = $this->precio;
			$entidad->crear();

			$pasaje->id_estado = 1;
			$pasaje->modificar();
		}
	}
?>