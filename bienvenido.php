<?php include("./config/bd.php");?>

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
        </div>


        <div class="principal">
            <div class="serv1 m-4">
                <h2><center>Recervación de citas</center></h2> <br>
                <img src="img/serv1.png" alt="servicio1" class="imgserv1" width="200px">
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center" href="reserva-cliente.php" role="button">Reservar Cita </a>
            </div>
        
            <div class="serv2 m-4">
                <h2><center>Tienda virtual</center></h2> <br>
                <img src="img/serv2.png" alt="servicio1" width="200px" >
                <a name="" id="" class="btn btn-primary m-3 d-flex justify-content-center " href="#" role="button">Comprar articulos </a>
            </div>
        </div>



        <?php include("plantillas/footer.php"); ?>

    </div>


</body>
</html>




