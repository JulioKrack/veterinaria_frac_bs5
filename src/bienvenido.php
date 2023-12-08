<?php
session_start(); 

include("./config/bd.php");

// Verifica y asigna un valor por defecto si $idUsuario no está definido o no es un número válido
$idUsuario = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

// recupera los datos de citas que tiene el usuario con id = $idUsuario
$sql = $sql = "SELECT rc.fechareserva, rc.hora, rc.asunto, rc.estado, 
c.nombre AS cliente, v.nombre AS veterinario,
m.nombre AS mascota
FROM reservadecitas rc
JOIN cliente c ON rc.id_cliente = c.id
JOIN veterinario v ON rc.id_veterinario = v.id
LEFT JOIN mascota m ON c.id = m.id_cliente
WHERE rc.id_cliente = $idUsuario";


$resultado = $conn->query($sql);
// ... Resto del código ...

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

</head>
<body>
        <div class="m-4 d-flex justify-content-end">
            <a href="index.php" class="btn btn-danger">
                <i class="bi bi-power"></i> Cerrar sesión
            </a>
        </div>
    <div class="container">

        <div class="m-5">
            <h1><center>Seleccione un servicio</center></h1>
            <h2>Hola, <span id="nombreUsuario"></span></h2>
        </div>




        <div class="principal">
            <div class="serv1 m-4">
                <h2><center>Reservación de citas</center></h2> <br>
                <img src="img/serv1.png" alt="servicio1" class="imgserv1" width="200px">
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center" href="reserva-cita.php" role="button">Reservar Cita </a>
            </div>
        
            <div class="serv2 m-4">
                <h2><center>Tienda virtual</center></h2> <br>
                <img src="img/serv2.png" alt="servicio1" width="200px" >
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center " href="productos.php" role="button">Comprar articulos </a>
            </div>
            <div hidden class="serv2 m-4">
                <h2><center>Registrar Mascota</center></h2> <br>
                <img src="img/serv4.png"  alt="servicio1" width="200px" >
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center " href="registrar-mascota.php" role="button">Registrar mascota</a>
            </div>
        </div>

                <!-- crear una tabla donde se muestra la cita pendiente -->
                <div class="m-5">
            <h2><center>Citas pendientes</center></h2>
            <table id="tablaCitas" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2021-09-01</td>
                        <td>10:00</td>
                        <td>Pendiente</td>
                        <td>
                            <button class="btn btn-danger">Cancelar</button>
                        </td>
                    </tr>
                </tbody>
            </table>



        <?php include("plantillas/footer.php"); ?>

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
            xhttp.open("GET", "saludar.php?id=<?php echo $idUsuario; ?>", true);
            xhttp.send();
        }

        window.onload = function() {
            cargarNombreUsuario();
        };
    </script>


</body>
</html>




