<?php
include("../../config/bd.php");

// Función para obtener todas las reservas de citas desde la base de datos
function getReservaciones($conn) {
    $sql = "SELECT id,fechareserva,asunto,(SELECT nombre FROM persona WHERE id=(SELECT id_persona FROM cliente where id=id_cliente)) as clientes,(SELECT nombre FROM persona WHERE id=(SELECT id_persona FROM veterinario where id=id_veterinario)) as veterinario, (CASE WHEN estado = 1 THEN 'Disponible' ELSE 'Ocupado' END ) as estado1 FROM reservadecitas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

if(isset($_GET['id'])){
    $id_reserva = $_GET['id'];
    $sql = "DELETE FROM reservadecitas WHERE id = '$id_reserva'";
    if ($conn->query($sql) === TRUE) {
        header("Location:./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todas las reservas existentes
$reservations = getReservaciones($conn);

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
        <a href="./crear.php" class="btn btn-primary">Crear cita</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered">
            <tr>
                <th hidden>ID Reserva</th>
                <th>Fecha Reservada</th>
                <th>Asunto</th>
                <th>Cliente</th>
                <th>Veterinario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td hidden><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['fechareserva']; ?></td>
                    <td><?php echo $reservation['asunto']; ?></td>
                    <td><?php echo $reservation['clientes']; ?></td>
                    <td><?php echo $reservation['veterinario']; ?></td>
                    <td><?php echo $reservation['estado1']; ?></td>
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

    </div>
</div>

<?php include("../../plantillas/footer.php")?>