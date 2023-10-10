<?php
include("../../config/bd.php");

// Función para obtener todas las reservas de citas desde la base de datos
function getAllReservations($conn) {
    $sql = "SELECT id,fechareserva,hora,asunto,id_cliente FROM reservadecitas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Obtener todas las reservas existentes
$reservations = getAllReservations($conn);

// Cerrar la conexión después de obtener los datos
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
                <th>ID Reserva</th>
                <th>Fecha Reservada</th>
                <th>Hora Reservada</th>
                <th>Asunto</th>
                <th>ID Cliente</th>
                <th>Acciones</th>

            </tr>

            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['fechareserva']; ?></td>
                    <td><?php echo $reservation['hora']; ?></td>
                    <td><?php echo $reservation['asunto']; ?></td>
                    <td><?php echo $reservation['id_cliente']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Editar</a>
                        <a href="eliminar.php?id=<?php echo $reservation['id']; ?>" class="btn btn-danger">Eliminar</a>
                    </tr>
            <?php endforeach; ?>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">
    <a href="crear.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Crear cita</a>
    </div>
</div>

<?php include("../../plantillas/footer.php")?>