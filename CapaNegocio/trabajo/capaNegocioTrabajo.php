<?php
include_once(".././CapaDato/capaDatoTrabajo.php");
class capaNegocioTrabajo{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoTrabajo();
	}

	public function insertar($nombre,$precio,$nombreFoto,$rutaFoto,$idcategoria){
		$this->objectoCapaDato->insertar($nombre,$precio,$nombreFoto,$rutaFoto,$idcategoria);	
	}

	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);	
	}

	public function actualizar($id,$nombre,$precio,$nombreFoto,$rutaFoto,$idcategoria){
		$this->objectoCapaDato->actualizar($id,$nombre,$precio,$nombreFoto,$rutaFoto,$idcategoria);	
	}

	public function mostrar(){
		return $this->objectoCapaDato->mostrar();
	}
	public function getTrabajo(){
		return $this->objectoCapaDato->getTrabajo();
	}

	


}

?>