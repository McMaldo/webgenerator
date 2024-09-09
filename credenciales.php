<?php
function conexionDB(){
    define("HOST", "localhost");
    define("USER", 'adm_webgenerator');
    define("PASS", 'webgenerator2024');
    define("DB", "mysql:host=localhost;dbname=webgenerator");
    $conexion = new PDO(HOST, USER, PASS, DB);
    return $conexion;
}