<?php
include_once("conexion.php");
	class capaDatoEnfermedad{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}

		public function getEnfermedades(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select * from enfermedad");
			$this->objetoConexion->desconectar();
			return $resultado;
		}




	}


?>