<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Pasaje extends Entidad{

		public $id_pasaje;
		public $dni;
		public $nombre;
		public $fecha_nacimiento;
		public $email;
		public $id_vuelo;
		public $id_estado;
		public $categoria;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('pasaje');
			$this->id_estado = 0;
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function crear(){
			$this->id_pasaje = parent::crear();
			return $this->id_pasaje;
		}

		public function obtenerPor($filtros){
			$filtroArray = array();
			foreach ($filtros as $key => $value){
				array_push($filtroArray, array($filtros[$key], $this->$value));
			}
			$this->setFiltrarPor($filtroArray);
			$entidades = $this->obtener();
			return $entidades;
		}

		public function obtenerTodosPor($nombreCampo){
			if($nombreCampo != null)
				$this->setFiltrarPor(array(array($nombreCampo, $this->$nombreCampo)));
			$entidades = $this->obtenerTodos();
			return $entidades;
		}

		public function modificar(){
			parent::modificar();
		}

		public function obtenerPasaje($id){
			$query = 'SELECT p.*, v.fecha as fecha_partida, r.precio_primera, r.precio_economy, '.
					'o.ciudad as ciudad_origen, o.provincia as provincia_origen, '.
					'd.ciudad as ciudad_destino, d.provincia as provincia_destino, '.
					'c.columna as asiento_columna, c.fila as asiento_fila '.
					' FROM pasaje as p '.
					'INNER JOIN vuelo as v on v.id_vuelo = p.id_vuelo '.
					'INNER JOIN recorrido as r on r.id_recorrido = v.id_recorrido '.
					'INNER jOIN aeropuerto as o on r.id_ciudad_origen = o.codigo '.
					'INNER jOIN aeropuerto as d on r.id_ciudad_destino = d.codigo '.
					'INNER JOIN check_in as c on c.id_pasaje = p.id_pasaje '.
					'WHERE p.id_pasaje = ' . $id;

			return parent::ejecutarQuery($query);
		}
	}
?>