<?php
include("./config/bd.php");
$idUsuario = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$_SESSION['idUsuario'] = $idUsuario;

// Función para obtener todas las reservas de citas desde la base de datos
function getReservaciones($conn) {
    $sql="SELECT rc.id, rc.fechareserva, rc.asunto,
    (SELECT nombre FROM cliente WHERE id = rc.id_cliente) as clientes,
    (SELECT nombre FROM veterinario WHERE id = rc.id_veterinario) as veterinario,
    (CASE WHEN rc.estado = 1 THEN 'Disponible' WHEN rc.estado= 2 THEN 'Reservado' WHEN rc.estado=3 THEN 'Atendido' ELSE 'Cancelado' END) as estado1,
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
function actualizarReserva($conn, $id_reserva, $asunto, $id_cliente) {
    // Verificar si el ID del cliente existe en la tabla cliente
    $verificacion = $conn->query("SELECT COUNT(*) as count FROM cliente WHERE id = $id_cliente");
    $resultado = $verificacion->fetch_assoc();

    if ($resultado['count'] > 0) {
        // El cliente existe, proceder con la actualización
        $estado = 2;
        $sql = "UPDATE reservadecitas SET estado = '$estado', asunto = '$asunto', id_cliente='$id_cliente' WHERE id = '$id_reserva';";

        if ($conn->query($sql) === TRUE) {
            // Redireccionar sin incluir el ID en la URL
            header("Location:./bienvenido.php?id=$id_cliente");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // El cliente no existe, mostrar un mensaje de error o redirigir a alguna página de error
        echo "Error: El cliente con ID $id_cliente no existe.";
    }
}

$idUsuario = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$_SESSION['idUsuario'] = $idUsuario;
if (isset($_POST['idr'], $_POST['asunto'])) {
    $id_reserva = $_POST['idr'];
    $asunto = $_POST['asunto'];
    $id_cliente = $_SESSION['idUsuario'];

    // Llamar a la función para actualizar la reserva
    actualizarReserva($conn, $id_reserva, $asunto, $id_cliente);
}
//hacer una funcion que con el id de usuario se acuatice el estado de la cita a 2
// Obtener el ID de la reserva y el ID del veterinario desde el formulario



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
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />  
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>

<br />
<br />
<br />
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
                <th>Cliente</th>
                <th>Nombre Mascota</th>
                <th>Tipo Mascota</th>
                <th>Veterinario</th>
                <th>Estado</th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td hidden><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['fechareserva']; ?></td>
                    <td><?php echo $reservation['clientes']; ?></td>
                    <td><?php echo $reservation['nombre_mascota']; ?></td>
                    <td><?php echo $reservation['tipo_mascota']; ?></td>
                    
                    <td><?php echo $reservation['veterinario']; ?></td>
                    <td><?php echo $reservation['estado1']; ?></td>
                    <td>
                        <form action="./reserva-cita.php" method="POST">
                            <input type="hidden" name="idr" value="<?php echo $reservation['id']; ?>">
                            <label for="asunto">Asunto:</label>
                            <input type="text" name="asunto" required>
                            <button type="submit" class="btn btn-primary">Reservar</button>
                        </form>
                    </td>
                    </tr>
                    
            <?php endforeach; ?>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">
        <a href="./bienvenido.php?id=<?php echo $idUsuario;?>" class="btn btn-secondary">Regresar</a>
    </div>
</div>

<script>
    let miTabla= document.querySelector("#tabla_id");
    let dataTable = new DataTable(miTabla);
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
