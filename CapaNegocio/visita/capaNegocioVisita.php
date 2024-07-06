<?php
include_once(".././CapaDato/capaDatoVisita.php");
include_once(".././CapaDato/capaDatoTratamiento.php");
class capaNegocioVisita{
	public $objectoCapaDato;
	public $objectoTratamientoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoVisita();
		$this->objectoTratamientoCapaDato=new capaDatoTratamiento();
	}

	public function insertar($descripcion, $pagoadelanto,$idtratamiento){
		try {
			$this->objectoCapaDato->insertar($descripcion, $pagoadelanto,$idtratamiento);	
			$this->objectoTratamientoCapaDato->actualizarPago($pagoadelanto,$idtratamiento);
		} catch (\Throwable $th) {
			echo $th->getMessage();
		}
		
	}

	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);	
	}

	public function actualizar($id,$descripcion, $pagoadelanto,$idtratamiento){
		$this->objectoCapaDato->actualizar($id,$descripcion, $pagoadelanto,$idtratamiento);	
		$this->objectoTratamientoCapaDato->actualizarPagoVisita($pagoadelanto,$idtratamiento,$id);
	}

	public function mostrar(){
		return $this->objectoCapaDato->mostrar();
	}
	public function getTratamiento(){
		return $this->objectoCapaDato->getTratamiento();
	}
	
	public function getVisita(){
		return $this->objectoCapaDato->getVisita();
	}

}

?>