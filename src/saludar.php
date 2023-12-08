<?php
session_start(); 

include("./config/bd.php");

// Recuperar el id del usuario de la url y mostrar su nombre
if(isset($_GET['id'])){
    $id_usuario = $_GET['id'];
    $sql = "SELECT * FROM persona WHERE id = '$id_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $registro = $result->fetch_assoc();
        $nombre = $registro['nombre'];

        // Enviar el nombre como respuesta
        echo $nombre;
    } else {
        // Manejar el caso en que no se encuentre el usuario
        echo "Usuario no encontrado";
    }
}

$conn->close();
?>
