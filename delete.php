<?php
    require("./credenciales.php");
    if (isset($_GET['dominio'])) {
        $file = $_GET['dominio'];
        $conexion = conexionDB();
        shell_exec("rm -r $file");
        shell_exec("rm -r $file.zip");
        $query = $conexion->prepare("DELETE FROM `webs` WHERE dominio = '$file'");
        $query->execute();
        header("Location: panel.php");
    }
?>