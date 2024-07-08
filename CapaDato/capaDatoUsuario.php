<?php
include_once("conexion.php");
include('Kairos.php');
	class capaDatoUsuario{
		private $objetoConexion;


		public function __construct(){
			$this->objetoConexion=new conexion();
		}


		public function insertar($nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono,$tipo){
		
		$password_encriptado=base64_encode($cedula);
		
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
			"INSERT INTO persona (nombre, apellido, cedula, correo, nit, sexo, telefono) values ('$nombre', '$apellido','$cedula', '$correo', '$nit','$sexo','$telefono')");
		$this->objetoConexion->ejecutar(
				"INSERT INTO usuario (id, password, tipo) VALUES (LAST_INSERT_ID(), '$password_encriptado', '$tipo')");
		$this->objetoConexion->desconectar();		
		}

		public function insertarCliente($nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono,$tipo){
		
			$password_encriptado=base64_encode($cedula);
			
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
				"INSERT INTO persona (nombre, apellido, cedula, correo, nit, sexo, telefono) values ('$nombre', '$apellido','$cedula', '$correo', '$nit','$sexo','C')");
			$this->objetoConexion->ejecutar(
					"INSERT INTO usuario (id, password, tipo) VALUES (LAST_INSERT_ID(), '$password_encriptado', '$tipo')");
			
			$this->objetoConexion->desconectar();	
		}

		public function eliminar($id){
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
			"delete from persona where id='$id'");
			$this->objetoConexion->ejecutar(
				"delete from usuario where id='$id'");
			$this->objetoConexion->desconectar();
		}

		public function actualizar($id,$nombre, $apellido,$cedula,$correo,$nit,$sexo,$telefono,$tipo){
			$password_encriptado=base64_encode($cedula);
			$this->objetoConexion->conectar();
			$this->objetoConexion->ejecutar(
			"update persona set nombre='$nombre',apellido='$apellido',cedula='$cedula',correo='$correo',nit='$nit' ,sexo='$sexo',telefono='$telefono',password='$password_encriptado' where id='$id'");
			$this->objetoConexion->ejecutar(
				"update usuario set password='$password_encriptado',tipo='$tipo' where id='$id'");
				
			$this->objetoConexion->desconectar();
		}

		public function mostrar(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"SELECT 
				p.id,
				p.nombre,
				p.apellido,
				p.cedula,
				p.correo,
				p.nit,
				p.sexo,
				p.telefono,
				u.tipo
			FROM 
				persona p
			JOIN 
				usuario u
			ON 
				p.id = u.id;
			");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function buscar($b){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar("SELECT 
				p.id,
				p.nombre,
				p.apellido,
				p.cedula,
				p.correo,
				p.nit,
				p.sexo,
				p.telefono,
				u.tipo
			FROM 
				persona p
			JOIN 
				usuario u
			ON 
				p.id = u.id WHERE p.nombre LIKE '%".$b."%' LIMIT 10");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
	
		public function getUsuario(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from persona");

			$this->objetoConexion->desconectar();
			return $resultado;
		}

		public function getPacientes(){
			$this->objetoConexion->conectar();
			$resultado=$this->objetoConexion->ejecutar(
			"select * from persona");
			$this->objetoConexion->desconectar();
			return $resultado;
		}
		
	}


?>