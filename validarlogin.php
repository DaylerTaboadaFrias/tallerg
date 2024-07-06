<?php 
session_start();
include_once("CapaDato/conexion.php");
$email = $_POST['email'];
$password = $_POST['password'];

$conexion = new conexion();
$conexion->conectar();
$id_base=$conexion->ejecutar("select id from persona where correo='$email'");
$idpersona=$id_base[0]['id'];
$password_base=$conexion->ejecutar("select password from usuario where id='$idpersona'");
$password_base=$password_base[0]['password'];
$password_descencritado=base64_decode($password_base);
if ($password_descencritado == $password ) {
	$conexion->conectar();
	$usuario=$conexion->ejecutar("select * from usuario where id='$idpersona'");
	$_SESSION['user']=$usuario[0]['id'];
	$_SESSION['tipo']=$usuario[0]['tipo'];
	header("location:bienvenido.php");
}else{
	header("location:login.php");
}

?>
