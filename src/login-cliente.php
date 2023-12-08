<?php
session_start();
include("./config/bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    // Consulta preparada para evitar SQL injection
    $sql = "SELECT * FROM persona WHERE usuario = ? AND contrasenia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasenia);
    $stmt->execute();
    $result = $stmt->get_result();

    $consulta = "SELECT * FROM persona WHERE usuario='$usuario' AND contrasenia='$contrasenia'";
    $consultaresult = $conn->query($consulta);
    $registro = $consultaresult->fetch_assoc();
    $idUsuario = $registro['id'];



    if ($result->num_rows > 0) {
        // Obtener la primera fila de resultados
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["Id"];

        // Verificar el rol
        if ($row['rol'] === 'Administrador') {
            $_SESSION['logeado'] = true;
            header("Location:./secciones/reservas/index.php?id=$idUsuario"); // Redireccionar a la página de administrador
            exit();
        } elseif ($row['rol'] === 'Cliente') {
            $_SESSION['logeado'] = true;
            header("Location: ./bienvenido.php?id=$idUsuario"); // Redireccionar a la página de cliente
            exit();
        } elseif ($row['rol'] === 'Veterinario') {
            $_SESSION['logeado'] = true;
            header("Location: ./veterinario.php?id=$idUsuario"); // Redireccionar a la página de empleado
            exit();
        } else {
            $mensaje = "Rol desconocido";
        }
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
    }

    $stmt->close();
}
?>