<div class="container-login">

    <div class="form-registro">
        <h2>Registro de Usuario</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="/registro">
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="nombre" required placeholder="Escribe tu nombre"><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required placeholder="Correo electronico"><br>

            <label for="password">Contraseña:</label><br>
            <input type="password" name="password" id="password" required placeholder="Escribe una contraseña"><br>

            <label for="confirmar">Confirmar Contraseña:</label><br>
            <input type="password" name="confirmar" id="confirmar" required placeholder="Repite tu contraseña"><br>

            <div class="botonera">
                <button class="btn-iniciar" type="submit">Registrarse</button>
                <a href="/login"> Ya tengo una cuenta!</a>
            </div>

            
    </div>
        </form>

        
</div>