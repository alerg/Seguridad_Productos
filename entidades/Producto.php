<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Producto extends Entidad{

		public $idProducto;
		public $idTipoProducto;
		public $descripcion;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('producto');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function buscar($descripcion, $semana, $pagina){
			$query ="SELECT p.*, pr.* ".
					"FROM producto as p ".
					"INNER JOIN precio as pr on pr.idProducto = p.idProducto";
			$index = 0;
			if($pagina == null){
				$pagina = 1;
			}

			$arrayFiltros = array($descripcion);

			if($semana!=null){
				array_push($arrayFiltros, $semana);
				$query = $query . " AND pr.semana = $" . $index;
				$index++;
			}

			$query = $query . " WHERE p.descripcion like '%$". $index ."%'";

			$registros = parent::ejecutarQuery($query, $arrayFiltros);

			$cantidadRegistros = count($registros);
			$paginas = abs($cantidadRegistros / 10) + 1;
			$resultado = array();
			if($paginas >= $pagina){
				for ($e=1; $e <= $paginas; $e++) {
					for ($i=0; $i<=9; $i++) {
						$index = $i * $pagina;
						if($index < $cantidadRegistros){
							array_push($resultado, $registros[$index]);
						}else{
							$i = 10;
						}
					}
				}
			}

			return $resultado;
		}

		private function getResultadosPorPagina($registros, $pagina){
			
			return $resultado;
		}
	}
?>