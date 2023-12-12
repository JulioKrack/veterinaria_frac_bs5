<?php
require_once "config/bd.php";

if (isset($_POST['action']) && $_POST['action'] == 'buscar' && isset($_POST['data'])) {
    $array['datos'] = array();
    $total = 0;
    
    // Utilizar consultas preparadas para evitar inyecciones SQL
    $query = $conn->prepare("SELECT id, precio_rebajado, nombre FROM productos WHERE id = ?");
    $query->bind_param("i", $id); // "i" indica que se espera un parámetro de tipo entero
    
    foreach ($_POST['data'] as $producto) {
        $id = $producto['id'];
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $data['precio'] = $data['precio_rebajado'];
            $total += $data['precio_rebajado'];
            $array['datos'][] = $data;
        }
    }

    $array['total'] = $total;

    // Devolver respuesta en formato JSON
    echo json_encode($array);
    exit();
}

// Manejar cualquier otro caso o error
echo json_encode(array('error' => 'Invalid request'));
exit();
?>
