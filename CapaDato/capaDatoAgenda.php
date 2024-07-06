<?php
include_once("conexion.php");
class capaDatoAgenda{
	private $objetoConexion;


	public function __construct(){
		$this->objetoConexion=new conexion();
	}



	public function mostrar(){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar(
		"select agenda.id,agenda.color,agenda.start,agenda.end,agenda.descripcion,agenda.title,visita.descripcion as visita,usuario.nombre as nombre,usuario.apellido as apellido from agenda,visita,tratamiento,usuario where agenda.idvisita=visita.id and visita.idtratamiento=tratamiento.id and tratamiento.idusuario=usuario.id");

		$this->objetoConexion->desconectar();
		return $resultado;
	}

	public function insertar($title,$color,$descripcion,$start,$end,$idvisita){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar("insert into agenda (title,descripcion,color,textColor,start,end,idvisita) values ('$title', '$descripcion','$color','#ffffff','$start','$end','$idvisita')");

		$this->objetoConexion->desconectar();
	}

	public function actualizar($id,$title,$color,$descripcion,$start,$end,$idvisita){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar("update agenda set title='$title',color='$color',descripcion='$descripcion',start='$start',end='$end',idvisita='$idvisita' where id='$id'");

		$this->objetoConexion->desconectar();
	}

	public function eliminar($id){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar("delete from agenda where id='$id'");

		$this->objetoConexion->desconectar();
	}

	public function insertarClienteAgenda($title,$color,$descripcion,$start,$end,$idvisita){
		$this->objetoConexion->conectar();
		$resultado=$this->objetoConexion->ejecutar("insert into agenda (title,descripcion,color,textColor,start,end,idvisita) values ('$title', '$descripcion','$color','#ffffff','$start','$end','$idvisita')");

		$this->objetoConexion->desconectar();
	}
	
}


?>