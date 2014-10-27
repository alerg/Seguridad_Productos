<?php
	
class Recurso_Tipo_Avion extends Recurso{
	public $primera;
	public $economy;

	public function __constructor($primera, $economy){
		$this->primera = $primera;
		$this->economy = $economy;
	}

	public function obtenerPorId($id){
		$entidadTipoAvion = new Entidad_Tipo_Avion();
		$entidadTipoAvion->id_tipo = $id;
		$entidadTipoAvion->obtenerPor('id_tipo');

		$this->primera = new Asiento($entidadTipoAvion->columnas_primera, $entidadTipoAvion->fila_primera, 'Primera');
		$this->economy = new Asiento($entidadTipoAvion->columnas_economic, $entidadTipoAvion->fila_economy, 'Economy');
	}
}
?>