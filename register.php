<?php
require("./credenciales.php");
session_start();
if(isset($_SESSION["webgenerator"])){
	header('Location:  ./panel.php');
}
if(isset($_POST['email'])){
	if($_POST['pass1']!=$_POST['pass2']){
		echo'contraseñas ingresadas diferentes';
		exit();
	}
	$password = $_POST['pass1'];
	$email = $_POST['email'];
	$fecha = date("Y-m-d H:i:s");
	$conexion = conexionDB();
	$consulta = $conexion->prepare("SELECT idUsuario,email,password FROM usuarios WHERE email = '$email' ");
	$consulta->execute();
	if (!($consulta->fetch(PDO::FETCH_ASSOC))) {
	  	$consulta = $conexion->prepare("INSERT INTO usuarios (email, password,fechaRegistro) VALUES ('$email','$password','$fecha')");
		$consulta->execute();
		header('Location: ./login.php');
	}else{
		echo'email incorrecto';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Maldonado Ignacio</title>
</head>
<body style="background-color: #1f1f1f; color: #f1f1f1;">
	<h1>Registrarte es Simple</h1>
	<form method="post" action="./register.php">
		<table>
			<tr><td>email:</td><td><input type="email" name="email" placeholder="ingresar email" maxlength="100" required></td><td>(max:100)</td></tr>
			<tr><td>password:</td><td><input type="password" name="pass1" placeholder="ingresar contraseña" minlength="5" maxlength="100" required></td><td>(min:5, max:100)</td></tr>
			<tr><td>password:</td><td><input type="password" name="pass2" placeholder="repetir contraseña" minlength="5" maxlength="100" required></td><td>(min:5, max:100)</td></tr>
			<tr><td></td><td><input type="submit" value="registrarme"></td></tr>
			<tr><td></td><td><a href="./login.php">ya tienes cuenta</a></td></tr>
		</table>
	</form>
</body>
</html>