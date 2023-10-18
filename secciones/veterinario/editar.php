<?php include("../../plantillas/header.php")?>
<?php
include("../../config/bd.php");

if(isset($_GET['id'])){
    $id_veterinario= $_GET['id'];
    $sql = "SELECT * FROM persona WHERE id = (SELECT id_persona FROM veterinario where id = '$id_veterinario')";
    $result = $conn->query($sql);
    $registro = $result->fetch_assoc();
    $id = $registro['id'];
    $nombre = $registro['nombre'];
    $dni = $registro['dni'];
    $correo = $registro['correo'];
    $usuario = $registro['usuario'];
    $contrasenia = $registro['contrasenia'];
    $telefono = $registro['telefono'];
    $rol = $registro['rol'];
    $estado = $registro['estado'];
}
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id= $_POST['id'];
    $nombre = $_POST["nombre"];
    $dni = $_POST["dni"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    $telefono = $_POST["telefono"];
    $rol = 'Veterinario';
    $estado = $_POST["estado"];

    $sql = "UPDATE persona SET nombre = '$nombre', dni = '$dni', correo = '$correo', usuario = '$usuario', contrasenia = '$contrasenia', telefono = '$telefono', rol = '$rol', estado = '$estado' WHERE id = '$id';";
    
    if ($conn->query($sql) === TRUE) {
        header("Location:./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
    <div class="card">
        <div class="card-header">
            <p class="card-text">Formulario para editar un usuario.</p>
        </div>
        <div class="card-body">
    <!-- Formulario para insertar datos -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                  <label for="id" class="form-label">ID:</label>
                  <input type="text" readonly value="<?php echo $id; ?>"
                    class="form-control" readonly name="id" id="id" aria-describedby="helpId">
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre Completo:</label>
                  <input type="text"  value="<?php echo $nombre; ?>"
                    class="form-control" name="nombre" id="nombre" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="dni" class="form-label">DNI:</label>
                  <input type="text" value="<?php echo $dni; ?>"
                    class="form-control" name="dni" id="dni" aria-describedby="helpId" >
                </div>  
                <div class="mb-3">
                  <label for="correo" class="form-label">Correo:</label>
                  <input type="text" value="<?php echo $correo; ?>"
                    class="form-control" name="correo" id="correo" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="usuario" class="form-label">Usuario:</label>
                  <input type="text" value="<?php echo $usuario; ?>"
                    class="form-control" name="usuario" id="usuario" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="contrasenia" class="form-label">Contraseña:</label>
                  <input type="text" value="<?php echo $contrasenia; ?>"
                    class="form-control" name="contrasenia" id="contrasenia" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="telefono" class="form-label">Teléfono:</label>
                  <input type="text" value="<?php echo $telefono; ?>"
                    class="form-control" name="telefono" id="telefono" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol:</label>
                    <select class="form-select form-select-lg" disabled name="rol" id="rol">
                        
                        <option  value="Cliente">Cliente</option>
                        <option  value="Administrador">Administrador</option>
                        <option selected value="veterinario">Veterinario</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select class="form-select form-select-lg" name="estado" id="estado">
                        <option selected value="1">Disponible</option>
                        <option value="2">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="index.php" class="btn btn-secondary">Regresar</a>
            </form>      
        </div>
        <div class="card-footer text-muted"></div>
    </div>

<?php include("../../plantillas/footer.php")?>