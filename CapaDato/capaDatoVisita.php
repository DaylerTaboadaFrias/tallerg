<?php
include_once("conexion.php");
	class capaDatoVisita{
	private $objetoConexion;


	public function __construct(){
		$this->objetoConexion=new conexion();
	}


	public function insertar($descripcion, $pagoadelanto,$idtratamiento){
	$this->objetoConexion->conectar();
	$this->objetoConexion->ejecutar(
		"insert into visita ( descripcion, pagoadelanto,idtratamiento) values ('$descripcion', '$pagoadelanto','$idtratamiento')");

	$this->objetoConexion->desconectar();	
	}

	public function eliminar($id){
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
		"delete from visita where id='$id'");

		$this->objetoConexion->desconectar();
	}

	public function actualizar($id,$descripcion, $pagoadelanto,$idtratamiento){
		$this->objetoConexion->conectar();
		$this->objetoConexion->ejecutar(
			"update visita set descripcion='$descripcion',pagoadelanto='$pagoadelanto',idtratamiento='$idtratamiento' where id='$id'");
		$this->objetoConexion->desconectar();
	}

	public function mostrar(){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar(
		"select visita.id,visita.descripcion,visita.pagoadelanto,tratamiento.descripcion as tratamiento,tratamiento.montototal,(select sum(visita.pagoadelanto)from visita where tratamiento.id=visita.idtratamiento)as montopagado  ,(select round((tratamiento.montototal- sum(visita.pagoadelanto)),1) from visita where visita.idtratamiento=tratamiento.id)as montoacobrar from visita,tratamiento where visita.idtratamiento=tratamiento.id group by visita.id");

		$this->objetoConexion->desconectar();
		return $resultado;
	}

	public function buscar($b){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar("select visita.id,visita.descripcion,visita.pagoadelanto,tratamiento.descripcion as tratamiento,tratamiento.montototal,(select sum(visita.pagoadelanto)from visita where tratamiento.id=visita.idtratamiento)as montopagado  ,(select round((tratamiento.montototal- sum(visita.pagoadelanto)),1) from visita where visita.idtratamiento=tratamiento.id)as montoacobrar from visita,tratamiento where  visita.descripcion LIKE '%".$b."%' and visita.idtratamiento=tratamiento.id group by visita.id");
		$this->objetoConexion->desconectar();
		return $resultado;
	}


	public function getTratamiento(){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar(
		"select tratamiento.id,tratamiento.descripcion,usuario.apellido as apellido,usuario.nombre as nombre from tratamiento,usuario where tratamiento.idusuario=usuario.id");

		$this->objetoConexion->desconectar();
		return $resultado;
	}

	public function getVisita(){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar(
		"select visita.id,visita.descripcion,usuario.apellido as apellido,usuario.nombre as nombre from visita,usuario,tratamiento where tratamiento.idusuario=usuario.id and visita.idtratamiento=tratamiento.id");

		$this->objetoConexion->desconectar();
		return $resultado;
	}		
	
	public function getVisitaTratamiento(){
		$this->objetoConexion->conectar();
		$resultado = $this->objetoConexion->ejecutar("Select * from visita order by id desc limit 1");

		$this->objetoConexion->desconectar();
		return $resultado;
		
	}

	public function insertarClienteVisita($descripcion,$idtratamiento){
	$this->objetoConexion->conectar();
	$this->objetoConexion->ejecutar(
		"insert into visita (descripcion, pagoadelanto,idtratamiento) values ('$descripcion', '0','$idtratamiento')");

	$this->objetoConexion->desconectar();	
	}

	}


?>