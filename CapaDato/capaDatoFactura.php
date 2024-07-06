<?php
include_once("conexion.php");
	class capaDatoFactura{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}


		public function insertar($nit,$idtratamiento){
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
			"insert into factura (nit, fecha,idtratamiento) values ('$nit', Now(),'$idtratamiento')");

		$this->objetoConexion->desconectar();	
		}
		
	}


?>