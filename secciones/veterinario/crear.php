<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el id de la persona
    $id_persona = $_POST["id_persona"];

    $sql = "INSERT INTO veterinario (id, id_persona)
    VALUES (null, '$id_persona')";
    if ($conn->query($sql) === TRUE) {
        echo "Reservation created successfully";
        header("Location:./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
}
function obtenerID($conn) {
    $sql = "SELECT id FROM persona";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Obtener todas las reservas existentes
$per = obtenerID($conn);


// Cerrar la conexión después de obtener los datos
$conn->close();

?>

    <div class="card">
        <div class="card-header">
            <p class="card-text">Formulario para crear clientes</p>
        </div>
        <div class="card-body">
    <!-- Formulario para insertar datos -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                    <label for="id_persona" class="form-label">ID Persona:</label>
                    <select class="form-select form-select-lg" name="id_persona" id="id_persona">
                        <?php foreach ($per as $perso) {?>
                        <option value="<?php echo $perso['id']?>"><?php echo $perso['id']?></option>
                        <?php } ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Crear"></input>
            
                <a href="index.php" class="btn btn-secondary">Regresar</a>
            </form>    
        </div>
        <div class="card-footer text-muted">
            <!-- <h5 class="card-title">Crear Reserva</h5>
            <p class="card-text">Formulario para crear una reserva.</p> -->

        </div>
    </div>

<?php include("../../plantillas/footer.php")?>