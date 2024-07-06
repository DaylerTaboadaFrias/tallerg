<?php
include_once("conexion.php");
	class capaDatoMedicamento{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}

		public function insertar($nombre, $marca,$medida,$tipo,$nombreFoto,$rutaFoto){

			$destino="../Public/Imagen/".$nombreFoto;
			copy($rutaFoto, $destino);
			$imagen=$destino;
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"insert into medicamento (nombre, marca,medida, imagen,tipo) values ('$nombre', '$marca','$medida', ' $imagen', '$tipo')");
			$this->objetoConexion->desconectar();	
		}

		public function eliminar($id){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"delete from medicamento where id='$id'");

			$this->objetoConexion->desconectar();
		}

		public function actualizar($id,$nombre, $marca,$medida,$tipo,$nombreFoto,$rutaFoto){
			$this->objetoConexion->conectar();
			if (!empty($nombreFoto) && !empty($rutaFoto)) {
			$destino="../Public/Imagen/".$nombreFoto;
			copy($rutaFoto, $destino);
			$imagen=$destino;
			$this->objetoConexion->ejecutar(
				"update medicamento set nombre='$nombre',marca='$marca',medida='$medida',tipo='$tipo',imagen='$imagen' where id='$id'");
			}else{
				$this->objetoConexion->ejecutar(
				"update medicamento set nombre='$nombre',marca='$marca',medida='$medida',tipo='$tipo' where id='$id'");
			}
			

			$this->objetoConexion->desconectar();
		}

		public function mostrar(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
				"select * from medicamento");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function buscar($b){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("SELECT * FROM medicamento WHERE nombre LIKE '%".$b."%' LIMIT 10");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
	

		public function getMedicamento(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from medicamento");

			$this->objetoConexion->desconectar();
			return $resultado;	
		}


		
	}


?>