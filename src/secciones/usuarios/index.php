<?php
include("../../config/bd.php");

// Función para obtener todos los usuarios desde la base de datos (veterinario, cliente y administrador)
function getDatosUsuarios($conn) {
    $sql = "SELECT id, nombre, dni, correo, usuario, contrasenia, estado, 'veterinario' as rol 
            FROM veterinario
            UNION
            SELECT id, nombre, dni, correo, usuario, contrasenia, estado, 'cliente' as rol 
            FROM cliente
            UNION
            SELECT id, nombre, dni, correo, usuario, contrasenia, estado, 'administrador' as rol 
            FROM administrador";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

if(isset($_GET['id'])){
    $id_persona = $_GET['id'];
    $sql = "DELETE FROM persona WHERE id = '$id_persona'";
    if ($conn->query($sql) === TRUE) {
        header("Location:./index.php");
    } else {
        echo "Error: Este usuario está asignado con otras tablas " . $sql . "<br>" . $conn->error;
    }
}

// Obtener todos los usuarios existentes
$usuarios = getDatosUsuarios($conn);

// Cerrar la conexión después de obtener los datos
$conn->close();
?>

<?php include("../../plantillas/header.php")?>

<br />
<br />
<br />
<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table-bordered" id="tabla_id">
                <tr>
                    <th>ID Persona</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Correo</th>
                    <th>Usuario</th>
                    <th hidden>Contraseña</th>
                    <th>Rol</th>
                    <th>Estado</th>
                </tr>

                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nombre']; ?></td>
                        <td><?php echo $usuario['dni']; ?></td>
                        <td><?php echo $usuario['correo']; ?></td>
                        <td><?php echo $usuario['usuario']; ?></td>
                        <td hidden><?php echo $usuario['contrasenia']; ?></td>
                        <td><?php echo $usuario['rol']; ?></td>
                        <td><?php echo $usuario['estado']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?id=<?php echo $usuario['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>  
    </div>
    <div class="card-footer text-muted">
        <a hidden href="crear.php?id=<?php echo $usuario['id']; ?>" class="btn btn-primary">Crear Persona</a>
    </div>
</div>

<?php include("../../plantillas/footer.php")?>
