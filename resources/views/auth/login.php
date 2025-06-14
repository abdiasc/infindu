<div class="container-login">
    <h2>Iniciar sesión</h2>

    <?php if (!empty($error)): ?>
        <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/login">
        <label for="email">Correo electrónico</label><br>
        <input type="email" name="email" placeholder="Escribe tu coreo electronico" required><br>
        <label for="password">Contraseña</label><br>
        <input type="password" name="password" placeholder="Escribe tu contraseña" required><br>
        
        <div class="botonera">
            <button class="btn-iniciar" type="submit">Ingresar</button>
            <a href="/registro">No tengo una cuenta</a>
        </div>
        
    </form>

</div>