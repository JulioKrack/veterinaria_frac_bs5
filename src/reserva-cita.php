<?php
include("./config/bd.php");

// Función para obtener todas las reservas de citas desde la base de datos
function getReservaciones($conn) {
    $sql = "SELECT id,fechareserva,asunto,(SELECT nombre FROM persona WHERE id=(SELECT id_persona FROM cliente where id=id_cliente)) as clientes,(SELECT nombre FROM persona WHERE id=(SELECT id_persona FROM veterinario where id=id_veterinario)) as veterinario, (CASE WHEN estado = 1 THEN 'Disponible' ELSE 'Ocupado' END ) as estado1 FROM reservadecitas where estado=1";
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
                    <td>
                        <?php echo $reservation['asunto']; ?>
                    </td>
                    <td><?php echo $reservation['clientes']; ?></td>
                    <td><?php echo $reservation['veterinario']; ?></td>
                    <td><?php echo $reservation['estado1']; ?></td>
                    <td>
                        <a href="editar-reserva.php?id=<?php echo $reservation['id']; ?>" class="btn btn-primary">Editar</a>
                    </td>
                    </tr>
                    
            <?php endforeach; ?>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">
        <a href="./bienvenido.php" class="btn btn-secondary">Regresar</a>
    </div>
</div>

<script>
    let miTabla= document.querySelector("#tabla_id");
    let dataTable = new DataTable(miTabla);
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
