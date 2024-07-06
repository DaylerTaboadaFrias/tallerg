<?php
include_once(".././CapaDato/capaDatoUsuario.php");
class capaNegocioUsuario{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoUsuario();
	}


	public function insertar($nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono,$tipo){
		$this->objectoCapaDato->insertar($nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono,$tipo);
	}

	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);
	}

	public function actualizar($id,$nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono,$tipo){
		$this->objectoCapaDato->actualizar($id,$nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono,$tipo);
	}

	public function mostrar(){
		return $this->objectoCapaDato->mostrar();
	}
	
	public function getUsuario(){
		return $this->objectoCapaDato->getUsuario();
	}
	public function getPacientes(){
		return $this->objectoCapaDato->getPacientes();
	}
}

?>