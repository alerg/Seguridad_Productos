<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Producto extends Entidad{

		public $id;
		public $nombre;
		public $descripcion;
		public $precio;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('producto');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function buscar($nombre, $semana, $pagina){
			$query ="SELECT p.*, pr.* ".
					"FROM producto as p ".
					"INNER JOIN precio as pr on pr.idProducto = p.id AND pr.semana = $1 ".
					"WHERE p.nombre like '%$2%'";

			$registros = parent::ejecutarQuery($query, array($nombre, $semana));

			$paginas = len($registros) / 10;
			$resultado = array();
			if($paginas >= $pagina){
				for ($i=1; $i <= 10; $i++) { 
					$index = $i * $pagina;
					if($index < len($registro)){
						array_push($resultado, $registros[$index]);
					}else{
						$i = 11;
					}
				}
			}

			return $resultado;
		}
	}
?>