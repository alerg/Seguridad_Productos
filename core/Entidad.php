<?php

	class Entidad{
		//filtrarPor: contiene el nombre del identificador. Se usara en la condiciones
		//para obtener la entidad.
		public $filtrarPor = array();
		
		//Array que posee como key el nombre de los campos de la tabla sql.
		//protected $campos = array();
		//Nombre de la tabla
		public $nombreTabla;
		//Conexion SQL
		public $conexion;

		public function setFiltrarPor($valor){
			$this->filtrarPor = $valor;
		} 

		public function __construct($tabla) {
			//creacion de conexion SQL
			$this->nombreTabla = $tabla;
		}

		private function init_conexion(){
			$this->conexion = new ConexionMySQL();
		}

		protected function obtener(){
			//Condicion es un array que espera como key el nombre del campo por el cual
			//se va a obtener la entidad.
			$this->init_conexion();
			$registros = $this->conexion->obtener($this->nombreTabla, $this->filtrarPor);
			$entidades = $this->registroAEntidad($registros);
			return $entidades;
		}

		protected function obtenerTodos(){
			//Condicion es un array que espera como key el nombre del campo por el cual
			//se va a obtener la entidad.
			$this->init_conexion();
			$registros = $this->conexion->obtener($this->nombreTabla, $this->filtrarPor);
			$entidades = $this->registroAEntidad($registros);
			return $entidades;
		}

		protected function crear(){
			$this->init_conexion();
			return $this->conexion->crear($this->nombreTabla, $this->obtenerCampos());	
		}

		protected function modificar(){
			$this->init_conexion();
			return $this->conexion->modificar($this->nombreTabla, $this->obtenerCampos(), $this->filtrarPor);	
		}

		private function obtenerCampos(){
			$ancestro = get_class_vars('Entidad');
			if(get_called_class() != 'Entidad'){
		        $hijo = get_class_vars(get_class($this));  
		        $atributos = array();
		        foreach ($hijo as $keyHijo => $valueHijo) {
		        	$exists = false;
		        	foreach ($ancestro as $ancestroKey => $ancestroValue) {
		            	if ($keyHijo == $ancestroKey) {
		        			$exists = true;
			            }
					}
					if(!$exists){
						$atributos[$keyHijo] = $this->$keyHijo;
		        	}
		        }
				return $atributos;
	    	}else{
    			return $ancestro;
	    	}
		}

		protected function registroAEntidad($registros){
			$campos = $this->obtenerCampos();

			$entidades = array();
			if($registros){
				if(count($registros) > 1){
					for ($i=0; $i < count($registros); $i++) {
						$registro =  $registros[$i];
						$clase = get_class($this);
						$entidad = new $clase();
					 	foreach ($campos as $key => $value) {
							$entidad->$key = utf8_encode($registro[$key]);
						}
						array_push($entidades, $entidad);
					}
				}else{
					if(is_array($registros)){
						$registros = $registros[0];
					}
					foreach ($campos as $key => $value) {
						$this->$key = utf8_encode($registros[$key]);
					}
					array_push($entidades, $this);
				}
			}
			return $entidades;	
		}

		protected function ejecutarQuery($query){
			$this->init_conexion();
			return $this->conexion->ejecutarQuery($query);
		}
	}
?>