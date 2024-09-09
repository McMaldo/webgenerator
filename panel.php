<?php
require("./credenciales.php");
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
if(!isset($_SESSION["webgenerator"])){
	header('Location:  ./login.php');
}
$id = $_SESSION["webgenerator"]["id"];

if(isset($_POST["webName"])){
	$dominio = $id.$_POST["webName"];
	$date = date('Y-m-d');
	$conexion = conexionDB();
	$consulta = $conexion->prepare("SELECT idWeb FROM webs WHERE dominio = '$dominio'");
	$consulta->execute();
    if($consulta->rowCount() == 0){
		$conexion = conexionDB();
		$consulta = $conexion->prepare("INSERT INTO webs(idWeb,idUsuario,dominio, fechaCreacion) VALUES (NULL, '$id', '$dominio', '$date')");
		$consulta->execute();
		$result = $consulta->fetch(PDO::FETCH_ASSOC);
        shell_exec("./wix.sh " .$dominio);
        shell_exec("zip -r $dominio.zip $dominio");
		echo"web agregada";
	}else{
		echo"web ya existente";
	}
}

$conexion = conexionDB();
if($_SESSION['webgenerator']['email'] == "admin@server.com"){
	$consulta = $conexion->prepare("SELECT idWeb,dominio FROM webs");
}else{
	$consulta = $conexion->prepare("SELECT idWeb,dominio FROM webs WHERE idUsuario = '$id'");
}
$consulta->execute();
$result = $consulta->fetchAll(PDO::FETCH_ASSOC);
$webList = "";
foreach ($result as $key => $value) {
	$webList = $webList.'<tr><td>Ir a <a href="./'.$value['dominio'].'/index.php">'.$value['dominio'].'</a></td><td><a href="./'.$value['dominio'].'.zip">descargar web</a></td><td><a href="./delete.php?dominio='.$value['dominio'].'" class="eliminar">eliminar</a></td></tr>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Maldonado Ignacio</title>
	<style type="text/css">
		body{
			background-color: #1f1f1f;
			color: #f1f1f1;
		}
		button{
			cursor: pointer;
		}
		.eliminar{
			color: red;
		}
		.logout{
			color: grey;
			text-decoration: none;
		}
		td a{
			color: gray;
		}
	</style>
</head>
<body>
	<h1>Bienvenido a tu panel</h1>
	<a href="./logout.php" class="logout">cerrar sesion de <?= $_SESSION['webgenerator']['email']?></a>
	<br><br>
	<table>
		<tr><form method="post" action="panel.php"><td>Generar Web de: <input type="text" name="webName" placeholder="nombre de la web" maxlength="100" required></td><td><input type="submit" value="Crear web"></td></form></tr>
		<?= $webList ?>
	</table>
</body>
</html>