<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    $id_cliente = null;
    $fecha_reservada = $_POST['fechareserva'];
    $hora = $_POST['hora'];
    $asunto = $_POST['asunto'];
    $estado = $_POST['estado'];
    $id_administrador = $_POST['administrador'];
    $id_veterinario = $_POST['veterinario'];
    $id_cliente = $_POST['cliente']; 


    // Insertar datos en la base de datos
    $sql = "INSERT INTO reservadecitas (id, fechareserva, hora, asunto, estado, id_administrador, id_veterinario, id_cliente )
            VALUES (NULL,'$fecha_reservada','$hora' ,'$asunto', '$estado', (SELECT id FROM administrador WHERE id_persona = (SELECT id FROM persona WHERE nombre = '$id_administrador')), (SELECT id FROM veterinario WHERE id_persona = (SELECT id FROM persona WHERE nombre = '$id_veterinario')), (SELECT id FROM cliente WHERE id_persona = (SELECT id FROM persona WHERE nombre = '$id_cliente')) )";
    // (SELECT id FROM cliente WHERE id_persona = (SELECT id FROM persona WHERE nombre = '$id_cliente'))";
    if ($conn->query($sql) === TRUE) {
        echo "Reservation created successfully";
        header("Location:./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}
function obtenerCliente($conn) {
    $sql = "SELECT id,(SELECT nombre FROM persona WHERE id=id_persona) as nombre FROM cliente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
function obtenerAdministrador($conn) {
    $sql = "SELECT id,(SELECT nombre FROM persona WHERE id=id_persona) as nombre FROM administrador";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
function obtenerVeterinario($conn) {
    $sql = "SELECT id,(SELECT nombre FROM persona WHERE id=id_persona) as nombre FROM veterinario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Obtener todas las reservas existentes
$cli = obtenerCliente($conn);
$adm = obtenerAdministrador($conn);
$vet = obtenerVeterinario($conn);

// Cerrar la conexión después de obtener los datos
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
                  <label for="fechareserva" class="form-label">Fecha:</label>
                  <input type="date"
                    class="form-control" name="fechareserva" id="fechareserva" aria-describedby="helpId" value="2023-10-01" min="2023-10-01" max="2023-12-31" >
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <select class="form-select form-select-lg" name="hora" id="hora">
                        <option selected value="0:00">0:00</option>
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
                  <input type="text"
                    class="form-control" name="asunto" id="asunto" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="estado" class="form-label">Estado:</label>
                  <input type="text" readonly
                    class="form-control" name="estado" id="estado" value="1" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="cliente" class="form-label">Cliente:</label>
                    <select class="form-select form-select-lg" name="cliente" id="cliente">
                        <option  selected value=" "></option>
                        <?php foreach ($cli as $clie) {?>
                        <option value="<?php echo $clie['nombre']?>"><?php echo $clie['nombre']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="administrador" class="form-label">Administrador:</label>
                    <select class="form-select form-select-lg" name="administrador" id="administrador">
                        <?php foreach ($adm as $admi) {?>
                        <option value="<?php echo $admi['nombre']?>"><?php echo $admi['nombre']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="veterinario" class="form-label">Veterinario:</label>
                    <select class="form-select form-select-lg" name="veterinario" id="veterinario">
                        <?php foreach ($vet as $vete) {?>
                        <option value="<?php echo $vete['nombre']?>"><?php echo $vete['nombre']?></option>
                        <?php } ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Crear"></input>
                <a href="index.php" class="btn btn-secondary">Regresar</a>
            </form>
           
        </div>
        <div class="card-footer text-muted">

        </div>
    </div>

<?php include("../../plantillas/footer.php")?>