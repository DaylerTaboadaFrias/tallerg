<?php
include_once("conexion.php");
	class capaDatoTrabajo{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}


		public function insertar($nombre, $precio,$nombreFoto,$rutaFoto,$idcategoria){
		$destino="../Public/Imagen/".$nombreFoto;
		copy($rutaFoto, $destino);
		$imagen=$destino;
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
			"insert into trabajo ( nombre, precio,imagen,idcategoria) values ('$nombre', '$precio', ' $imagen', '$idcategoria')");

		$this->objetoConexion->desconectar();	
		}

		public function eliminar($id){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
			"delete from trabajo where id='$id'");

			$this->objetoConexion->desconectar();
		}

		public function actualizar($id,$nombre,$precio,$nombreFoto,$rutaFoto,$idcategoria){
			$this->objetoConexion->conectar();
			if (!empty($nombreFoto) && !empty($rutaFoto)) {
			$destino="../Public/Imagen/".$nombreFoto;
			copy($rutaFoto, $destino);
			$imagen=$destino;
			$this->objetoConexion->ejecutar(
				"update trabajo set nombre='$nombre',precio='$precio',idcategoria='$idcategoria',imagen='$imagen' where id='$id'");
			}else{
				$this->objetoConexion->ejecutar(
				"update trabajo set nombre='$nombre',precio='$precio',idcategoria='$idcategoria' where id='$id'");
			}
			$this->objetoConexion->desconectar();
		}

		public function mostrar(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select trabajo.id,trabajo.nombre,trabajo.precio,trabajo.imagen, categoria.nombre as categoria from trabajo,categoria where categoria.id=trabajo.idcategoria");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function buscar($b){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select trabajo.id,trabajo.nombre,trabajo.precio,trabajo.imagen, categoria.nombre as categoria from trabajo,categoria where categoria.id=trabajo.idcategoria and trabajo.nombre LIKE '%".$b."%' LIMIT 10");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
	
		public function getTrabajo(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from trabajo");

			$this->objetoConexion->desconectar();
			return $resultado;
		}



		
	}


?>