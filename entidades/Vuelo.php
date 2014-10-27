<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Vuelo extends Entidad{

		public $id_vuelo;
		public $fecha;
		public $asientos_disponibles_primera;
		public $asientos_disponibles_economy;
		public $asientos_exedidos;
		public $id_avion;
		public $id_recorrido;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('vuelo');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function obtenerPor($nombreCampo){
			if($nombreCampo != null)
				$this->setFiltrarPor(array(array($nombreCampo, $this->$nombreCampo)));
			$this->obtener();
		}

		public function obtenerTodosPor($filtros){
			$filtrosArray = array();
			for ($index = 0 ; $index < count($filtros) ; $index++){
				$filtro = $filtros[$index];
				$filtroArray = array($filtro[0], $this->$filtro[0]);
				if(isset($filtro[1])){
					array_push($filtroArray, $filtro[1]); 	
				}
				array_push($filtrosArray, $filtroArray);
			}
			$this->setFiltrarPor($filtrosArray);
			$entidades = $this->obtener();
			return $entidades;
		}
	
		public function descontarAsiento($categoria){
			$campo = 'id_vuelo';
			$this->obtenerPor($campo);
			switch($categoria){
				case 'Primera':
					if($this->asientos_disponibles_primera > -10){
						//Cambio de cero a -10 para dar lugar a reservas en exceso
						$this->asientos_disponibles_primera = $this->asientos_disponibles_primera - 1;
					}else{
						return false;
					}
				break;
				case 'Economy':
					if($this->asientos_disponibles_economy > -10){
						//Cambio de cero a -10 para dar lugar a reservas en exceso
						$this->asientos_disponibles_economy = $this->asientos_disponibles_economy - 1;
					}else{
						return false;
					}
				break;
			}
			$this->setFiltrarPor(array(array($campo, $this->$campo)));
			$this->modificar();
		}
	}
?>