<?php
include_once("conexion.php");
	class capaDatoCategoria{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}


		public function insertar($nombre, $descripcion){
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
			"insert into categoria (nombre, descripcion) values ('$nombre', '$descripcion')");

		$this->objetoConexion->desconectar();	
		}

		public function eliminar($id){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
			"delete from categoria where id='$id'");

			$this->objetoConexion->desconectar();
		}

		public function actualizar($id,$nombre,$descripcion){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"update categoria set nombre='$nombre',descripcion='$descripcion' where id='$id'");
			$this->objetoConexion->desconectar();
		}

		public function mostrar(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from categoria");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function buscar($b){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("SELECT * FROM categoria WHERE nombre LIKE '%".$b."%' LIMIT 10");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
	

		public function getCategoria(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from categoria");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		
	}


?>