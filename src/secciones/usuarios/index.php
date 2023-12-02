<?php
include("../../config/bd.php");


// Función para obtener todas las reservas de citas desde la base de datos
function getDatosPersona($conn) {
    $sql = "SELECT id, nombre, dni, correo, usuario, contrasenia, telefono, rol, estado 
    FROM persona;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

if(isset($_GET['id'])){
    $id_persona= $_GET['id'];
    $sql = "DELETE FROM persona WHERE id = '$id_persona'";
    if ($conn->query($sql) === TRUE) {
        header("Location:./index.php");
    } else {
        echo "Error: Este usuario esta asignado con otras tablas " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todas las reservas existentes
$reservations = getDatosPersona($conn);

// Cerrar la conexión después de obtener los datos
$conn->close();
?>
<?php include("../../plantillas/header.php")?>

<br />
<br />
<br />
<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered" id="tabla_id">
            <tr>
                <th>ID Persona</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>

            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['nombre']; ?></td>
                    <td><?php echo $reservation['dni']; ?></td>
                    <td><?php echo $reservation['correo']; ?></td>
                    <td><?php echo $reservation['usuario']; ?></td>
                    <td><?php echo $reservation['contrasenia']; ?></td>
                    <td><?php echo $reservation['telefono']; ?></td>
                    <td><?php echo $reservation['rol']; ?></td>
                    <td><?php echo $reservation['estado']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Editar</a>
                        <a href="index.php?id=<?php echo $reservation['id']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                    </tr>
            <?php endforeach; ?>
            </table>
        </div>  
    </div>
    <div class="card-footer text-muted">
    <a hidden href="crear.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Crear Persona</a>
    </div>
</div>

<?php include("../../plantillas/footer.php")?>