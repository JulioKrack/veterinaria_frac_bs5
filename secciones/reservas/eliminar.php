<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

// Verificar si se ha enviado un ID de reserva para eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_reserva'])) {
    $id_reserva = $_POST['id_reserva'];

    // Eliminar la reserva de la base de datos
    $sql = "DELETE FROM reserva_de_citas WHERE id_reserva = '$id_reserva'";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Reservation</title>
</head>
<body>

    <!-- Formulario para eliminar una reserva -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="id_reserva">ID Reserva a eliminar</label>
        <input type="text" name="id_reserva" id="id_reserva" required>
        <br>
        <input type="submit" name="eliminar_reserva" value="Eliminar Reserva">
    </form>

</body>
</html>
<?php include("../../plantillas/footer.php")?>