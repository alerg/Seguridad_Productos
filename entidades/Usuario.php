<?php
	//Representa la tabla recorridos de SQL.
	class Entidad_Usuario extends Entidad{

		private $IdUsuario;
		public $Nombre;
		public $Apelllido;
		public $Email;
		public $Password;

		public function __construct() {
			//Llama al constructor de Entidad
			parent::__construct('usuario');
			//Se asigna a la variable heredada $nombreTabla el nombre de la tabla SQL
			//Se marca cual es el id de la tabla
		}

		public function crear(){
			$retorno = parent::crear();
			if($retorno != false){
				$this->IdUsuario = $retorno;
				return true;
			}
			return $retorno;
		}

		public function obtenerPorEmail($email){
			if($email != null){
				parent::setFiltrarPor(array(array('Email', $email)));
			}

			$entidad = parent::obtener();
			if(count($entidad) == 1)
				return $entidad[0];
			else
				return null;
		}

		public function getId(){
			return $this->IdUsuario;
		}
	}
?>