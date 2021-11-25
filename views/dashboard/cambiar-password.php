<?php include_once __DIR__ . '/header-dashboard.php'; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <a href="/perfil" class="enlace">Volver al Perfil</a>

    <form class="formulario" method="POST" action="/cambiar-password">
        <div class="campo">
            <label for="password">Contraseña Actual</label>
            <input
                type="password"
                name="password_actual"
                placeholder="Ingresa tu Contraseña Actual"
            />
        </div>

        <div class="campo">
            <label for="password_nuevo">Contraseña Nueva</label>
            <input
                type="password"
                name="password_nuevo"
                placeholder="Ingresa tu Nueva Contraseña"
            />
        </div>

        <input type="submit" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'; ?>