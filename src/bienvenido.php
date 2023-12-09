<?php
session_start(); 

include("./config/bd.php");

// Verifica y asigna un valor por defecto si $idUsuario no está definido o no es un número válido
$idUsuario = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$_SESSION['idUsuario'] = $idUsuario;
// recupera los datos de citas que tiene el usuario con id = $idUsuario
$sql = $sql = "SELECT rc.id, rc.fechareserva as fecha, rc.hora as hora, rc.asunto as asunto, rc.estado as estado, 
c.nombre AS cliente, v.nombre AS veterinario,
m.nombre AS mascota
FROM reservadecitas rc
JOIN cliente c ON rc.id_cliente = c.id
JOIN veterinario v ON rc.id_veterinario = v.id
LEFT JOIN mascota m ON c.id = m.id_cliente
WHERE rc.id_cliente = $idUsuario and rc.estado=2";

// recuperar datos de la mascota
$sql2 = "SELECT m.nombre as nom, m.tipo as tip, m.raza as raz, m.peso as pes, m.edad as eda
FROM mascota m
JOIN cliente c ON m.id_cliente = c.id
WHERE c.id = $idUsuario";

// hacer que actualize el estado a 3 cuando se cancele la cita
if (isset($_POST['idr'])) {
    $id_reserva = $_POST['idr'];
    $estado = 4;
    // mantener el id del usuario para que se redirija a la pagina de bienvenida
    $idUsuario = $_SESSION['idUsuario'];
    // actualizar el estado de la cita
    $sql3 = "UPDATE reservadecitas SET estado = '$estado' WHERE id = '$id_reserva';";
    if ($conn->query($sql3) === TRUE) {
        // Redireccionar sin incluir el ID en la URL
        header("Location:./bienvenido.php?id=$idUsuario");
    } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
}


