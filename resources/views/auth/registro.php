<div class="container">

    <div class="form-registro">
        <h2>Registro de Usuario</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="/registro">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="nombre" required><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required><br>

            <label for="password">Contraseña:</label><br>
            <input type="password" name="password" id="password" required><br>

            <label for="confirmar">Confirmar Contraseña:</label><br>
            <input type="password" name="confirmar" id="confirmar" required><br>

            <button class="btn-iniciar" type="submit">Registrarse</button>
        </form>

        <p><a href="/login">← Volver al login</a></p>
    </div>
</div>