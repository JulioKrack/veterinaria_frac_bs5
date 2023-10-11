<?php
include("config/bd.php");

// obtenemos información de reservas
if (isset($_GET['id'])) {
    $id_reserva = $_GET['id'];
    $sql = "SELECT * FROM reservadecitas WHERE id = '$id_reserva'";
    $result = $conn->query($sql);
    $registro = $result->fetch_assoc();
    $id = $registro['id'];
    $fecha_reservada = $registro['fechareserva'];
    $hora = $registro['hora'];
    $asunto = $registro['asunto'];
    $estado = $registro['estado'];
    $id_administrador = $registro['id_administrador'];
    $id_veterinario = $registro['id_veterinario'];
    $id_cliente = $registro['id_cliente'];
}

// verificamos si se envio el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST['asunto'];
    $estado = 2;
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
    $sql = "SELECT id FROM veterinario";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}
// Se crea una funcion para obtener las reservas
function obtenerReservas($conn) {
    $sql = "SELECT * FROM reservadecitas";
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

  <script>
    // Creamos una función para actualizar los campos del formulario
    function updateFormFields() {
    let selectedId = document.getElementById('id').value;
    document.getElementById('id').value = selectedId;

    for (let i = 0; i < reservations.length; i++) {
        if (reservations[i].id == selectedId) {
            document.getElementById('fechareserva').value = reservations[i].fechareserva;
            document.getElementById('hora').value = reservations[i].hora;
            document.getElementById('id_veterinario').value = reservations[i].id_veterinario;
            break;
        }
    }
}
    // Creamos una variable para almacenar las reservas
    let reservations = <?php echo json_encode($ci); ?>;
  </script>
</head>

  <body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="mb-3">
        <label for="id" class="form-label">ID Cita:</label>
        <select class="form-select form-select-lg" name="id" id="id" onchange="updateFormFields()">
          <?php foreach ($ci as $cit) { ?>
            <option value="<?php echo $cit['id'] ?>"><?php echo $cit['id'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="fechareserva" class="form-label">Fecha:</label>
        <input type="date" value="<?php echo $fecha_reservada; ?>" class="form-control" name="fechareserva"
          id="fechareserva" aria-describedby="helpId" placeholder="">
      </div>
              
      <div class="mb-3">
        <label for="id_veterinario" class="form-label">ID Veterinario:</label>
        <select class="form-select form-select-lg" name="id_veterinario" id="id_veterinario">
          <?php foreach ($vet as $vete) { ?>
            <option value="<?php echo $vete['id'] ?>"><?php echo $vete['id'] ?></option>
          <?php } ?>
        </select>
      <div class="mb-3">
        <label for="hora" class="form-label">Hora:</label>
        <input type="text" value="<?php echo $hora; ?>" class="form-control" name="hora"
          id="hora" aria-describedby="helpId" placeholder="">
      </div>
      <div class="mb-3">
        <label for="asunto" class="form-label">Asunto:</label>
        <input type="text" value="" class="form-control" name="asunto"
          id="asunto" aria-describedby="helpId" placeholder="">
      </div>
      <div class="mb-3">
        <label for="id_cliente" class="form-label">ID Cliente:</label>
        <input type="text" value="<?php echo $id_cliente; ?>" class="form-control" name="id_cliente"
          id="id_cliente" aria-describedby="helpId" placeholder="">
      </div>
      <button type="submit" class="btn btn-primary">Actualizar</button>
      <a href="bienvenido.php" class="btn btn-secondary">Regresar</a>
    </form>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>