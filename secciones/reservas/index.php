<?php
include("../../config/bd.php");

// Función para obtener todas las reservas de citas desde la base de datos
function getAllReservations($conn) {
    $sql = "SELECT * FROM reserva_de_citas";
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

<div class="card">
    <div class="card-header">
        Reservas
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered">
            <tr>
                <th>ID Reserva</th>
                <th>ID Cliente</th>
                <th>Fecha Reservada</th>
            </tr>

            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td><?php echo $reservation['id_reserva']; ?></td>
                    <td><?php echo $reservation['id_cliente']; ?></td>
                    <td><?php echo $reservation['fecha_reservada']; ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>

<?php include("../../plantillas/footer.php")?>