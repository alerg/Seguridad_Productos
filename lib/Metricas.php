<?php
	class Metricas{
		public $promedio;
		public $maximo;
		public $minimo;


		public function __construct($precios) {
			$this->promedio = 0;
			$this->maximo = 0;
			$this->minimo = 0;

			$this->calcularDatos($precios);
		}

		private function calcularDatos($precios){
			$suma = 0;
			foreach ($precios as $key => $value) {
				$monto = $value->monto;
				$suma += $monto;

				if($this->maximo == 0 || $monto > $this->maximo){
					$this->maximo = $monto;
				}
				if($this->minimo == 0 || $monto < $this->minimo){
					$this->minimo = $monto;
				}
			}
			$this->promedio = $suma / count($precios);
		}
	}
?>