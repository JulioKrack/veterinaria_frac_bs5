<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = null;
    $fecha_reservada = $_POST['fechareserva'];
    $hora = $_POST['hora'];
    $asunto = $_POST['asunto'];
    $estado = $_POST['estado'];
    $id_administrador = $_POST['id_administrador'];
    $id_veterinario = $_POST['id_veterinario'];
    $id_cliente = $_POST['id_cliente']; 

    // Validar datos (puedes agregar más validaciones según tus necesidades)
    // $fecha_hora_reserva = $fecha_reservada . ' ' . $hora;

    // Insertar datos en la base de datos
    $sql = "INSERT INTO reservadecitas (id, fechareserva, hora, asunto, estado, id_administrador, id_veterinario, id_cliente )
            VALUES (NULL,'$fecha_reservada','$hora' ,'$asunto', '$estado', '$id_administrador', '$id_veterinario','$id_cliente')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    function obtenerDatos($conn) {
        $sql = "SELECT id,fechareserva,hora,asunto,id_cliente FROM reservadecitas";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    
}
function obtenerCliente($conn) {
    $sql = "SELECT id FROM cliente";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
function obtenerAdministrador($conn) {
    $sql = "SELECT id FROM administrador";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
function obtenerVeterinario($conn) {
    $sql = "SELECT id FROM veterinario";
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
                  <input type="text"
                    class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="id_cliente" class="form-label">ID Cliente:</label>
                    <select class="form-select form-select-lg" name="id_cliente" id="id_cliente">
                        <?php foreach ($cli as $clie) {?>
                        <option value="<?php echo $clie['id']?>"><?php echo $clie['id']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_administrador" class="form-label">ID Administrador:</label>
                    <select class="form-select form-select-lg" name="id_administrador" id="id_administrador">
                        <?php foreach ($adm as $admi) {?>
                        <option value="<?php echo $admi['id']?>"><?php echo $admi['id']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_veterinario" class="form-label">ID Veterinario:</label>
                    <select class="form-select form-select-lg" name="id_veterinario" id="id_veterinario">
                        <?php foreach ($vet as $vete) {?>
                        <option value="<?php echo $vete['id']?>"><?php echo $vete['id']?></option>
                        <?php } ?>
                    </select>
                </div>
        </div>
        <div class="card-footer text-muted">
            <!-- <h5 class="card-title">Crear Reserva</h5>
            <p class="card-text">Formulario para crear una reserva.</p> -->
            <input type="submit" class="btn btn-primary">Crear</input>
            
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

<?php include("../../plantillas/footer.php")?>