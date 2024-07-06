<?php
include_once(".././CapaDato/capaDatoAgenda.php");
class capaNegocioAgenda{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoAgenda();
	}


	public function mostrar(){
		return $this->objectoCapaDato->mostrar();
	}
	public function insertar($title,$color,$descripcion,$start,$end,$idvisita){
        $this->objectoCapaDato->insertar($title,$color,$descripcion,$start,$end,$idvisita);	
	}

	public function actualizar($id,$title,$color,$descripcion,$start,$end,$idvisita){
        $this->objectoCapaDato->actualizar($id,$title,$color,$descripcion,$start,$end,$idvisita);	
	}
	public function eliminar($id){
        $this->objectoCapaDato->eliminar($id);	
	}


}

?>