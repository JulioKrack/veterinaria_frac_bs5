<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    $telefono = $_POST["telefono"];
    $rol = $_POST["rol"];
    $estado = $_POST["estado"];

    $sql = "INSERT INTO persona (id, nombre, dni, correo, usuario, contrasenia, telefono, rol, estado )
    VALUES (null, '$nombre', '$dni', '$correo', '$usuario', '$contrasenia', '$telefono', '$rol', '$estado')";
    if ($conn->query($sql) === TRUE) {
        header("Location:./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }  
}
// Cerrar la conexión después de obtener los datos
$conn->close();

?>

    <div class="card">
        <div class="card-header">
            <p class="card-text">Formulario para crear un usuario</p>
        </div>
        <div class="card-body">
    <!-- Formulario para insertar datos -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre Completo:</label>
                  <input type="text"
                    class="form-control" name="nombre" id="nombre" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="dni" class="form-label">DNI:</label>
                  <input type="text"
                    class="form-control" name="dni" id="dni" aria-describedby="helpId" >
                </div>  
                <div class="mb-3">
                  <label for="correo" class="form-label">Correo:</label>
                  <input type="text"
                    class="form-control" name="correo" id="correo" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="usuario" class="form-label">Usuario:</label>
                  <input type="text"
                    class="form-control" name="usuario" id="usuario" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="contrasenia" class="form-label">Contraseña:</label>
                  <input type="text"
                    class="form-control" name="contrasenia" id="contrasenia" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="telefono" class="form-label">Teléfono:</label>
                  <input type="text"
                    class="form-control" name="telefono" id="telefono" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol:</label>
                    <select class="form-select form-select-lg" name="rol" id="rol">
                        <option selected value="cliente">Cliente</option>
                        <option value="administrador">Administrador</option>
                        <option value="veterinario">Veterinario</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select class="form-select form-select-lg" name="estado" id="estado">
                        <option selected value="1">Disponible</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
                <div class="card-footer text-muted">
                    <input type="submit" class="btn btn-primary" value="Crear"></input>      
                    <a href="index.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>

    </div>

<?php include("../../plantillas/footer.php")?>