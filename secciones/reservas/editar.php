<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reserva = $_POST['id_reserva'];
    $id_cliente = $_POST['id_cliente'];
    $fecha_reservada = $_POST['fecha_reservada'];
    $hora_reservada = $_POST['hora_reservada'];
    $asunto = $_POST['asunto'];
    $estado = $_POST['estado'];
    $id_administrador = $_POST['id_administrador'];
    $id_veterinario = $_POST['id_veterinario'];

    // Validar datos (puedes agregar más validaciones según tus necesidades)
    $fecha_hora_reserva = $fecha_reservada . ' ' . $hora_reservada;

    // Insertar datos en la base de datos
    $sql = "UPDATE reserva_de_citas SET id_cliente = '$id_cliente', fecha_reservada = '$fecha_hora_reserva', asunto = '$asunto', estado = '$estado', id_administrador = '$id_administrador', id_veterinario = '$id_veterinario' WHERE id_reserva = '$id_reserva'; "  ;

    if ($conn->query($sql) === TRUE) {
        echo "modificado successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
    <div class="card">
        <div class="card-header">
            <p class="card-text">Formulario para crear una reserva.</p>
        </div>
        <div class="card-body">
    <!-- Formulario para insertar datos -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                  <label for="id" class="form-label">ID:</label>
                  <input type="text"
                    class="form-control" readonly name="id" id="id" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="fechareserva" class="form-label">Fecha:</label>
                  <input type="date"
                    class="form-control" name="fechareserva" id="fechareserva" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <select class="form-select form-select-lg" name="hora" id="hora">
                        <option selected>0:00</option>
                        <option value="">1:00</option>
                        <option value="">2:00</option>
                        <option value="">3:00</option>
                        <option value="">4:00</option>
                        <option value="">5:00</option>
                        <option value="">6:00</option>
                        <option value="">7:00</option>
                        <option value="">8:00</option>
                        <option value="">9:00</option>
                        <option value="">10:00</option>
                        <option value="">11:00</option>
                        <option value="">12:00</option>
                        <option value="">13:00</option>
                        <option value="">14:00</option>
                        <option value="">15:00</option>
                        <option value="">16:00</option>
                        <option value="">17:00</option>
                        <option value="">18:00</option>
                        <option value="">19:00</option>
                        <option value="">20:00</option>
                        <option value="">21:00</option>
                        <option value="">22:00</option>
                        <option value="">23:00</option>
                        <option value="">24:00</option>
                    </select>
                </div>
                <div class="mb-3">
                  <label for="asunto" class="form-label">Asunto:</label>
                  <input type="text"
                    class="form-control" name="asunto" id="asunto" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="estado" class="form-label">Estado:</label>
                  <input type="text"
                    class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="id_cliente" class="form-label">ID Cliente:</label>
                  <input type="text"
                    class="form-control" name="id_cliente" id="id_cliente" aria-describedby="helpId" placeholder="">
                </div>

                <div class="mb-3">
                  <label for="id_administrador" class="form-label">ID Administrador:</label>
                  <input type="text"
                    class="form-control" name="id_administrador" id="id_administrador" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="id_veterinario" class="form-label">ID Veterinario:</label>
                  <input type="text"
                    class="form-control" name="id_veterinario" id="id_veterinario" aria-describedby="helpId" placeholder="">
                </div>
            </form> 
        </div>
        <div class="card-footer text-muted">
            <!-- <h5 class="card-title">Crear Reserva</h5>
            <p class="card-text">Formulario para crear una reserva.</p> -->
            <a name="" id="" class="btn btn-primary" href="#" role="button"><button type="submit" class="btn btn-primary">Crear</button></a>
            
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
</head>
<body>


    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="id_reserva">ID Reserva</label>
        <input type="number" name="id_reserva" id="id_reserva" required>
        <br>
        <label for="id_cliente">ID Cliente</label>
        <input type="text" name="id_cliente" id="id_cliente" required>
        <br>
        <label for="fecha_reservada">Fecha Reservada</label>
        <input type="date" id="start" name="fecha_reservada" value="2023-01-01" min="2023-01-01" max="2023-12-31" />
        <br>
        <label for="fecha_reservada">Fecha Reservada</label>
        <input type="text" name="fecha_reservada" id="fecha_reservada" required>
        <br>
        <label for="hora_reservada">Hora Reservada</label>
        <input type="text" name="hora_reservada" id="hora_reservada" required>
        <br>
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

</body>
</html> -->
<?php include("../../plantillas/footer.php")?>