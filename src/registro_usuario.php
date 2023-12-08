<?php
include("./config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    $telefono = $_POST["telefono"];
    $rol = "Cliente";
    $estado = 1;

    // recuperar datos de mascota
    $nombre_mascota = $_POST["nombre_mascota"];
    $edad = $_POST["edad"];
    $tipo = $_POST["tipo"];
    $raza = $_POST["raza"];
    $peso = $_POST["peso"];


    $sql = "INSERT INTO persona (id, nombre, dni, correo, usuario, contrasenia, telefono, rol , estado)
    VALUES (null, '$nombre', '$dni', '$correo','$usuario' ,'$contrasenia', '$telefono', '$rol', '$estado')";
    
    
    

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $sql2= "INSERT INTO mascota (nombre, edad, tipo, id_persona, raza, peso) VALUES ('$nombre_mascota', $edad, '$tipo', $last_id, '$raza', $peso)";

        if(mysqli_query($conn, $sql2)){
            header("Location:./login.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
 
}
// Cerrar la conexión después de obtener los datos
$conn->close();

?>