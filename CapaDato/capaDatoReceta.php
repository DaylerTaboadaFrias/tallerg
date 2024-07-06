<?php
include_once("conexion.php");
	class capaDatoReceta{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}

		public function insertar($recomendacion,$fecha,$idtratamiento){
			
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"insert into receta (recomendacion, fecha,idtratamiento) values ('$recomendacion', '$fecha','$idtratamiento')");
			$this->objetoConexion->desconectar();	
		}



		public function eliminar($id){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"delete from receta where id='$id'");
			$this->objetoConexion->desconectar();
		}


		public function mostrar($idusuario){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
				"select receta.id,receta.recomendacion,receta.fecha,tratamiento.descripcion as tratamiento, persona.nombre as nombre, persona.apellido from usuario,tratamiento,receta,evaluacion_dental,paciente,persona where receta.idtratamiento=tratamiento.id 
				and tratamiento.id_evaluacion=evaluacion_dental.id and evaluacion_dental.id_paciente = paciente.id and persona.id = paciente.id and evaluacion_dental.id_usuario = usuario.id and usuario.id = '$idusuario'
				");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function mostrarAdmin(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
				"select receta.id,receta.recomendacion,receta.fecha,tratamiento.descripcion as tratamiento, persona.nombre as nombre, persona.apellido from tratamiento,receta,evaluacion_dental,paciente,persona where receta.idtratamiento=tratamiento.id 
				and tratamiento.id_evaluacion=evaluacion_dental.id and evaluacion_dental.id_paciente = paciente.id and persona.id = paciente.id");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function buscar($b){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select receta.id,receta.recomendacion,receta.fecha,tratamiento.descripcion as tratamiento, usuario.nombre as nombre, usuario.apellido from tratamiento,receta,usuario where receta.idtratamiento=tratamiento.id and tratamiento.idusuario=usuario.id and usuario.apellido LIKE '%".$b."%' LIMIT 10");
			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function getIdReceta(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select id from receta");

			$this->objetoConexion->desconectar();
			return $resultado;			
		}





		public function getIdUltimoReceta(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select id from receta order by id desc limit 1");

			$this->objetoConexion->desconectar();
			return $resultado;
			
		}
		
	}


?>