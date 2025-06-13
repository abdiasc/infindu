<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2>Editar Usuario</h2>
            <?php if (!empty($error)): ?>
                <div style="color: red;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form class="frm-create" method="POST" action="/users/editar">
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required><br>

                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br>
                <div class="roles">
                    <label>Roles:</label><br>
                    <div class="role-content">
                        <?php foreach ($roles as $rol): 
                            $isChecked = in_array($rol['nombre'], $rolesUsuario);
                        ?>
                            <label class="rol-checkbox <?= $isChecked ? 'checked' : '' ?>">
                                <input 
                                    type="checkbox" 
                                    name="roles[]" 
                                    value="<?= $rol['id'] ?>" 
                                    <?= $isChecked ? 'checked' : '' ?>
                                    onchange="this.parentElement.classList.toggle('checked', this.checked)"
                                >
                                <span><?= htmlspecialchars($rol['nombre']) ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    
                </div>
                <button type="submit">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>