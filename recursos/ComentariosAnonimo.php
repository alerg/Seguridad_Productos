<?php
	class Recurso_Comentarios_Anonimos{
		public $id;
		public $nickName;

		private $entidad;

		public function __construct() {
			$this->id = null;
			$this->nickName = null;
			$this->entidad = new Entidad_Comentario_Anonimo();
		}

		public function crear($id, $nickname){
			$this->entidad->IdComentario = $id;
			$this->entidad->NickName = $nickName;
			$this->entidad->crear();
		}

		public function obtener(){
			$this->entidad->IdComentario = $this->id;
			$entidad = $this->entidad->obtener();
			if($entidad != null){
				$this->nickName = $entidad->NickName;
				return $this;
			}
			return null;
		}
	}
?>