<?php
	class Recurso_Comentarios{
		public $idProducto;
		public $fecha;
		public $comentario;
		public $id;

		private $entidad;

		public function __construct() {
			$this->idProducto = null;
			$this->fecha = null;
			$this->comentario = null;
			$this->id = null;
			$this->entidad = new Entidad_Comentario();
		}

		public function obtenerPorId(){
			$this->entidad->IdProducto = $this->idProducto;
			$entidades = $this->entidad->obtenerPorId();
			$recursos = array();
			foreach ($entidades as $key => $value) {
				$recurso = new Recurso_Comentarios();
				$recurso->IdProducto = $value->IdProducto;
				$fecha = DateTime::createFromFormat('Y-m-d H:i:s', $value->FechaComentario);
				$recurso->fecha = $fecha->format('d/m/Y H:i');
				$recurso->id = $value->IdComentario;
				$recurso->comentario = $value->CuerpoComentario;

				array_push($recursos, $recurso);
			}
			return $recursos;
		}
	}
?>