
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>frac</title>
        <link rel="stylesheet" href="./css/login-registro.css">
        
    </head>
    
<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <main>
        <div class="contenedor_todo">
            <div class="caja_trasera">
                <div class="caja_trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn_iniciar_sesion">Iniciar sesión</button>
                </div>
                <div class="caja_trasera-register">
                    <h3>¿Aún no tienes cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn_registrarse">Registrarse</button>
                </div>
            </div>
            <div class="contenedor_login-register">
                <form action="./login-cliente.php" method="POST" class="formulario_login">
                    <h2>Iniciar sesión</h2>
                    <input type="text" placeholder="usuario" name="usuario" id="usuario" required>
                    <input type="password" placeholder="Contraseña" name="contrasenia" id="contrasenia" required>
                    <button type="submit">Entrar</button>
                </form>
                <form action="./registro_usuario.php" method="POST" class="formulario_register">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="Nombre Completo" name="nombre" required>
                    <input type="number" placeholder="DNI" name="dni">
                    <input type="number" placeholder="telefono" name="telefono" required>
                    <input type="email" placeholder="Correo Electrónico" name="correo" required>
                    <input type="text" placeholder="Usuario" name="usuario" required>
                    <input type="password" placeholder="Contraseña" name="contrasenia" required>
                    <!-- crear campos para registrar mascota tambien -->
                    <input type="text" placeholder="Nombre de la mascota" name="nombre_mascota" required>
                    <input type="number" placeholder="Edad" name="edad" required>
                    <input type="text" placeholder="Tipo" name="tipo" required>
                    <input type="text" placeholder="Raza" name="raza" required>
                    <input type="number" placeholder="Peso" name="peso" required>

                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="./js/animacionlogin.js"></script>
</body>
</html>
