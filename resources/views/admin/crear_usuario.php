<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios ">
            <h2>Nuevo Usuario</h2>

            <?php if (!empty($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form  class="frm-create"  method="post" action="/registro/user">
                <label for="nombre">Nombre:</label><br>
                <input type="text" name="nombre" id="nombre" required><br>

                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required><br>

                <label for="password">Contraseña:</label><br>
                <input type="password" name="password" id="password" required><br>

                <label for="confirmar">Confirmar Contraseña:</label><br>
                <input type="password" name="confirmar" id="confirmar" required><br>

                <label for="rol">Rol:</label><br>
                <select name="rol" id="rol" required>
                    <option value="">Seleccionar rol</option>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?= htmlspecialchars($rol['id']) ?>">
                            <?= htmlspecialchars($rol['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>

                <button class="btn-iniciar" type="submit">Registrarse</button>
                <a class="btn-cancelar" href="/admin/usuarios" >Cancelar</a>
            </form>

        </div>

    </div>
</div>
</div>