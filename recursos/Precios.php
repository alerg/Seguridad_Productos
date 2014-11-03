<?php
	class Recurso_Precios{
		public $idProducto;
		public $fecha;
		public $monto;
		public $idUsuario;

		private $entidad;

		public function __construct() {
			$this->idProducto = null;
			$this->fecha = null;
			$this->monto = null;
			$this->idUsuario = null;
			$this->entidad = new Entidad_Precio();
		}

		public function obtenerPorSemana($fecha){
			$this->entidad->IdProducto = $this->idProducto;
			$entidades = $this->entidad->obtenerPorSemana($fecha);
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Precios();
				$recurso->idProducto = $value->IdProducto;
				$recurso->idUsuario = $value->IdUsuario;
				$recurso->monto = $value->Monto;

				array_push($recursos, $recurso);
			}
			return $recursos;
		}

		public function calcularDatos($precios){
			foreach ($precios as $key => $value) {

			}
		}
	}
?>