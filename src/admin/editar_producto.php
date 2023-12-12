<?php
require_once "../config/bd.php";

// Verificar si se ha enviado el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoId = isset($_POST['producto_id']) ? $_POST['producto_id'] : null;

    if ($productoId) {
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $p_normal = $_POST['p_normal'];
        $p_rebajado = isset($_POST['p_rebajado']) ? $_POST['p_rebajado'] : null;
        $categoria = $_POST['categoria'];

        // Procesar la imagen si se selecciona
        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $img = $_FILES['foto'];
            $name = $img['name'];
            $tmpname = $img['tmp_name'];
            $fecha = date("YmdHis");
            $foto = $fecha . ".jpg";
            $destino = "../assets/img/" . $foto;
            move_uploaded_file($tmpname, $destino);
        }

        // Realizar la actualización de los datos en la base de datos
        $query = mysqli_query($conn, "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio_normal = '$p_normal', precio_rebajado = '$p_rebajado', cantidad = $cantidad, imagen = '$foto', id_categoria = $categoria WHERE id = $productoId");

        if ($query) {
            header('Location: productos.php');
            exit();
        } else {
            echo "Error al actualizar el producto.";
        }
    }
}

// Obtener el ID del producto a editar
$productoId = isset($_GET['id']) ? $_GET['id'] : null;

// Obtener los detalles del producto
$query = mysqli_query($conn, "SELECT * FROM productos WHERE id = $productoId");

if ($query) {
    $producto = mysqli_fetch_assoc($query);
} else {
    echo "Error al obtener los detalles del producto.";
    exit();
}

include("includes/header.php");
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Producto</h1>
</div>

<!-- Formulario para editar el producto -->
<form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input id="nombre" class="form-control" type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required>
    </div>
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input id="cantidad" class="form-control" type="text" name="cantidad" value="<?php echo $producto['cantidad']; ?>" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" class="form-control" name="descripcion" rows="3" required><?php echo $producto['descripcion']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="p_normal">Precio Normal</label>
        <input id="p_normal" class="form-control" type="text" name="p_normal" value="<?php echo $producto['precio_normal']; ?>" required>
    </div>
    <div class="form-group">
        <label for="p_rebajado">Precio Rebajado</label>
        <input id="p_rebajado" class="form-control" type="text" name="p_rebajado" value="<?php echo $producto['precio_rebajado']; ?>">
    </div>
    <div class="form-group">
        <label for="categoria">Categoria</label>
        <select id="categoria" class="form-control" name="categoria" required>
            <?php
            $categorias = mysqli_query($conn, "SELECT * FROM categorias");
            foreach ($categorias as $cat) { ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo ($producto['id_categoria'] == $cat['id']) ? 'selected' : ''; ?>><?php echo $cat['categoria']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="imagen">Foto Actual</label>
        <br>
        <img src="../assets/img/<?php echo $producto['imagen']; ?>" alt="Imagen Actual" width="100">
    </div>
    <div class="form-group">
        <label for="nueva_imagen">Nueva Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" type="submit">Actualizar</button>
</form>

<?php include("includes/footer.php"); ?>
