<?php
include_once("conexion.php");
	class capaDatoTrabajoTratamiento{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}

		public function insertar($idtrabajo,$idtratamiento,$precio,$cantidad){
			
			$this->objetoConexion->conectar();

			$this->objetoConexion->ejecutar(
				"insert into trabajotratamiento (idtrabajo, idtratamiento,precio,cantidad) values ('$idtrabajo', '$idtratamiento','$precio', '$cantidad')");

			$this->objetoConexion->desconectar();	
		}


		public function getTrabajoTratamientoByIdTratamiento($id){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
				"select idtratamiento,trabajotratamiento.precio,trabajotratamiento.cantidad,round(trabajotratamiento.precio*trabajotratamiento.cantidad,1) as subtotal, trabajo.nombre as trabajo from trabajotratamiento,trabajo where trabajotratamiento.idtrabajo=trabajo.id and idtratamiento='$id'");
			$this->objetoConexion->desconectar();
			return 	$resultado;
		}




		
	}


?>