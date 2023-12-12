<?php
include("./config/bd.php");

// Función para actualizar la reserva
function actualizarReserva($conn, $id_reserva, $asunto, $id_cliente) {
    $verificacion = $conn->query("SELECT COUNT(*) as count FROM cliente WHERE id = $id_cliente");
    $resultado = $verificacion->fetch_assoc();

    if ($resultado['count'] > 0) {
        $estado = 2;
        $sql = "UPDATE reservadecitas SET estado = '$estado', asunto = '$asunto', id_cliente='$id_cliente' WHERE id = '$id_reserva';";

        if ($conn->query($sql) === TRUE) {
            header("Location:./bienvenido.php?id=$id_cliente");
        } else {
            echo "Error al actualizar la reserva: " . $conn->error;
        }
    } else {
        echo "El ID del cliente no existe.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reserva = $_POST['idr'];
    $asunto = $_POST['asunto'];
    $id_cliente = $_POST['idUsuario'];

    actualizarReserva($conn, $id_reserva, $asunto, $id_cliente);
}

$conn->close();
?>
