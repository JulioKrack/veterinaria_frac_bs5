<?php
include("./config/bd.php");
$idVeterinario= isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
function getReservaciones($conn, $idVeterinario) {
    
    $sql = "SELECT rc.id, rc.fechareserva, rc.asunto,
    (SELECT nombre FROM cliente WHERE id = rc.id_cliente) as clientes,
    (SELECT nombre FROM veterinario WHERE id = rc.id_veterinario) as veterinario,
    (CASE WHEN rc.estado = 1 THEN 'Disponible' WHEN rc.estado= 2 THEN 'Reservado' WHEN rc.estado=3 THEN 'Atendido' ELSE 'Cancelado' END) as estado1,
    (SELECT m.nombre FROM mascota m 
     JOIN cliente c ON m.id_cliente = c.id
     WHERE c.id = rc.id_cliente) as nombre_mascota,
    (SELECT m.tipo FROM mascota m 
     JOIN cliente c ON m.id_cliente = c.id
     WHERE c.id = rc.id_cliente) as tipo_mascota
    FROM reservadecitas rc WHERE rc.id_veterinario = $idVeterinario";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Obtener el ID de la reserva y el ID del veterinario desde el formulario
if (isset($_POST['idr'], $_POST['idVeterinario'])) {
    $id_reserva = $_POST['idr'];
    $idVeterinario = $_POST['idVeterinario'];
    
    $estado = 3;
    $sql = "UPDATE reservadecitas SET estado = '$estado' WHERE id = '$id_reserva';";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar sin incluir el ID en la URL
        header("Location:./veterinario.php?id=$idVeterinario");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todas las reservas existentes
$reservations = getReservaciones($conn , $idVeterinario);



// Cerrar la conexión después de obtener los datos
$conn->close();
?>


<?php
session_start();
$url_base="http://localhost/veterinaria_frac_bs5/src/";

?>

<!doctype html>
<html lang="en">

<head>
  <title>Veterinario</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Veterinaria frac</title>

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />  
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <header>
    <!-- place navbar here -->
    <h1 class="d-flex justify-content-center bg-info">Bienvenido</h1>
    <nav class="nav justify-content-center  ">
        <a class="nav-link active" aria-current="page" href="<?php echo $url_base?>veterinario.php">Inicio</a>
        <a class="nav-link active" href="<?php echo $url_base?>" aria-current="page">Cerrar sesión</a>
    </nav>
  </header>
  <main>

<br />
<br />
<br />
<div class="card">
    <div class="card-header">
        <h2>Hola, <span id="nombreUsuario"></span></h2>
        Reserva de citas 
        <a hidden href="./crear.php" class="btn btn-primary">Crear cita</a>
    </div>
    <!-- reducir el tamaño de la tabla -->
    <div class="card-body">
        <div class="table-responsive-sm ">
            <table class="table table-bordered ">
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
                    <td><?php echo $reservation['fechareserva']; ?></td>
                    <td><?php echo $reservation['asunto']; ?></td>
                    <td ><?php echo $reservation['clientes']; ?></td>
                    <td><?php echo $reservation['nombre_mascota']; ?></td>
                    <td><?php echo $reservation['tipo_mascota']; ?></td>
                    <td><?php echo $reservation['veterinario']; ?></td>
                    <td><?php echo $reservation['estado1']; ?></td>
                    <td>
                        <form method="post" action="veterinario.php">
                            <input type="hidden" name="idr" value="<?php echo $reservation['id']; ?>">
                            <input type="hidden" name="idVeterinario" value="<?php echo $idVeterinario; ?>">
                            <button type="submit" class="btn btn-danger">Atendido</button>
                        </form>
                    </td>
                    </tr>
                    
            <?php endforeach; ?>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">


     

    </div>
</div>
<script>
        function cargarNombreUsuario() {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("nombreUsuario").innerText = this.responseText;
                }
            };

            // Cambia 'saludar.php?id=' por la ruta correcta de tu archivo
            xhttp.open("GET", "saludarV.php?id=<?php echo $idVeterinario; ?>", true);
            xhttp.send();
        }

        window.onload = function() {
            cargarNombreUsuario();
        };
    </script>


<?php include("./plantillas/footer.php")?>
