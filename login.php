<?php
session_start();
include("./config/bd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasenia = $_POST['contrasenia'];

    // Consulta preparada para evitar SQL injection
    $sql = "SELECT * FROM persona WHERE usuario = ? AND contrasenia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasenia);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener la primera fila de resultados
        $row = $result->fetch_assoc();

        // Verificar el rol
        if ($row['rol'] === 'Administrador') {
            $_SESSION['logeado'] = true;
            header("Location:./secciones/reservas/index.php"); // Redireccionar a la página de administrador
            exit();
        } elseif ($row['rol'] === 'cliente') {
            $_SESSION['logeado'] = true;
            header("Location: ./bienvenido.php"); // Redireccionar a la página de cliente
            exit();
        } else {
            $mensaje = "Rol desconocido";
        }
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
    }

    $stmt->close();
}
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

  <style>
    body {
      background-img: url(../img/imagen1.jpg);
      background-size: cover;
    }
  </style>


</head>
<body>

  <main class="container">
    <div class="row">
        <div class="col-md-4      ">
  
        </div>
        <div class="col-md-4      ">
            <br/>
            <br/>
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <?php if(isset($mensaje) ){ ?>
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo $mensaje;?></strong>
                            </div>
                        <?php } ?>

                        <form action="" method="post">
                            <div class="mb-3">
                              <label for="usuario" class="form-label">Usuario</label>
                              <input type="text"
                                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Ingrese su usuario">
                            </div> 
                            <div class="mb-3">
                              <label for="contrasenia" class="form-label">Contraseña</label>
                              <input type="password"
                                class="form-control" name="contrasenia" id="contrasenia" aria-describedby="helpId" placeholder="Ingrese su contraseña">
                            </div> 
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </form>
                        
                    </div>

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