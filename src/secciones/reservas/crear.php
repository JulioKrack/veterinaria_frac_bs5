<?php
include("../../plantillas/header.php");
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $asunto = null;
    $id_cliente = null;
    $id_veterinario = $_POST["id_veterinario"];
    $id_administrador = 1;
    $estado=1;

    // Puedes agregar más validaciones según tus necesidades

    // Insertar la nueva cita en la base de datos
    $sql = "INSERT INTO reservadecitas (id_administrador, id_veterinario, fechareserva, hora, asunto, estado) 
    VALUES ('$id_administrador','$id_veterinario','$fecha','$hora','$asunto','$estado')";


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
        <div class="row">
            <div class="col-md-4">
        <!-- Formulario para insertar datos -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha de la cita:</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                    <!--un combobox donde puedo elegir la hora desde 00:00 horas hasta las 23:00 -->
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora de la cita:</label>
                        <input type="time" class="form-control" name="hora" required>
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
    </div>
</div>

<?php include("../../plantillas/footer.php"); ?>
