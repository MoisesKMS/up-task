<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>
        <form action="/" method="POST" class="formulario">
        <div class="campo">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    placeholder="Tu nombre"
                />
            </div>

            <div class="campo">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Tu Email"
                />
            </div>

            <div class="campo">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Tu Contraseña"
                />
            </div>

            <div class="campo">
                <label for="password2">Repite tu Contraseña</label>
                <input
                    type="password"
                    name="password2"
                    id="password2"
                    placeholder="Repite tu Contraseña"
                />
            </div>

            <input type="submit" value="Iniciar Sesión" class="boton">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? ¡Inicia Sesión!</a>
            <a href="/olvide">¿Olvidaste tu Contraseña?</a>
        </div>

    </div><!--.Contenedor SM-->
</div>