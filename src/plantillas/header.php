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
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>

</head>

<body>
  <header>
    <!-- place navbar here -->
    <nav class="nav justify-content-center  ">
      <a class="nav-link active" href="<?php echo $url_base?>secciones/usuarios/crear.php" aria-current="page">Crear Usuario</a>
      
      <a class="nav-link active" href="<?php echo $url_base?>secciones/usuarios/index.php" aria-current="page">Usuarios</a>
      <a class="nav-link active" href="<?php echo $url_base?>secciones/reservas/index.php" aria-current="page">Citas</a>
      <a class="nav-link active" href="<?php echo $url_base?>secciones/clientes/index.php" aria-current="page">Clientes</a>
      <a class="nav-link active" href="<?php echo $url_base?>secciones/veterinario/index.php" aria-current="page">Veterinario</a>
      <a href="<?php echo $url_base?>admin/index.php" class="nav-link text-info" category="all"> Productos</a>
      <a class="nav-link active" href="<?php echo $url_base?>" aria-current="page">Cerrar sesión</a>
    </nav>
  </header>
  <main>

