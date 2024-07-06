<?php
include_once("conexion.php");
	class capaDatoEnfermedadSintoma{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}

		public function getEnfermedadesSintomas(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select * from enfermedadsintoma");
			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function getNombreSintomasByEnfermedadId($id){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select sintoma.id,sintoma.nombre,sintoma.simbolo from sintoma,enfermedad,enfermedadsintoma where sintoma.id=enfermedadsintoma.idsintoma and enfermedad.id=enfermedadsintoma.idenfermedad and enfermedad.id='$id'");
			$this->objetoConexion->desconectar();
			return $resultado;
		}	

		public function getPonderacionById($idSintoma,$idEnfermedad){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("select ponderacion from enfermedadsintoma where enfermedadsintoma.idenfermedad='$idEnfermedad' and enfermedadsintoma.idsintoma='$idSintoma'");
			$this->objetoConexion->desconectar();
			return $resultado;
		}	

		
	}


?>