$resultado = $conn->query($sql);
// ... Resto del código ...
$resultado2= $conn->query($sql2);

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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


        <div class="d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
            <div class="card-header">
                Mi mascota
            </div>
                <ul class="list-group list-group-flush ">
                <?php foreach ($resultado2 as $result) : ?>
                <li class="list-group-item"><span>Se llama: </span><?php echo $result['nom']; ?></li>
                <li class="list-group-item"><span>Tipo: </span><?php echo $result['tip']; ?></li>
                <li class="list-group-item"><span>Raza: </span><?php echo $result['raz']; ?></li>
                <li class="list-group-item"><span>Pesa: </span><?php echo $result['pes']; ?></li>
                <li class="list-group-item"><span>Edad: </span><?php echo $result['eda']; ?></li>
                <?php endforeach; ?>
                </ul>

            <div class="card-footer">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-paw-filled" 
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" 
                stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 10c-1.32 0 -1.983 .421 -2.931 1.924l-.244 .398l-.395 .688a50.89 50.89 0 0 0 -.141 .254c-.24 .434 -.571 .753 -1.139 1.142l-.55 .365c-.94 .627 -1.432 1.118 -1.707 1.955c-.124 .338 -.196 .853 -.193 1.28c0 1.687 1.198 2.994 2.8 2.994l.242 -.006c.119 -.006 .234 -.017 .354 -.034l.248 -.043l.132 -.028l.291 -.073l.162 -.045l.57 -.17l.763 -.243l.455 -.136c.53 -.15 .94 -.222 1.283 -.222c.344 0 .753 
                .073 1.283 .222l.455 .136l.764 .242l.569 .171l.312 .084c.097 .024 .187 .045 .273 .062l.248 .043c.12 .017 .235 .028 .354 .034l.242 .006c1.602 0 2.8 -1.307 2.8 -3c0 -.427 -.073 -.939 -.207 -1.306c-.236 -.724 -.677 -1.223 -1.48 -1.83l-.257 -.19l-.528 -.38c-.642 -.47 -1.003 -.826 -1.253 -1.278l-.27 -.485l-.252 -.432c-1.011 -1.696 -1.618 -2.099 -3.053 -2.099z" stroke-width="0" fill="currentColor" />
                <path d="M19.78 7h-.03c-1.219 .02 -2.35 1.066 -2.908 2.504c-.69 1.775 -.348 3.72 1.075 4.333c.256 .109 .527 .163 .801 .163c1.231 0 2.38 -1.053 2.943 -2.504c.686 -1.774 .34 -3.72 -1.076 -4.332a2.05 2.05 0 0 0 -.804 -.164z" stroke-width="0" fill="currentColor" /><path d="M9.025 3c-.112 0 -.185 .002 -.27 .015l-.093 .016c-1.532 .206 -2.397 1.989 -2.108 3.855c.272 1.725 1.462 3.114 2.92 3.114l.187 -.005a1.26 1.26 0 0 0 
                .084 -.01l.092 -.016c1.533 -.206 2.397 -1.989 2.108 -3.855c-.27 -1.727 -1.46 -3.114 -2.92 -3.114z" stroke-width="0" fill="currentColor" />
                <path d="M14.972 3c-1.459 0 -2.647 1.388 -2.916 3.113c-.29 1.867 .574 3.65 2.174 3.867c.103 .013 .2 .02 .296 .02c1.39 0 2.543 -1.265 2.877 -2.883l.041 -.23c.29 -1.867 -.574 -3.65 -2.174 -3.867a2.154 2.154 0 0 0 -.298 -.02z" stroke-width="0" fill="currentColor" />
                <path d="M4.217 7c-.274 0 -.544 .054 -.797 .161c-1.426 .615 -1.767 2.562 -1.078 4.335c.563 1.451 1.71 2.504 2.941 2.504c.274 0 .544 -.054 .797 -.161c1.426 -.615 1.767 -2.562 1.078 -4.335c-.563 -1.451 -1.71 -2.504 -2.941 -2.504z" stroke-width="0" fill="currentColor" /></svg>
            </div>
            </div>
        
        </div>

        <div class="principal">
            <div class="serv1 m-4">
                <h2><center>Reservación de citas</center></h2> <br>
                <img src="img/serv1.png" alt="servicio1" class="imgserv1" width="200px">
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center" href="reserva-cita.php?id=<?php echo $idUsuario ; ?>" role="button">Reservar Cita </a>
            </div>
        
            <div class="serv2 m-4">
                <h2><center>Tienda virtual</center></h2> <br>
                <img src="img/serv2.png" alt="servicio1" width="200px" >
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center " href="productos.php?id=<?php echo $idUsuario ; ?>" role="button">Comprar articulos </a>
            </div>
            <div hidden class="serv2 m-4">
                <h2><center>Registrar Mascota</center></h2> <br>
                <img src="img/serv4.png"  alt="servicio1" width="200px" >
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center " href="registrar-mascota.php?id=<?php echo $idUsuario ; ?>" role="button">Registrar mascota</a>
            </div>
        </div>

                <!-- crear una tabla donde se muestra la cita pendiente -->
    <form action="bienvenido.php" method="POST"></form>
        <div class="m-5">
            <h2><center>Citas pendientes</center></h2>
            <table id="tablaCitas" class="display table-primary" style="width:100%">
                <thead>
                    <tr class="table-primary">
                        <th class="table-primary">Fecha</th>
                        <th>Hora</th>
                        <th>Asunto</th>
                        <th hidden>Estado</th>
                        <th>cliente</th>
                        <th>veterinario</th>
                        <th>mascota</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultado as $reservation) : ?>
                        <tr>
                            <td><?php echo $reservation['fecha']; ?></td>
                            <td><?php echo $reservation['hora']; ?></td>
                            <td><?php echo $reservation['asunto']; ?></td>
                            <td hidden><?php echo $reservation['estado']; ?></td>
                            <td><?php echo $reservation['cliente']; ?></td>
                            <td><?php echo $reservation['veterinario']; ?></td>
                            <td><?php echo $reservation['mascota']; ?></td>
                            <td>
                                <?php if ($reservation['estado'] == 1 || $reservation['estado'] == 2) : ?>
                                    <form action="bienvenido.php?id=<?php echo $idUsuario ;?>" method="POST">
                                        <input type="hidden" name="idr" value="<?php echo $reservation['id']; ?>">
                                        <button type="submit" class="btn btn-danger">Cancelar</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
            <br>
            <br>
            <br>    
            
            
            
        </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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




