<?php
require_once "../config/bd.php";

// Manejar el envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoId = isset($_POST['producto_id']) ? $_POST['producto_id'] : null;

    if (isset($_POST['nombre'], $_POST['cantidad'], $_POST['descripcion'], $_POST['p_normal'], $_POST['categoria']) && !empty($_POST['nombre'])) {
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

        if ($productoId) {
            // Realizar la actualización de los datos en lugar de la inserción
            $query = mysqli_query($conn, "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio_normal = '$p_normal', precio_rebajado = '$p_rebajado', cantidad = $cantidad, imagen = '$foto', id_categoria = $categoria WHERE id = $productoId");
        } else {
            // Realizar la inserción de los datos
            $query = mysqli_query($conn, "INSERT INTO productos(nombre, descripcion, precio_normal, precio_rebajado, cantidad, imagen, id_categoria) VALUES ('$nombre', '$descripcion', '$p_normal', '$p_rebajado', $cantidad, '$foto', $categoria)");
        }

        if ($query) {
            header('Location: productos.php');
        } else {
            echo "Error al agregar o actualizar el producto.";
        }
    }
}

include("includes/header.php");
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
</div>

<!-- Formulario para agregar nuevos productos -->
<div>
    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input id="cantidad" class="form-control" type="text" name="cantidad" placeholder="Cantidad" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" class="form-control" name="descripcion" placeholder="Descripción" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="p_normal">Precio Normal</label>
            <input id="p_normal" class="form-control" type="text" name="p_normal" placeholder="Precio Normal" required>
        </div>
        <div class="form-group">
            <label for="p_rebajado">Precio Rebajado</label>
            <input id="p_rebajado" class="form-control" type="text" name="p_rebajado" placeholder="Precio Rebajado">
        </div>
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <select id="categoria" class="form-control" name="categoria" required>
                <?php
                $categorias = mysqli_query($conn, "SELECT * FROM categorias");
                foreach ($categorias as $cat) { ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="imagen">Foto</label>
            <input type="file" class="form-control" name="foto">
        </div>
        <button class="btn btn-primary" type="submit">Registrar</button>
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="myTable" class="table table-hover table-bordered" style="width: 100%;">
                <thead class="thead-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio Normal</th>
                        <th>Precio Rebajado</th>
                        <th>Cantidad</th>
                        <th>Categoria</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT p.*, c.id AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria ORDER BY p.id DESC");
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><img class="img-thumbnail" src="../assets/img/<?php echo $data['imagen']; ?>" width="50"></td>
                            <td><?php echo $data['nombre']; ?></td>
                            <td><?php echo $data['descripcion']; ?></td>
                            <td><?php echo $data['precio_normal']; ?></td>
                            <td><?php echo $data['precio_rebajado']; ?></td>
                            <td><?php echo $data['cantidad']; ?></td>
                            <td><?php echo $data['categoria']; ?></td>
                            <td>
                                <form method="post" action="eliminar.php?accion=pro&id=<?php echo $data['id']; ?>" class="d-inline eliminar">
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </td>
                            <td>
                                <a href="editar_producto.php?id=<?php echo $data['id']; ?>" class="btn btn-primary">Editar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
        // Manejar el clic en los botones "Agregar al Carrito"
        $('.btn-outline-dark').click(function () {
            // Obtener datos del producto
            var id = $(this).data('id');
            var nombre = $(this).data('nombre');
            var precio = $(this).data('precio');

            // Crear objeto producto
            var producto = {
                id: id,
                nombre: nombre,
                precio: precio,
                cantidad: 1
            };

            // Obtener productos del carrito desde localStorage
            var productosCarrito = JSON.parse(localStorage.getItem('productos')) || [];

            // Verificar si el producto ya está en el carrito
            var productoExistente = productosCarrito.find(function (item) {
                return item.id === id;
            });

            // Si el producto existe, incrementar la cantidad
            if (productoExistente) {
                // Aquí puedes verificar la cantidad disponible
                if (productoExistente.cantidad >= MAX_CANTIDAD_DISPONIBLE) {
                    alert('No se pueden agregar más unidades de este producto.');
                    return;
                }

                productoExistente.cantidad++;
            } else {
                // Si no existe, agregar el producto al carrito
                productosCarrito.push(producto);
            }

            // Guardar productos en localStorage
            localStorage.setItem('productos', JSON.stringify(productosCarrito));
        });

        // Redirigir al carrito al hacer clic en "Ir al Carrito"
        $('#btnIrCarrito').click(function () {
            window.location.href = "carrito.php?id=<?php echo $idUsuario; ?>";
        });
    });
</script>


<?php include("includes/footer.php"); ?>
