<?php
require_once "../config/bd.php";

if (isset($_GET['id'])) {
    $productoId = $_GET['id'];

    $query = mysqli_query($conn, "SELECT * FROM productos WHERE id = $productoId");

    if ($query) {
        $producto = mysqli_fetch_assoc($query);

        echo json_encode($producto);
    }
}
?>
