<?php
include("./config/bd.php");
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
    $estado=3;
    $sql = "UPDATE reservadecitas SET  estado = '$estado' WHERE id = '$id_reserva'; "  ;
    if ($conn->query($sql) === TRUE) {
        header("Location:./veterinario.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todas las reservas existentes
$reservations = getReservaciones($conn);

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
  <title>Title</title>
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
        Reserva de citas 
        <a hidden href="./crear.php" class="btn btn-primary">Crear cita</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered">
            <tr>
                <th hidden>ID Reserva</th>
                <th>Fecha Reservada</th>
                <th>Descripcion</th>
                <th hidden>Cliente</th>
                <th>Veterinario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($reservations as $reservation) : ?>
                <tr>
                    <td hidden><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['fechareserva']; ?></td>
                    <td><?php echo $reservation['asunto']; ?></td>
                    <td hidden ><?php echo $reservation['clientes']; ?></td>
                    <td><?php echo $reservation['veterinario']; ?></td>
                    <td><?php echo $reservation['estado1']; ?></td>
                    <td>
                        <a href="veterinario.php?id=<?php echo $reservation['id']; ?>" class="btn btn-danger">Atendido</a>
                    </td>
                    </tr>
                    
            <?php endforeach; ?>
            </table>
        </div>
        
    </div>
    <div class="card-footer text-muted">


     

    </div>
</div>


<?php include("./plantillas/footer.php")?>
