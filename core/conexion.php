<?php
	error_reporting(E_ERROR);

	class ConexionMySQL
	{
		private $conexion = null; 
		
		public function __construct() {
			$conexion = mysql_connect("localhost", "root", "", "prog_web_2");
			mysql_select_db($db);
		}

		public function __destruct()
	    {
	        cerrarConexion();
	    }

	    public function cerrarConexion(){
			if ($conexion) {
				mysql_close($conexion);	
			}
		}

		public function obtener($nombreTabla, $condicion){
			$query = 'SELECT * FROM `' .$nombreTabla .'`';
			if(isset($condicion)){
				$query .= ' WHERE '. key($condicion[0]) .'='. $condicion[0];
				return ejecutarQuery($query);
			}
			return false;
		}

		protected function modificar($tabla, $campos, $condicion){
			$campos = $this->obtenerCampos();
			$query = 'UPDATE '. $tabla .' SET ';
			foreach ($campos as $key => $value) {
				$query .= .'`'.$key . '`=`' . $value .'`' 
			}
			$query .= ' WHERE '. key($condicion[0]) .'='. $condicion[0];
			return ejecutarQuery($query);
		}

		protected function crear($tabla, $campos){
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
			$query = ' VALUES (';
			foreach ($campos as $key => $value) {
				if($primero){
					$primero = false;
				}else{
					$query .= ',';	
				}
				if(is_string($value)){
					$query .= '`'.$value . '`';
				}else{
					$query .= $value;
				}
			}
			$query .= ')';

			return ejecutarQuery($query);
		}
	//Metodos privados

		private function ejecutarQuery($query){
			if (count($query) > 0) {
				crearConexion();
				$retorno = mysql_query($query);
				$retorno = mysql_fetch_array($retorno, MYSQL_ASSOC);
				cerrarConexion();
				return $retorno;
			}

			return false;
		}
	}
?>