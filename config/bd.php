<?php
    $servidor="localhost";
    $usuario="root";
    $clave="";
    $baseDeDatos="veterinaria_frac";

    try{
        $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$clave);
    }catch (Exception $ex){
        echo $ex->getMessage();
    }
?>