<?php
include("../../plantillas/header.php");
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["fecha"];
    $asunto = null;
    $id_cliente = null;
    $id_veterinario = $_POST["id_veterinario"];
    $id_administrador = 1;

    // Puedes agregar más validaciones según tus necesidades

    // Insertar la nueva cita en la base de datos
    $sql = "INSERT INTO reservadecitas (fechareserva, asunto, id_cliente, id_veterinario, estado)
            VALUES ('$fecha', '$asunto', $id_cliente, $id_veterinario, 1)";

    if ($conn->query($sql) === TRUE) {
        header("Location:./index.php");
    } else {
        echo "Error al crear la cita: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener la lista de clientes y veterinarios para llenar los campos del formulario
$sqlClientes = "SELECT id, nombre FROM cliente";
$resultClientes = $conn->query($sqlClientes);
$clientes = $resultClientes->fetch_all(MYSQLI_ASSOC);

$sqlVeterinarios = "SELECT id, nombre FROM veterinario";
$resultVeterinarios = $conn->query($sqlVeterinarios);
$veterinarios = $resultVeterinarios->fetch_all(MYSQLI_ASSOC);

// Cerrar la conexión después de obtener los datos
$conn->close();
?>

<div class="card">
    <div class="card-header">
        <p class="card-text">Formulario para crear una cita</p>
    </div>
    <div class="card-body">
        <!-- Formulario para insertar datos -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la cita:</label>
                <input type="datetime-local" class="form-control" name="fecha" required>
            </div>
            <!--un combobox donde puedo elegir la hora desde 00:00 horas hasta las 23:00 -->
            <div class="mb-3">
                <label for="hora" class="form-label">Hora de la cita:</label>
                <input type="time" class="form-control" name="hora" required>
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto:</label>
                <input type="text" class="form-control" name="asunto" required>
            </div>
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente:</label>
                <select class="form-select" name="id_cliente" required>
                    <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_veterinario" class="form-label">Veterinario:</label>
                <select class="form-select" name="id_veterinario" required>
                    <?php foreach ($veterinarios as $veterinario) : ?>
                        <option value="<?php echo $veterinario['id']; ?>"><?php echo $veterinario['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear Cita</button>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
</div>

<?php include("../../plantillas/footer.php"); ?>
