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
	}
?>