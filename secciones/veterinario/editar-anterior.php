<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

if(isset($_GET['id'])){
    $id_veterinario= $_GET['id'];
    $sql = "SELECT * FROM veterinario WHERE id = '$id_veterinario'";
    $result = $conn->query($sql);
    $registro = $result->fetch_assoc();
    $id = $registro['id'];
    $id_persona = $registro['id_persona'];  

}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id= $_POST['id'];
    $id_persona = $_POST["id_persona"];


    $sql = "UPDATE veterinario SET id_persona = '$id_persona' WHERE id = '$id'";

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
                  <input type="text" readonly
                    class="form-control" name="id" id="id" aria-describedby="helpId" value="<?php echo $id; ?>" disabled>
                </div>
                <div class="mb-3">
                  <label for="id_persona" class="form-label">ID Persona:</label>
                  <input type="text"
                    class="form-control" name="id_persona" id="id_persona" aria-describedby="helpId" value="<?php echo $id_persona; ?>">
                </div>


                <button type="submit" class="btn btn-primary">Actualizar</button>                
                <a href="index.php" class="btn btn-secondary">Regresar</a>
            </form> 
        </div>
        <div class="card-footer text-muted">


        </div>
    </div>


<?php include("../../plantillas/footer.php")?>