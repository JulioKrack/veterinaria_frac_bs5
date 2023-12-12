<?php
include("../../config/bd.php");

// Función para obtener todas las reservas de citas desde la base de datos
function getReservaciones($conn) {
    
    $sql = "SELECT rc.id as id, rc.fechareserva as fecha, rc.asunto as asunto,
    (SELECT nombre FROM cliente WHERE id = rc.id_cliente) as clientes,
    (SELECT nombre FROM veterinario WHERE id = rc.id_veterinario) as veterinario,
    (CASE WHEN rc.estado = 1 THEN 'Disponible' WHEN rc.estado= 2 THEN 'Reservado' WHEN rc.estado=3 THEN 'Atendido' ELSE 'Cancelado' END) as estado1,
    (SELECT m.nombre FROM mascota m 
     JOIN cliente c ON m.id_cliente = c.id
     WHERE c.id = rc.id_cliente) as nombre_mascota,
    (SELECT m.tipo FROM mascota m 
     JOIN cliente c ON m.id_cliente = c.id
     WHERE c.id = rc.id_cliente) as tipo_mascota
    FROM reservadecitas rc ";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function eliminarReserva($conn, $id) {
    $sql = "DELETE FROM reservadecitas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location:./index.php");
        return true;

    } else {
        return false;
    }
}

// Obtener todas las reservas existentes
$reservations = getReservaciones($conn);

// Obtener el ID de la reserva desde el formulario
if (isset($_GET['idr'])) {
    $id = $_GET['idr'];
    eliminarReserva($conn, $id);
}


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
            <table class="table table-bordered" id="tabla_id">
            <tr>
                <th hidden>ID Reserva</th>
                <th>Fecha Reservada</th>
                <th>Descripcion</th>
                <th>Cliente</th>
                <th>Nombre Mascota</th>
                <th>Tipo Mascota</th>
                <th>Veterinario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td hidden><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['fecha']; ?></td>
                    <td><?php echo $reservation['asunto']; ?></td>
                    <td ><?php echo $reservation['clientes']; ?></td>
                    <td><?php echo $reservation['nombre_mascota']; ?></td>
                    <td><?php echo $reservation['tipo_mascota']; ?></td>
                    <td><?php echo $reservation['veterinario']; ?></td>
                    <td><?php echo $reservation['estado1']; ?></td>
                    <td>
                        <form method="post" action="index.php">
                            <input type="hidden" name="idr" value="<?php echo $reservation['id']; ?>">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <a href="./editar.php?id=<?php echo $reservation['id']; ?>" class="btn btn-warning">Editar</a>
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