<?php
include_once(".././CapaDato/capaDatoMedicamento.php");
class capaNegocioMedicamento{
	public $objectoCapaDato;

	

	public function __construct(){
		$this->objectoCapaDato=new capaDatoMedicamento();
	}


	public function insertar($nombre, $marca,$medida,$tipo,$nombreFoto,$rutaFoto){
		$this->objectoCapaDato->insertar($nombre, $marca,$medida,$tipo,$nombreFoto,$rutaFoto);
	}

	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);
	}

	public function actualizar($id,$nombre, $marca,$medida,$tipo,$nombreFoto,$rutaFoto){
		$this->objectoCapaDato->actualizar($id,$nombre, $marca,$medida,$tipo,$nombreFoto,$rutaFoto);
	}

	public function mostrar(){
		return $this->objectoCapaDato->mostrar();
	}

	public function getMedicamento(){
		return $this->objectoCapaDato->getMedicamento();
	}	
}


	
?>