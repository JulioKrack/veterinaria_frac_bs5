<?php
include("config/bd.php");

// ...

// Se crea una función para obtener las reservas con fecha y estado 1
function obtenerReservasDisponibles($conn) {
    $sql = "SELECT id, fechareserva AS fecha FROM reservadecitas WHERE estado = 1;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Inicializamos las variables y obtenemos los datos
$ci = obtenerReservasDisponibles($conn);

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
    // Creamos una función para actualizar el selector de fechas disponibles
    function updateAvailableDates() {
        let selectedId = document.getElementById('id').value;

        // Filtramos las fechas disponibles para el veterinario seleccionado
        let availableDates = <?php echo json_encode($ci); ?>;
        availableDates = availableDates.filter(date => date.id == selectedId);

        // Llenamos el selector de fechas disponibles
        let dateSelect = document.getElementById('fecha_disponible');
        dateSelect.innerHTML = ''; // Limpiamos el selector
        availableDates.forEach(date => {
            let option = document.createElement('option');
            option.value = date.fecha;
            option.textContent = date.fecha;
            dateSelect.appendChild(option);
        });
    }
</script>

<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="mb-3">
        <label for="id" class="form-label">ID Veterinario:</label>
        <select class="form-select form-select-lg" name="id" id="id" onchange="updateAvailableDates()">
            <?php foreach ($vet as $vete) { ?>
                <option value="<?php echo $vete['id'] ?>"><?php echo $vete['id'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="fecha_disponible" class="form-label">Fecha Disponible:</label>
        <select class="form-select form-select-lg" name="fecha_disponible" id="fecha_disponible">
            <!-- Este select se llenará dinámicamente con JavaScript -->
        </select>
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
          <input type="time" value="<?php echo $hora; ?>" class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="Hora" readonly>
        </div>
      <div class="mb-3">
        <label for="asunto" class="form-label">Asunto:</label>
        <input type="text" value="" class="form-control" name="asunto"
          id="asunto" aria-describedby="helpId" placeholder="">
      </div>
      <div class="mb-3">
        <label for="id_cliente" class="form-label">ID Cliente:</label>
        <input type="text" value="1" class="form-control" name="id_cliente" readonly
          id="id_cliente" aria-describedby="helpId" placeholder="Ingrese su código">
      </div>
      <button type="submit" class="btn btn-primary">Reservar</button>
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