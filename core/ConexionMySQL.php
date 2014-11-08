<?php
	//error_reporting(E_ERROR);
	class ConexionMySQL{
		private $conexion;
		private $insert_id;
		//private $nombreTabla;
		//private $condicion; 
		
		public function __construct() {
			$this->conexion = new mysqli("localhost", "root", "", "scaw");
			if($this->conexion->errno)
				echo 'Error al conectar con la base de datos. Nro: ' . $this->conexion->errno .' / '. $this->conexion->error;
		}

		public function obtener($nombreTabla, $condiciones){
			$query = 'SELECT * FROM `' .$nombreTabla .'`';
			if(count($condiciones)>0){
				$query .= ' WHERE ';
				$and = FALSE;
				for ($index=0; $index < count($condiciones); $index++) { 
					if($and)
						$query .= ' AND ';
					else
						$and = TRUE;

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
			$primero = TRUE;
			$query = 'UPDATE `'. $tabla .'` SET ';
			foreach ($campos as $key => $value) {
				if($primero){
					$primero = FALSE;
				}else{
					$query .= ',';	
				}
				$query .= '`'.$key . '`=\'' . $value .'\'';
			}
			$primero = TRUE;
			if(count($condiciones)>0){
				$query .= ' WHERE ';
				for ($index=0; $index < count($condiciones); $index++) { 
					if($primero){
						$primero = FALSE;
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
			$primero = TRUE;
			$query = 'INSERT INTO '. $tabla .'(';
			foreach ($campos as $key => $value) {
				if($primero){
					$primero = FALSE;
				}else{
					$query .= ',';	
				}
				$query .= '`'.$key . '`';
			}
			$query .= ')';
			$query .= ' VALUES (';
			$primero = TRUE;
			foreach ($campos as $key => $value) {
				if($primero){
					$primero = FALSE;
				}else{
					$query .= ',';	
				}
				$query .= '\''.$this->escapar($value) . '\'';
			}
			$query .= ')';
			$retorno = $this->ejecutarQuery($query);
			if($retorno != FALSE || $this->insert_id != null){
				return $this->insert_id;
			}
			return FALSE;
		}

	//Metodos privados
		public function ejecutarQuery($query){
			//echo $query;
			if (count($query) > 0) {
				$this->conexion->real_query($query);
				$matriz = array(); 
			    /* obtener array asociativo */
			    $retorno = $this->conexion->use_result();
				$this->insert_id = $this->conexion->insert_id;
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
			return FALSE;
		}

		public function field_count(){
			$this->conexion->field_count;
		}

		public function escapar($valor){
			return $this->conexion->real_escape_string($valor);
		}		
	}
?>