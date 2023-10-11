<?php
include("../../config/bd.php");

function getDatosVeterinario($conn) {
    $sql = "SELECT v.id, v.id_persona, p.nombre, p.dni, p.correo, p.usuario, p.contrasenia, p.telefono, p.rol, p.estado 
    FROM veterinario v
    INNER JOIN persona p ON v.id_persona = p.id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

if (isset($_GET['id'])) {
    $id_veterinario = $_GET['id'];

    // Obtener el id_persona
    $id_persona_query = "SELECT id_persona FROM veterinario WHERE id = '$id_veterinario'";
    $result_persona = $conn->query($id_persona_query);

    if ($result_persona->num_rows > 0) {
        $row = $result_persona->fetch_assoc();
        $id_persona = $row['id_persona'];

        // Eliminar veterinario
        $sql = "DELETE FROM veterinario WHERE id = '$id_veterinario'";
        if ($conn->query($sql) === TRUE) {
            // Eliminar persona
            $sql2 = "DELETE FROM persona WHERE id = '$id_persona'";
            if ($conn->query($sql2) === TRUE) {
                header("Location: ./index.php");
                exit();
            } else {
                echo "Error al eliminar persona: " . $conn->error;
            }
        } else {
            echo "Error al eliminar cliente: " . $conn->error;
        }
    } else {
        echo "No se encontró el id_persona asociado al cliente.";
    }
}
$reservations = getDatosVeterinario($conn);

$conn->close();
?>

<?php include("../../plantillas/header.php")?>

<br />
<br />
<br />
<div class="card">
    <div class="card-header">
        Reserva de citas 
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered">
            <tr>
                <th>ID Veterinario</th>
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
    <a href="crear.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Crear Empleado</a>
    </div>
</div>

<?php include("../../plantillas/footer.php")?>