<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

if(isset($_GET['id'])){
    $id_reserva = $_GET['id'];
    $sql = "SELECT * FROM reservadecitas WHERE id = '$id_reserva'";
    $result = $conn->query($sql);
    $registro = $result->fetch_assoc();
    $id = $registro['id'];
    $fecha_reservada = $registro['fechareserva'];
    $hora = $registro['hora'];
    $asunto = $registro['asunto'];
    $estado = $registro['estado'];
    $id_administrador = $registro['id_administrador'];
    $id_veterinario = $registro['id_veterinario'];
    $id_cliente = $registro['id_cliente'];

}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id= $_POST['id'];
    $fecha_reservada = $_POST['fechareserva'];
    $hora = $_POST['hora'];
    $asunto = $_POST['asunto'];
    $estado = $_POST['estado'];
    $id_administrador = $_POST['id_administrador'];
    $id_veterinario = $_POST['id_veterinario'];
    $id_cliente = $_POST['id_cliente']; 

    $sql = "UPDATE reservadecitas SET fechareserva = '$fecha_reservada', hora = '$hora',
    asunto = '$asunto', estado = '$estado',
    id_veterinario = '$id_veterinario' WHERE id = '$id'; "  ;

    if ($conn->query($sql) === TRUE) {
        echo "modificado successfully";
        header("Location:./index.php");
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
                  <input type="text" value="<?php echo $id; ?>"
                    class="form-control" readonly name="id" id="id" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="fechareserva" class="form-label">Fecha:</label>
                  <input type="date" value="<?php echo $fecha_reservada; ?>"
                    class="form-control" name="fechareserva" id="fechareserva" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <select class="form-select form-select-lg" name="hora" id="hora">
                        <option selected value="<?php echo $hora; ?>"><?php echo $hora; ?></option>
                        <option value="0:00">0:00</option>
                        <option value="1:00">1:00</option>
                        <option value="2:00">2:00</option>
                        <option value="3:00">3:00</option>
                        <option value="4:00">4:00</option>
                        <option value="5:00">5:00</option>
                        <option value="6:00">6:00</option>
                        <option value="7:00">7:00</option>
                        <option value="8:00">8:00</option>
                        <option value="9:00">9:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="12:00">12:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                        <option value="17:00">17:00</option>
                        <option value="18:00">18:00</option>
                        <option value="19:00">19:00</option>
                        <option value="20:00">20:00</option>
                        <option value="21:00">21:00</option>
                        <option value="22:00">22:00</option>
                        <option value="23:00">23:00</option>
                    </select>
                </div>
                <div class="mb-3">
                  <label for="asunto" class="form-label">Asunto:</label>
                  <input type="text" value="<?php echo $asunto; ?>"
                    class="form-control" name="asunto" id="asunto" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="estado" class="form-label">Estado:</label>
                  <input type="text" value="<?php echo $estado; ?>"
                    class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="id_cliente" class="form-label">ID Cliente:</label>
                  <input type="text" readonly value="<?php echo $id_cliente; ?>"
                    class="form-control" name="id_cliente" id="id_cliente" aria-describedby="helpId" placeholder="">
                </div>

                <div class="mb-3">
                  <label for="id_administrador" class="form-label">ID Administrador:</label>
                  <input type="text" readonly value="<?php echo $id_administrador; ?>"
                    class="form-control" name="id_administrador" id="id_administrador" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="id_veterinario" class="form-label">ID Veterinario:</label>
                  <input id="name" type="text" value="<?php echo $id_veterinario; ?>"
                    class="form-control" name="id_veterinario" id="id_veterinario" aria-describedby="helpId" placeholder="">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>                
                <a href="index.php" class="btn btn-secondary">Regresar</a>
            </form> 
        </div>
        <div class="card-footer text-muted">


        </div>
    </div>


<?php include("../../plantillas/footer.php")?>