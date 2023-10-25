<?php
include("config/bd.php");

// obtenemos información de reservas
if (isset($_GET['id'])) {
  $id_reserva = $_GET['id'];

  // Modificamos la consulta para obtener solo reservas con estado 1
  $sql = "SELECT * FROM reservadecitas WHERE id = '$id_reserva' AND estado = 1;";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
      $registro = $result->fetch_assoc();
      $id = $registro['id'];
      $fecha_reservada = $registro['fechareserva'];
      $hora = $registro['hora'];
      $asunto = $registro['asunto'];
      $estado = $registro['estado'];
      $id_administrador = $registro['id_administrador'];
      $id_veterinario = $registro['id_veterinario'];
      $id_cliente = $registro['id_cliente'];
  } else {
      // Si no se encuentra una reserva con estado 1, redirigimos o manejas de alguna forma
      header("Location:./bienvenido.php");
      exit();
  }
}

// verificamos si se envio el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST['asunto'];
    $estado = 2;
    // $rol='Cliente';
    $id_cliente = $_POST['id_cliente'];
    $id_reserva = $_POST['id'];  
    // Genera la reserva al cambiar el estado 1=disponible a ocupado
    $sql = "UPDATE reservadecitas 
            SET asunto = '$asunto', 
                estado = '$estado' 
            WHERE id = '$id_reserva';";

    if ($conn->query($sql) === TRUE) {
        header("Location:./bienvenido.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Se crea una funcion para obtener el id de los veterinarios
function obtenerVeterinario($conn) {
    $sql = "SELECT nombre from persona;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
// Se crea una funcion para obtener las reservas
function obtenerReservas($conn) {
    $sql = "SELECT * FROM reservadecitas Where estado = 1;" ;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Inicializamos las variables y obtenemos los datos
$vet = obtenerVeterinario($conn);
$ci = obtenerReservas($conn);

// Cerramos la conexión
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
  <title>Title</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <header class="bg-color-green">
      <h1><center>Reservación de citas</center></h1>
    </header>

    <script>
    // Creamos una variable para almacenar las reservas fuera de la función
    let reservations = <?php echo json_encode($ci); ?>;

    // Creamos una función para actualizar los campos del formulario
    function updateFormFields() {
        let selectedDate = document.getElementById('fecha_disponible').value;

        for (let i = 0; i < reservations.length; i++) {
            if (reservations[i].fechareserva === selectedDate) {
                document.getElementById('id').value = reservations[i].id;
                document.getElementById('hora').value = reservations[i].hora;
                document.getElementById('veterinario').value = reservations[i].veterinario;
                document.getElementById('id_cliente').value = reservations[i].id_cliente;
                break;
            }
        }
    }
</script>

<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="mb-3">
        <label for="fecha_disponible" class="form-label">Fecha Disponible:</label>
        <select class="form-select form-select-lg" name="fecha_disponible" id="fecha_disponible" onchange="updateFormFields()">
            <option value="">Selecciona una fecha</option>
            <?php foreach ($ci as $cit) { ?>
                <option value="<?php echo $cit['fechareserva'] ?>"><?php echo $cit['fechareserva'] ?></option>
            <?php } ?>
        </select>
    </div>
    <!-- Campos adicionales ocultos -->
    <input type="hidden" name="id" id="id" value="">
    <!-- Otros campos del formulario aquí -->
    <div class="mb-3">
        <label for="hora" class="form-label">Hora:</label>
        <input type="time" readonly class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="Hora">
    </div>
    <div class="mb-3">
        <label for="id_veterinario" class="form-label">Veterinario:</label>
        <input type="text" readonly class="form-control" name="id_veterinario" id="id_veterinario" aria-describedby="helpId">
    </div>
    <div class="mb-3">
        <label for="asunto" class="form-label">Asunto:</label>
        <input type="text" value="" class="form-control" name="asunto" id="asunto" aria-describedby="helpId" placeholder="">
    </div>
    <div class="mb-3">
        <label for="id_cliente" class="form-label">ID Cliente:</label>
        <input type="text" readonly class="form-control" name="id_cliente" id="id_cliente" aria-describedby="helpId">
    </div>
    <button type="submit" class="btn btn-primary">Reservar</button>
    <a href="bienvenido.php" class="btn btn-secondary">Regresar</a>
</form>

<!-- Bootstrap JavaScript Libraries -->
<!-- Agrega tus enlaces a las bibliotecas JavaScript aquí -->

</body>
</html>