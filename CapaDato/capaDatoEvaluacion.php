<?php
include_once("conexion.php");
	class capaDatoEvaluacion{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}


		public function insertar($idusuario,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion){
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
			"INSERT INTO evaluacion_dental (antecedentes_patologicos, motivo, diagnostico, fecha, tipo_oclusion, id_paciente, id_usuario) VALUES
			 ('$antecedentes', '$motivo', ' $diagnostico', '$fecha', '$tipo_oclusion', '$idcliente', '$idusuario')");

		$this->objetoConexion->desconectar();	
		}

		public function eliminar($id){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
			"delete from evaluacion_dental where id='$id'");

			$this->objetoConexion->desconectar();
		}

		public function actualizar($id,$idcliente,$fecha,$motivo,$diagnostico,$antecedentes,$tipo_oclusion){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"update evaluacion_dental set antecedentes_patologicos='$antecedentes',motivo='$motivo',diagnostico='$diagnostico',fecha='$fecha' ,tipo_oclusion='$tipo_oclusion',id_paciente='$idcliente' where id='$id'");
			
			$this->objetoConexion->desconectar();
		}

		public function mostrar($idusuario){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"SELECT 
					evaluacion_dental.id,
					evaluacion_dental.id_paciente,
					CONCAT(persona.nombre, ' ', persona.apellido) AS nombre_completo_cliente,
					evaluacion_dental.motivo,
					evaluacion_dental.diagnostico,
					evaluacion_dental.tipo_oclusion,
					evaluacion_dental.antecedentes_patologicos,
					evaluacion_dental.fecha
				FROM 
					evaluacion_dental
				JOIN 
					paciente ON evaluacion_dental.id_paciente = paciente.id
				JOIN 
					persona ON persona.id = paciente.id
				JOIN 
					usuario ON evaluacion_dental.id_usuario = usuario.id
				WHERE usuario.id = '$idusuario'
				");

			$this->objetoConexion->desconectar();
			return $resultado;
		}
		public function mostrarAdmin(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"SELECT 
					evaluacion_dental.id,
					evaluacion_dental.id_paciente,
					CONCAT(persona.nombre, ' ', persona.apellido) AS nombre_completo_cliente,
					evaluacion_dental.motivo,
					evaluacion_dental.diagnostico,
					evaluacion_dental.tipo_oclusion,
					evaluacion_dental.antecedentes_patologicos,
					evaluacion_dental.fecha
				FROM 
					evaluacion_dental
				JOIN 
					paciente ON evaluacion_dental.id_paciente = paciente.id
				JOIN 
					persona ON persona.id = paciente.id
				");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function buscar($b){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("SELECT 
					evaluacion_dental.id,
					evaluacion_dental.id_paciente,
					CONCAT(persona.nombre, ' ', persona.apellido) AS nombre_completo_cliente,
					evaluacion_dental.motivo,
					evaluacion_dental.diagnostico,
					evaluacion_dental.tipo_oclusion,
					evaluacion_dental.antecedentes_patologicos,
					evaluacion_dental.fecha
				FROM 
					evaluacion_dental
				JOIN 
					paciente ON evaluacion_dental.id_paciente = paciente.id
				JOIN 
					persona ON persona.id = paciente.id
				WHERE 
					evaluacion_dental.motivo LIKE '%".$b."%'
				LIMIT 10");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
		public function getEvaluacionAdmin(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"SELECT 
					evaluacion_dental.id,
					evaluacion_dental.id_paciente,
					CONCAT(persona.nombre, ' ', persona.apellido) AS nombre_completo_cliente,
					evaluacion_dental.motivo,
					evaluacion_dental.diagnostico,
					evaluacion_dental.tipo_oclusion,
					evaluacion_dental.antecedentes_patologicos,
					evaluacion_dental.fecha
				FROM 
					evaluacion_dental
				JOIN 
					paciente ON evaluacion_dental.id_paciente = paciente.id
				JOIN 
					persona ON persona.id = paciente.id");

			$this->objetoConexion->desconectar();
			return $resultado;
		}
		public function getEvaluacion($idusuario){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"SELECT 
					evaluacion_dental.id,
					evaluacion_dental.id_paciente,
					CONCAT(persona.nombre, ' ', persona.apellido) AS nombre_completo_cliente,
					evaluacion_dental.motivo,
					evaluacion_dental.diagnostico,
					evaluacion_dental.tipo_oclusion,
					evaluacion_dental.antecedentes_patologicos,
					evaluacion_dental.fecha
				FROM 
					evaluacion_dental
				JOIN 
					paciente ON evaluacion_dental.id_paciente = paciente.id
				JOIN 
					persona ON persona.id = paciente.id
				JOIN 
					usuario ON evaluacion_dental.id_usuario = usuario.id
				WHERE 
					usuario.id = '$idusuario'
					");

			$this->objetoConexion->desconectar();
			return $resultado;
		}



		
	}


?>