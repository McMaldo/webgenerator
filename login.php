<?php
require("./credenciales.php");
session_start();
$error="";
if(isset($_SESSION["webgenerator"])){
	header('Location:  ./panel.php');
}
if(isset($_POST['email'])){
	$email = $_POST['email'];
	$conexion = conexionDB();
	$consulta = $conexion->prepare("SELECT idUsuario,email,password FROM usuarios WHERE email = '$email' ");
	$consulta->execute();
	$result = $consulta->fetch(PDO::FETCH_ASSOC);
	if (isset($result["password"])) {
	  	$passBD = $result["password"];
	  	if($_POST['password']==$passBD){
			echo'todo correcto';
			session_start();
			$_SESSION["webgenerator"]=[
				"id"=>$result["idUsuario"],
				"email"=>$result["email"]
			];
			header('Location: ./panel.php');
		}else{
			$error="pass";
		}
	}else{
		$error="email";
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
	<h1>WebGenerator Maldonado Pablo</h1>
	<form method="post" action="./login.php">
		<table>
			<tr><td>email:</td><td><input type="email" name="email" placeholder="ingresar email" maxlength="100" required></td><?=($error=="email"?"<td>email no registrado</td>":"")?></tr>
			<tr><td>password:</td><td><input type="password" name="password" placeholder="ingresar password" maxlength="100" required></td><?=($error=="pass"?"<td>password incorrecta</td>":"")?></tr>
			<tr><td></td><td><input type="submit" value="ingresar"></td></tr>
			<tr><td></td><td><a href="./register.php">registrate</a></td></tr>
		</table>
	</form>
</body>
</html>