
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>frac</title>
        <link rel="stylesheet" href="css/login-registro.css">
    </head>
    
<body>
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
                <form action="" class="formulario_login">
                    <h2>Iniciar sesión</h2>
                    <input type="text" placeholder="Correo Electrónico">
                    <input type="password" placeholder="Contraseña">
                    <button type="submit">Entrar</button>
                </form>
                <form action="" class="formulario_register">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre Completo">
                    <input type="number" placeholder="DNI">
                    <input type="number" placeholder="cellphone">
                    <input type="email" placeholder="Correo Electrónico">
                    <input type="text" placeholder="Usuario">
                    <input type="password" placeholder="Contraseña">
                    <button type="button">Registrar</button>
                </form>
            </div>
        </div>
    </main>
    <script src="js/animacionlogin.js"></script>
</body>
</html>
