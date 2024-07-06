<?php
include_once(".././CapaDato/capaDatoHistoria.php");
class capaNegocioHistoria{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoHistoria();
	}

	public function insertar($nombre, $descripcion){
		$this->objectoCapaDato->insertar($nombre, $descripcion);	
	}
	public function obtenerHistoriaClinica($pacienteId) {
        return $this->objectoCapaDato->obtenerHistoriaClinica($pacienteId);
    }
	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);	
	}

	public function actualizar($id,$nombre,$descripcion){
		$this->objectoCapaDato->actualizar($id,$nombre,$descripcion);	
	}

	public function mostrar(){
		return $this->objectoCapaDato->mostrar();
	}
	
	public function getCategoria(){
		return $this->objectoCapaDato->getCategoria();
	}

}

?>