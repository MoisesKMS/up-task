<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu acceso a Uptask</p>

        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form action="/olvide" method="POST" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Tu Email"
                />
            </div>

            <input type="submit" value="Enviar Instrucciones" class="boton">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? ¡Inicia Sesión!</a>
            <a href="/crear">¿Aún no tienes una cuenta? ¡Crea Una!</a>
        </div>

    </div><!--.Contenedor SM-->
</div>