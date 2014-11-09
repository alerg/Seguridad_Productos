<?php
	class Recurso_Comentarios_Usuarios_Registrados{
		public $id;
		public $idUsuario;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->idUsuario = null;
			$this->entidad = new Entidad_Comentario_Usuario_Registrado();
		}

		public function crear($id, $nickname){
			$this->entidad->IdComentario = $id;
			$this->entidad->idUsuario = $IdUsuario;
			$this->entidad->crear();
		}

		public function obtener(){
			$this->entidad->IdComentario = $this->id;
			$entidad = $this->entidad->obtener();
			if($entidad != null){
				$this->idUsuario = $entidad->IdUsuario;
				return $this;
			}
			return null;
		}
	}
?>