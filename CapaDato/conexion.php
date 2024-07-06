<?php
	class conexion{
		private $cadenaConexion;
		private $user;
		private $password;
		private $objectoConexion;


		public function __construct(){
			$this->cadenaConexion='mysql:host=127.0.0.1;port=3306;dbname=centraldent';
			$this->user='root';
			$this->password='';
		}
		// public function __construct(){
		// 	$this->cadenaConexion='mysql:host=mysql-158297-0.cloudclusters.net;port=16807;dbname=clinica';
		// 	$this->user='admin';
		// 	$this->password='yXga330A';
		// }
		public function conectar(){
			try{
				$this->objectoConexion=new PDO('mysql:host=127.0.0.1;port=3306;dbname=centraldent','root','');
			}catch(PDOException $ex){
				echo "Problema al conectar con la base de datos";
			}
		}
		// public function conectar(){
		// 	try{
		// 		$this->objectoConexion=new PDO('mysql:host=mysql-158297-0.cloudclusters.net;port=16807;dbname=clinica','admin','yXga330A');
		// 	}catch(PDOException $ex){
		// 		echo "Problema al conectar con la base de datos";
		// 	}
		// }
		public function desconectar(){
			$this->objectoConexion=null;
		}

		public function ejecutar($comando){
			try{
				$ejecutar=$this->objectoConexion->prepare($comando);
				$ejecutar->execute();
				$rows=$ejecutar->fetchAll();
				return $rows;
			}catch(PDOException $ex){
				throw $ex;
			
			}
		}


		
	}


?>