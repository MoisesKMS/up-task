<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nueva Contraseña</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <?php if($mostrar): ?>

            <form method="POST" class="formulario">
                    <div class="campo">
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Tu Contraseña"
                    />
                </div>

                <input type="submit" value="Cambiar Contraseña" class="boton">
            </form>

        <?php endif; ?>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes una cuenta? ¡Crea Una!</a>
            <a href="/olvide">¿Olvidaste tu Contraseña?</a>
        </div>

    </div><!--.Contenedor SM-->
</div>