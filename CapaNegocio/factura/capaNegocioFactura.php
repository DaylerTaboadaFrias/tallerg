<?php
include_once("../../CapaDato/capaDatoFactura.php");
class capaNegocioFactura{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoFactura();
	}

	public function insertar($nit, $idtratamiento){
		$this->objectoCapaDato->insertar($nit, $idtratamiento);	
	}

	
	


}

?>