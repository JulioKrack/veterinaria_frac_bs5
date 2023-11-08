
<?php
include("config/bd.php");

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $tipo = $_POST["tipo"];
    $raza = $_POST["raza"];
    $id_cliente = 24;
    $peso = $_POST["peso"];




    $sql = "INSERT INTO mascota (id, nombre, edad, tipo, raza, id_cliente)
    VALUES (null, '$nombre', '$edad', '$tipo', '$raza', '$id_cliente')";
    if ($conn->query($sql) === TRUE) {
        header("Location:./bienvenido.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }  

}
// Cerrar la conexión después de obtener los datos
$conn->close();

?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>

  </header>
  <main>
    <div class="card col-4 m-auto mt-5">
        <div class="card-header">
            <strong>Registrar mascota</strong>
        </div>
        <div class="card-body mt-5">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre:</label>
                  <input type="text"
                    class="form-control" name="nombre" id="nombre" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="edad" class="form-label">Edad:</label>
                  <input type="text"
                    class="form-control" name="edad" id="edad" aria-describedby="helpId" >
                </div>  
                <div class="mb-3">
                  <label for="tipo" class="form-label">Tipo:</label>
                  <input type="text"
                    class="form-control" name="tipo" id="tipo" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="raza" class="form-label">Raza:</label>
                  <input type="text"
                    class="form-control" name="raza" id="raza" aria-describedby="helpId" >
                </div>
                <div class="mb-3">
                  <label for="peso" class="form-label">Peso:</label>
                  <input type="text"
                    class="form-control" name="peso" id="peso" aria-describedby="helpId" >
                </div>


                <div class="mb-3" hidden>
                  <label for="id_cliente" class="form-label">Cliente:</label>
                  <input type="text"
                    class="form-control" name="id_cliente" id="id_cliente" aria-describedby="helpId" value=24>
                </div>

                <div class="card-footer text-muted">
                    <input type="submit" class="btn btn-primary" value="Crear"></input>      
                    <a href="index.php" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted">
        </div>
    </div>
    </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>