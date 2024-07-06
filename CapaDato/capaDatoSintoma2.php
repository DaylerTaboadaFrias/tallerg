<?php
include_once("conexion.php");
	class capaDatoSintoma{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}

		public function getSintomasByIdEnfermedad($id){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select * from sintoma where sintoma.idenfermedad='$id'");

			$this->objetoConexion->desconectar();
			return $resultado;
		}
		public function getSintomaByNombre($nombre){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select * from sintoma where nombre='$nombre'");

			$this->objetoConexion->desconectar();
			return $resultado;
		}
		public function getEnfermedadById($id){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select * from enfermedad where id='$id'");

			$this->objetoConexion->desconectar();
			return $resultado;
		}		
	}


?>