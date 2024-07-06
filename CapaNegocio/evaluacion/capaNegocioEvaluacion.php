<?php
include_once(".././CapaDato/capaDatoEvaluacion.php");
class capaNegocioEvaluacion{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoEvaluacion();
	}

	public function insertar($idusuario,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion){
		$this->objectoCapaDato->insertar($idusuario,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion);	
	}

	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);	
	}

	public function actualizar($id,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion){
		$this->objectoCapaDato->actualizar($id,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion);	
	}

	public function mostrar($idusuario){
		return $this->objectoCapaDato->mostrar($idusuario);
	}
	public function mostrarAdmin(){
		return $this->objectoCapaDato->mostrarAdmin();
	}
	public function getEvaluacionAdmin(){
		return $this->objectoCapaDato->getEvaluacionAdmin();
	}
	public function getEvaluacion($idusuario){
		return $this->objectoCapaDato->getEvaluacion($idusuario);
	}
	


}

?>