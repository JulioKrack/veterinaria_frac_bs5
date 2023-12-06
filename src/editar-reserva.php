
<?php
include("./config/bd.php");

if(isset($_GET['id'])){
    $id_reserva = $_GET['id'];
    $sql = "SELECT * FROM reservadecitas WHERE id = '$id_reserva'";
    $result = $conn->query($sql);
    $registro = $result->fetch_assoc();
    $id = $registro['id'];
    $fecha_reservada = $registro['fechareserva'];
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
    $asunto = $_POST['asunto'];
    $estado = 2;
    $id_administrador = $_POST['id_administrador'];
    $id_veterinario = $_POST['id_veterinario'];
    $id_cliente = $_POST['id_cliente']; 

    $sql = "UPDATE reservadecitas SET 
    asunto = '$asunto', estado = '$estado',
    id_cliente = '$id_cliente' WHERE id = '$id'; "  ;

    if ($conn->query($sql) === TRUE) {
        echo "modificado successfully";
        header("Location:./bienvenido.php");
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
    <link rel="stylesheet" href="css/bienvenido.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />  
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="card">
        <div class="card-header">
            <p class="card-text">Formulario para crear una reserva.</p>
        </div>
        <div class="card-body">
    <!-- Formulario para insertar datos -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div hidden class="mb-3">
                  <label for="id" class="form-label">ID:</label>
                  <input type="text" value="<?php echo $id; ?>"
                    class="form-control" readonly name="id" id="id" aria-describedby="helpId" placeholder="">
                </div>
                <div disable class="mb-3">
                  <label for="fechareserva" class="form-label">Fecha:</label>
                  <input disabled type="datetime" value="<?php echo $fecha_reservada; ?>"
                    class="form-control" name="fechareserva" id="fechareserva" aria-describedby="helpId" placeholder="">
                </div>

                <div  class="mb-3">
                  <label for="asunto" class="form-label">Asunto:</label>
                  <input type="text" value="<?php echo $asunto; ?>"
                    class="form-control" name="asunto" id="asunto" aria-describedby="helpId" placeholder="">
                </div>
                <div hidden class="mb-3">
                  <label for="estado" class="form-label">Estado:</label>
                  <input type="text" value="<?php echo $estado; ?>"
                    class="form-control" name="estado" id="estado" aria-describedby="helpId" placeholder="">
                </div>
                <div class="mb-3">
                  <label for="id_cliente" class="form-label">ID Cliente:</label>
                  <input type="text"  value="<?php echo $id_cliente; ?>"
                    class="form-control" name="id_cliente" id="id_cliente" aria-describedby="helpId" placeholder="">
                </div>

                <div hidden class="mb-3">
                  <label for="id_administrador" class="form-label">ID Administrador:</label>
                  <input type="text" readonly value="<?php echo $id_administrador; ?>"
                    class="form-control" name="id_administrador" id="id_administrador" aria-describedby="helpId" placeholder="">
                </div>
                <div  hidden class="mb-3">
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>