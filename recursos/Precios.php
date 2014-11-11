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

		public function obtenerPorProductoUsuario(){
			$this->entidad->IdProducto = $this->idProducto;
			$this->entidad->IdUsuario = $this->idUsuario;

			$entidades = $this->entidad->obtenerPorProductoUsuario();
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Precios();
				$recurso->idProducto = $value->IdProducto;
				$recurso->idUsuario = $value->IdUsuario;
				$recurso->monto = $value->Monto;
				$recurso->fecha = new DateTime($value->FechaPrecio);
				
				$recurso->modificable = $this->validarFecha($recurso->fecha);

				$recurso->fecha = $recurso->fecha->format('d/m/Y H:i:s');

				array_push($recursos, $recurso);
			}
			return $recursos;
		}

		public function crear(){
			$this->entidad->IdProducto = $this->idProducto;
			$this->entidad->IdUsuario = $this->idUsuario;
			$fecha = new DateTime("now");

			$registros = $this->obtenerPorSemanaPorUsuario($fecha);

			if(count($registros) > 0 ){
				return $this->modificar($registros[0]->fecha);
			}else{
				$this->entidad->FechaPrecio = $fecha->format('Y-m-d H:i:s');
				$this->entidad->Monto = $this->monto;
				$this->entidad->IdUsuario = $this->idUsuario;

				return $this->entidad->crear();
			}
		}

		public function modificar($fecha){
			$this->entidad->IdProducto = $this->idProducto;
			$this->entidad->Monto = $this->monto;
			$this->entidad->IdUsuario = $this->idUsuario;
			$fechaNueva = new DateTime("now");
			$this->entidad->FechaPrecio = $fechaNueva->format('Y-m-d H:i:s');
			$this->entidad->setFiltro(array(array('IdUsuario', $this->idUsuario), array('FechaPrecio', $fecha),array('IdProducto', $this->idProducto)));
			$this->entidad->modificar();
		}
		
		public function obtenerPorSemanaPorUsuario($fecha){
			$this->entidad->IdProducto = $this->idProducto;
			$this->entidad->IdUsuario = $this->idUsuario;
			$entidades = $this->entidad->obtenerPorSemanaPorUsuario($fecha);
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Precios();
				$recurso->idProducto = $value->IdProducto;
				$recurso->idUsuario = $value->IdUsuario;
				$recurso->monto = $value->Monto;
				$recurso->fecha = $value->FechaPrecio;

				array_push($recursos, $recurso);
			}
			return $recursos;
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
				$recurso->fecha = $value->FechaPrecio;

				array_push($recursos, $recurso);
			}
			return $recursos;
		}

		private function validarFecha($fecha){
			$hoy = new DateTime("now");
			$semana = $hoy->format('W');
			$año = $hoy->format('Y');
			$fechaInicial = new DateTime(date(datetime::ISO8601, strtotime($año."W".$semana)));
			$fechaFinal = new DateTime(date(datetime::ISO8601, strtotime($año."W".$semana."7")));
			$diff1 = $fecha >= $fechaInicial;
			$diff2 = $fecha <= $fechaFinal;
			if( $diff1 && $diff2 ){
				return true;
			}
			return false;
		} 
	}
?> 