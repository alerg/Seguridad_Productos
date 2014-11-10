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

		public function crear($idProducto, $comentario, $idUsuario, $nickname){
			$this->entidad->IdProducto = $idProducto;
			$fecha = new DateTime("now");
			$this->entidad->FechaComentario = $fecha->format('Y-m-d H:i:s');
			$this->entidad->CuerpoComentario = $comentario;

			$idComentario = $this->entidad->crear();

			if(isset($idUsuario)){
				$registrado = new Entidad_Comentario_Usuario_Registrado();
				$registrado->IdComentario = $idComentario;
				$registrado->IdUsuario = $idUsuario;
				$registrado->crear();
			}else{
				$anonimo = new Entidad_Comentario_Anonimo();
				$anonimo->IdComentario = $idComentario;
				$anonimo->NickName = $nickname;
				$anonimo->crear();
			}
		}

		public function obtenerPorSemana(){
			$this->entidad->IdProducto = $this->idProducto;
			$this->fecha = DateTime::createFromFormat('d/m/Y', $this->fecha);
			$entidades = $this->entidad->obtenerPorSemana($this->fecha);
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