<?php
include_once("conexion.php");
	class capaDatoSintoma{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}

		public function getSintomas(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select * from sintoma");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
			
	}


?>