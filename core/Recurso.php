<?php
	abstract class Recurso{
		
		protected function entidadesARecursos($entidades){
			$recursos = array();
			if(is_array($entidades)){
				if(count($entidades) > 0){
					if(count($entidades) > 1){
						for ($i=0; $i < count($entidades); $i++) {
							$recurso = $this->entidadARecurso($entidades[$i]);
							array_push($recursos, $recurso);
						}
					}else{
						$entidades = $entidades[0];
						$recurso = $this->entidadARecurso($entidades);
						array_push($recursos, $recurso);
					}
				}
			}else{
				$recurso = $this->entidadARecurso($entidades);
				array_push($recursos, $recurso);
			}
			return $recursos;
		}

		protected function buscar(){
			$atributos = get_class_vars(get_class($this));
			foreach ($atributos as $key => $value) {
	        	if($value != null){
					$valoresBusqueda[$key] = $this->value;
	        	}
	        }
	        return $this->entidadesARecursos($this->entidad->buscar($valoresBusqueda));
		}
	}
?>