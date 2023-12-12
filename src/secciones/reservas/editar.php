<?php
include("../../plantillas/header.php");
include("../../config/bd.php");

// Verificar si se recibe un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_reserva = $_GET['id'];

    // Obtener la información de la reserva existente
    $sqlReserva = "SELECT * FROM reservadecitas WHERE id = $id_reserva";
    $resultReserva = $conn->query($sqlReserva);

    if ($resultReserva->num_rows > 0) {
        $reserva = $resultReserva->fetch_assoc();

        // Verificar si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];
            $id_veterinario = $_POST["id_veterinario"];
            $estado = $_POST["estado"];

            // Actualizar la reserva en la base de datos
            $sqlUpdate = "UPDATE reservadecitas 
                          SET fechareserva = '$fecha', hora = '$hora', id_veterinario = '$id_veterinario', estado = '$estado' 
                          WHERE id = $id_reserva";

            if ($conn->query($sqlUpdate) === TRUE) {
                header("Location:./index.php");
            } else {
                echo "Error al actualizar la cita: " . $sqlUpdate . "<br>" . $conn->error;
            }
        }

        // Obtener la lista de veterinarios para llenar el campo del formulario
        $sqlVeterinarios = "SELECT id, nombre FROM veterinario";
        $resultVeterinarios = $conn->query($sqlVeterinarios);
        $veterinarios = $resultVeterinarios->fetch_all(MYSQLI_ASSOC);

        // Cerrar la conexión después de obtener los datos
        $conn->close();
?>

<div class="card">
    <div class="card-header">
        <p class="card-text">Formulario para actualizar una cita</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <!-- Formulario para actualizar datos -->
                <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . $id_reserva; ?>" method="post">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha de la cita:</label>
                        <input type="date" class="form-control" name="fecha" value="<?php echo $reserva['fechareserva']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora de la cita:</label>
                        <input type="time" class="form-control" name="hora" value="<?php echo $reserva['hora']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_veterinario" class="form-label">Veterinario:</label>
                        <select class="form-select" name="id_veterinario" required>
                            <?php foreach ($veterinarios as $veterinario) : ?>
                                <option value="<?php echo $veterinario['id']; ?>" <?php echo ($reserva['id_veterinario'] == $veterinario['id']) ? 'selected' : ''; ?>><?php echo $veterinario['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado:</label>
                        <select class="form-select" name="estado" required>
                            <option value="1" <?php echo ($reserva['estado'] == 1) ? 'selected' : ''; ?>>Disponible</option>
                            <option value="2" <?php echo ($reserva['estado'] == 2) ? 'selected' : ''; ?>>Reservado</option>
                            <option value="3" <?php echo ($reserva['estado'] == 3) ? 'selected' : ''; ?>>Atendido</option>
                            <option value="4" <?php echo ($reserva['estado'] == 4) ? 'selected' : ''; ?>>Cancelado</option>
                            <!-- Agrega otras opciones según tus necesidades -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Cita</button>
                    <a href="index.php" class="btn btn-secondary">Regresar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    } else {
        echo "No se encontró la reserva con ID: $id_reserva";
    }
} else {
    echo "ID de reserva no válido";
}
include("../../plantillas/footer.php");
?>
