<?php
session_start();
include("./config/bd.php");

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    // Verificar si es un Administrador
    $sqlAdmin = "SELECT * FROM administrador WHERE usuario = ? AND contrasenia = ?";
    $stmtAdmin = $conn->prepare($sqlAdmin);
    $stmtAdmin->bind_param("ss", $usuario, $contrasenia);
    $stmtAdmin->execute();
    $resultAdmin = $stmtAdmin->get_result();

    if ($resultAdmin->num_rows > 0) {
        $rowAdmin = $resultAdmin->fetch_assoc();
        $idUsuario = $rowAdmin['id'];

        $_SESSION['logeado'] = true;
        header("Location: ./secciones/reservas/index.php?id=$idUsuario"); // Redireccionar a la página de administrador
        exit();
    }

    // Verificar si es un Cliente
    $sqlCliente = "SELECT * FROM cliente WHERE usuario = ?";
    $stmtCliente = $conn->prepare($sqlCliente);
    $stmtCliente->bind_param("s", $usuario);
    $stmtCliente->execute();
    $resultCliente = $stmtCliente->get_result();

    if ($resultCliente->num_rows > 0) {
        $rowCliente = $resultCliente->fetch_assoc();

        // Verificar la contraseña usando password_verify
        if (password_verify($contrasenia, $rowCliente['contrasenia'])) {
            $idUsuario = $rowCliente['id'];

            $_SESSION['logeado'] = true;
            header("Location: ./bienvenido.php?id=$idUsuario");
            exit();
        } else {
            $mensaje = "Contraseña incorrecta";
        }
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
    }

    // Verificar si es un Veterinario
    $sqlVeterinario = "SELECT * FROM veterinario WHERE usuario = ? AND contrasenia = ?";
    $stmtVeterinario = $conn->prepare($sqlVeterinario);
    $stmtVeterinario->bind_param("ss", $usuario, $contrasenia);
    $stmtVeterinario->execute();
    $resultVeterinario = $stmtVeterinario->get_result();

    if ($resultVeterinario->num_rows > 0) {
        $rowVeterinario = $resultVeterinario->fetch_assoc();
        $idVeterinario = $rowVeterinario['id'];

        $_SESSION['logeado'] = true;
        header("Location: ./veterinario.php?id=$idVeterinario"); // Redireccionar a la página de veterinario
        exit();
    }

    // Si no se encuentra en ninguna tabla, mostrar mensaje de error
    $mensaje = "Usuario o contraseña incorrectos";

    $stmtAdmin->close();
    $stmtCliente->close();
    $stmtVeterinario->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Tu código para el encabezado -->

    <script>
        // Función para mostrar una alerta
        function mostrarAlerta(mensaje) {
            alert(mensaje);
            window.location.href = "./login.php";
        }
    </script>
</head>
<body>

<!-- Tu código HTML -->

<?php if ($mensaje !== "") : ?>
    <script>
        // Llama a la función JavaScript para mostrar la alerta
        mostrarAlerta("<?php echo $mensaje; ?>");
    </script>
<?php endif; ?>

<!-- Más código HTML -->

</body>
</html>
