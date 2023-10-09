<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "veterinaria_frac";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
