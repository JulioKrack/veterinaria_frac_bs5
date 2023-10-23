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

    $sql = "INSERT INTO persona (id, nombre, dni, correo, usuario, contrasenia, telefono, rol , estado)
    VALUES (null, '$nombre', '$dni', '$correo','$usuario' ,'$contrasenia', '$telefono', '$rol', '$estado')";
    
    $sql2= "INSERT INTO cliente (id,id_persona) VALUES (null, LAST_INSERT_ID());";
    

    if ($conn->query($sql) === TRUE) {
        if($rol == "Cliente" ){
            $conn->query($sql2);
            header("Location:./login2.php");
        }
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }  
}
// Cerrar la conexión después de obtener los datos
$conn->close();

?>