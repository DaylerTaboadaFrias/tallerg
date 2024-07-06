<?php
include_once(".././CapaDato/capaDatoPaciente.php");
class capaNegocioPaciente{
	public $objectoCapaDato;
	public function __construct(){
		$this->objectoCapaDato=new capaDatoPaciente();
	}


	public function insertar($nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono){
		$this->objectoCapaDato->insertar($nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono);
	}

	public function eliminar($id){
		$this->objectoCapaDato->eliminar($id);
	}

	public function actualizar($id,$nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono){
		$this->objectoCapaDato->actualizar($id,$nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono);
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