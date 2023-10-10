<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $fecha_reservada = $_POST['fecha_reservada'];
    $intervalo_hora = $_POST['hora_reservada'];
    $asunto = $_POST['asunto'];
    $estado = $_POST['estado'];
    $id_administrador = $_POST['id_administrador'];
    $id_veterinario = $_POST['id_veterinario'];

    // Validar datos (puedes agregar más validaciones según tus necesidades)
    $fecha_hora_reserva = $fecha_reservada . ' ' . $intervalo_hora;

    // Insertar datos en la base de datos
    $sql = "INSERT INTO reserva_de_citas (id_cliente, fecha_reservada, asunto, estado, id_administrador, id_veterinario)
            VALUES ('$id_cliente', '$fecha_hora_reserva', '$asunto', '$estado', '$id_administrador', '$id_veterinario')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation created successfully";
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
    <title>Reservation Form</title>
</head>
<body>

    <div class="card">
        <div class="card-header">
            <p class="card-text">Formulario para crear una reserva.</p>
        </div>
        <div class="card-body">
    <!-- Formulario para insertar datos -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="id_cliente">ID Cliente</label>
                <input type="text" name="id_cliente" id="id_cliente" required>
                <br>
                <label for="fecha_reservada">Fecha Reservada</label>
                <input type="date" id="start" name="fecha_reservada" value="2023-10-01" 
                min="2023-10-01" max="2023-12-31" />
                <br>
                <!-- <label for="fecha_reservada">Fecha Reservada</label>
                <input type="text" name="fecha_reservada" id="fecha_reservada" required>
                <br> -->
                <div class="mb-3">
                    <label for="hora_reservada" class="form-label">Intervalo de horas</label>
                    <select class="hora_reservada form-select-lg" name="hora_reservada" id="hora_reservada">
                        <option selected>0:00-1:00</option>
                        <option value="">1:00-2:00</option>
                        <option value="">2:00-3:00</option>
                        <option value="">3:00-4:00</option>
                        <option value="">4:00-5:00</option>
                        <option value="">5:00-6:00</option>
                        <option value="">6:00-7:00</option>
                        <option value="">7:00-8:00</option>
                        <option value="">8:00-9:00</option>
                        <option value="">9:00-10:00</option>
                        <option value="">10:00-11:00</option>
                        <option value="">11:00-12:00</option>
                        <option value="">12:00-13:00</option>
                        <option value="">13:00-14:00</option>
                        <option value="">14:00-15:00</option>
                        <option value="">15:00-16:00</option>
                        <option value="">16:00-17:00</option>
                        <option value="">17:00-18:00</option>
                        <option value="">18:00-19:00</option>
                        <option value="">19:00-20:00</option>
                        <option value="">20:00-21:00</option>
                        <option value="">21:00-22:00</option>
                        <option value="">22:00-23:00</option>
                        <option value="">23:00-0000</option>
                    </select>
                </div>
                <!-- <label for="hora_reservada">Hora Reservada</label>
                <input type="text" name="hora_reservada" id="hora_reservada" required>
                <br> -->
                <label for="asunto">Asunto</label>
                <input type="text" name="asunto" id="asunto" required>
                <br>
                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado" required>
                <br>
                <label for="id_administrador">ID Administrador</label>
                <input type="text" name="id_administrador" id="id_administrador" required>
                <br>
                <label for="id_veterinario">ID Veterinario</label>
                <input type="text" name="id_veterinario" id="id_veterinario" required>
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="card-footer text-muted">
            <!-- <h5 class="card-title">Crear Reserva</h5>
            <p class="card-text">Formulario para crear una reserva.</p> -->
            <a href="index.php" class="btn btn-primary">Regresar</a>
        </div>
    </div>



</body>
</html>
<?php include("../../plantillas/footer.php")?>