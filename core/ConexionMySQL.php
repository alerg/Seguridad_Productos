<?php
	//error_reporting(E_ERROR);
	class ConexionMySQL{
		private $conexion;
		//private $nombreTabla;
		//private $condicion; 
		
		public function __construct() {
			$this->conexion = new mysqli("localhost", "root", "", "aerolinea");
			if($this->conexion->errno)
				echo 'Error al conectar con la base de datos. Nro: ' . $this->conexion->errno .' / '. $this->conexion->error;
		}

		public function obtener($nombreTabla, $condiciones){
			$query = 'SELECT * FROM `' .$nombreTabla .'`';
			if(count($condiciones)>0){
				$query .= ' WHERE ';
				$and = false;
				for ($index=0; $index < count($condiciones); $index++) { 
					if($and)
						$query .= ' AND ';
					else
						$and = true;

					//$query .= '`'. $condicion[$key][0] .'`=\''. $condicion[$key][1] .'\'';

					$condicion = $condiciones[$index];
					$campo = $condicion[0];
					$valor = $condicion[1];
					$operador = isset($condicion[2]) ? $condicion[2] : '='; 
					
					$query .= '`'. $campo .'`'. $operador.'\''. $valor .'\'';					
				}
			}
			return $this->ejecutarQuery($query);
		}

		public function modificar($tabla, $campos, $condiciones){
			$primero = true;
			$query = 'UPDATE `'. $tabla .'` SET ';
			foreach ($campos as $key => $value) {
				if($primero){
					$primero = false;
				}else{
					$query .= ',';	
				}
				$query .= '`'.$key . '`=\'' . $value .'\'';
			}
			$primero = true;
			if(count($condiciones)>0){
				$query .= ' WHERE ';
				for ($index=0; $index < count($condiciones); $index++) { 
					if($primero){
						$primero = false;
					}else{
						$query .= ' AND ';	
					}
					//$query .= '`'.$key . '`=\'' . $value .'\'';
					$condicion = $condiciones[$index];
					$campo = $condicion[0];
					$valor = $condicion[1];
					$operador = isset($condicion[2]) ? $condicion[2] : '='; 

					$query .= '`'. $campo .'`'. $operador.'\''. $valor .'\'';
				}
			}
			$registro = $this->ejecutarQuery($query);
			return $registro;
		}

		public function crear($tabla, $campos){
			$primero = true;
			$query = 'INSERT INTO '. $tabla .'(';
			foreach ($campos as $key => $value) {
				if($primero){
					$primero = false;
				}else{
					$query .= ',';	
				}
				$query .= '`'.$key . '`';
			}
			$query .= ')';
			$query .= ' VALUES (';
			$primero = true;
			foreach ($campos as $key => $value) {
				if($primero){
					$primero = false;
				}else{
					$query .= ',';	
				}
				$query .= '\''.$value . '\'';
			}
			$query .= ')';
			$this->ejecutarQuery($query);
			return $this->conexion->insert_id;
		}

	//Metodos privados
		public function ejecutarQuery($query){
			//echo $query;
			if (count($query) > 0) {
				$this->conexion->real_query($query);
				$matriz = array(); 
			    /* obtener array asociativo */
			    $retorno = $this->conexion->use_result();
			    if($retorno){
				    while ($fila = $retorno->fetch_assoc()) {
				    	array_push($matriz, $fila);
				    }
				    /* liberar el resultset */
				    $retorno->free();
					/* cerrar la conexión */
					
					return $matriz;
				}
			}
			return false;
		}

		public function field_count(){
			$this->conexion->field_count;
		}		
	}
?>