<?php
include("../../config/bd.php");


// Función para obtener todas las reservas de citas desde la base de datos
function getDatosCliente($conn) {
    $sql = "SELECT c.id, c.id_persona, p.nombre, p.dni, p.correo, p.usuario, p.contrasenia, p.telefono, p.rol, p.estado 
    FROM cliente c
    INNER JOIN persona p ON c.id_persona = p.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

if(isset($_GET['id'])){
    $id_cliente= $_GET['id'];
    $sql = "DELETE FROM cliente WHERE id = '$id_cliente'";
    if ($conn->query($sql) === TRUE) {
        echo "Cliente deleted successfully";
        header("Location:./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todas las reservas existentes
$reservations = getDatosCliente($conn);

// Cerrar la conexión después de obtener los datos
$conn->close();
?>
<?php include("../../plantillas/header.php")?>

<br />
<br />
<br />
<div class="card">
    <div class="card-header">
        Personas
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered">
            <tr>    
                <th>ID Cliente</th>
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
                    <td><?php echo $reservation['id_persona']; ?></td>
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
                    </tr>
            <?php endforeach; ?>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">
    <a href="crear.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Crear Persona</a>
    </div>
</div>

<?php include("../../plantillas/footer.php")?>