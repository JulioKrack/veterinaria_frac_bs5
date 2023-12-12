<?php
include("../../config/bd.php");

if(isset($_GET['id']) && isset($_GET['tabla'])){
    $id_persona = $_GET['id'];
    $tabla = $_GET['tabla'];

    // Ajusta la consulta según la tabla
    $sql = "SELECT * FROM $tabla WHERE id = '$id_persona'";
    $result = $conn->query($sql);

    if ($result) {
        $registro = $result->fetch_assoc();

        // Aquí obtienes los datos específicos de la tabla
        $id = $registro['id'];
        $nombre = $registro['nombre'];
        $dni = $registro['dni'];
        $correo = $registro['correo'];
        $usuario = $registro['usuario'];
        $contrasenia = $registro['contrasenia'];
        $estado = $registro['estado'];
        // ... (continúa con los demás campos según tu estructura de tabla)
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Resto del código para actualizar la base de datos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoge los datos del formulario
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $dni = $_POST['dni'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $estado = $_POST['estado'];

        // Actualiza los datos en la base de datos
        $sql = "UPDATE $tabla SET nombre = '$nombre', dni = '$dni', correo = '$correo', usuario = '$usuario', contrasenia = '$contrasenia', estado = '$estado' WHERE id = '$id'";
        
        if ($conn->query($sql) === TRUE) {
            // Redirige a la página de índice después de la actualización
            header("Location:./index.php");
        } else {
            echo "Error al actualizar: " . $sql . "<br>" . $conn->error;
        }
    }

} else {
    echo "Error: No se proporcionó el nombre de la tabla.";
}

$conn->close();
?>


<?php include("../../plantillas/header.php")?>

<div class="card">
    <div class="card-header">
        <p class="card-text">Formulario para editar un usuario.</p>
    </div>
    <div class="card-body">
        <!-- Formulario para editar datos -->
        <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=$id_persona&tabla=$tabla"; ?>" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text" readonly value="<?php echo $id; ?>"
                       class="form-control" readonly name="id" id="id" aria-describedby="helpId">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre Completo:</label>
                <input type="text" value="<?php echo $nombre; ?>"
                       class="form-control" name="nombre" id="nombre" aria-describedby="helpId" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" value="<?php echo $dni; ?>"
                       class="form-control" name="dni" id="dni" aria-describedby="helpId" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text" value="<?php echo $correo; ?>"
                       class="form-control" name="correo" id="correo" aria-describedby="helpId" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" value="<?php echo $usuario; ?>"
                       class="form-control" name="usuario" id="usuario" aria-describedby="helpId" required>
            </div>
            <div class="mb-3">
                <label for="contrasenia" class="form-label">Contraseña:</label>
                <input type="text" value="<?php echo $contrasenia; ?>"
                       class="form-control" name="contrasenia" id="contrasenia" aria-describedby="helpId" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../plantillas/footer.php")?>
