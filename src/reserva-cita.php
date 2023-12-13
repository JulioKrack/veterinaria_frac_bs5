<?php
include("./config/bd.php");
session_start();

$idUsuario = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$_SESSION['idUsuario'] = $idUsuario;

// Función para obtener todas las reservas de citas desde la base de datos
function getReservaciones($conn) {
    $sql = "SELECT rc.id, rc.fechareserva,rc.hora, rc.asunto,
    (SELECT nombre FROM cliente WHERE id = rc.id_cliente) as clientes,
    (SELECT nombre FROM veterinario WHERE id = rc.id_veterinario) as veterinario,
    (CASE WHEN rc.estado = 1 THEN 'Disponible' WHEN rc.estado = 2 THEN 'Reservado' WHEN rc.estado = 3 THEN 'Atendido' ELSE 'Cancelado' END) as estado1,
    (SELECT m.nombre FROM mascota m 
     JOIN cliente c ON m.id_cliente = c.id
     WHERE c.id = rc.id_cliente) as nombre_mascota,
    (SELECT m.tipo FROM mascota m 
     JOIN cliente c ON m.id_cliente = c.id
     WHERE c.id = rc.id_cliente) as tipo_mascota
    FROM reservadecitas rc where estado=1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

$idUsuario = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$_SESSION['idUsuario'] = $idUsuario;

// Obtener todas las reservas existentes
$reservations = getReservaciones($conn);

// Cerrar la conexión después de obtener los datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bienvenido.css">
    <title>Citas Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> 
</head>

<body>
    <div class="card">
        <div class="card-header">
            Citas disponibles
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered" id="tabla_id">
                    <tr>
                        <th hidden>ID Reserva</th>
                        <th>Fecha Reservada</th>
                        <th>Hora</th>
                        <th>Cliente</th>
                        <th>Nombre Mascota</th>
                        <th>Tipo Mascota</th>
                        <th>Veterinario</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                        <th hidden>Acciones</th>
                    </tr>
                    <tbody>
                        <?php foreach ($reservations as $reservation) : ?>
                            <tr>
                                <td hidden><?php echo $reservation['id']; ?></td>
                                <td><?php echo $reservation['fechareserva']; ?></td>
                                <td><?php echo $reservation['hora']; ?></td>
                                <td><?php echo $reservation['clientes']; ?></td>
                                <td><?php echo $reservation['nombre_mascota']; ?></td>
                                <td><?php echo $reservation['tipo_mascota']; ?></td>
                                
                                <td><?php echo $reservation['veterinario']; ?></td>
                                <td><?php echo $reservation['estado1']; ?></td>
                                <td>
                                    <form action="./reservar-cita.php" method="POST">
                                        <input type="hidden" name="idr" value="<?php echo $reservation['id']; ?>">
                                        <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">
                                        <label for="asunto">Asunto:</label>
                                        <input type="text" name="asunto" required>
                                        <button type="submit" class="btn btn-primary">Reservar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <a href="./bienvenido.php?id=<?php echo $idUsuario; ?>" class="btn btn-secondary">Regresar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZjKZlO56vz5mT2Q6G7pNCk/E5g5IkojAQ" crossorigin="anonymous"></script>
</body>

</html>
