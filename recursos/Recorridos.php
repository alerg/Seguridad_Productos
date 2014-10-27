<?php
	Class Recurso_Recorridos extends Recorridos{
		public $id;
		public $precioPrimera;
		public $precioEconomy;
		public $ciudadOrigen;
		public $ciudadDestino;

		public function __construct() {
			$this->$id = null;
			$this->$precioPrimera = null;
			$this->$precioEconomy = null;
			$this->$ciudadOrigen = null;
			$this->$ciudadDestino = null;
		}
	}
?>