<?php
include_once(".././CapaDato/capaDatoEvaluacion.php");
class capaNegocioEvaluacion{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoEvaluacion();
	}

	public function insertar($idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion){
		$this->objectoCapaDato->insertar($idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion);	
	}

	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);	
	}

	public function actualizar($id,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion){
		$this->objectoCapaDato->actualizar($id,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion);	
	}

	public function mostrar(){
		return $this->objectoCapaDato->mostrar();
	}
	public function getEvaluacion(){
		return $this->objectoCapaDato->getEvaluacion();
	}

	


}

?>