

<div class="contenido">
    <div class="panel">
        <div class="admin-usuarios">
            <h2>Hola! <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> completa tu perfil de profesor</h2>
            <p>Para poder acceder a todas las funcionalidades de la plataforma, es necesario que completes tu perfil.</p>
            <p>Por favor, completa la siguiente información:</p>
            <?php if (!empty($error)): ?>
                <div style="color: red; margin-bottom: 10px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form class="frm-create" action="/perfil/guardar" method="post" enctype="multipart/form-data">
                <div>
                    <label for="especialidad">Especialidad <span style="color:red">*</span></label><br>
                    <input type="text" id="especialidad" name="especialidad" required
                        value="<?= htmlspecialchars($_POST['especialidad'] ?? '') ?>">
                </div>
                <div>
                    <label for="titulo_academico">Título Académico</label><br>
                    <input type="text" id="titulo_academico" name="titulo_academico"
                        value="<?= htmlspecialchars($_POST['titulo_academico'] ?? '') ?>">
                </div>
                <div>
                    <label for="experiencia_anios">Años de experiencia</label><br>
                    <input type="number" id="experiencia_anios" name="experiencia_anios" min="0"
                        value="<?= htmlspecialchars($_POST['experiencia_anios'] ?? '') ?>">
                </div>
                <div>
                    <label for="fecha_ingreso">Fecha de ingreso</label><br>
                    <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                        value="<?= htmlspecialchars($_POST['fecha_ingreso'] ?? '') ?>">
                </div>
                <div>
                    <label for="Avatar">Avatar</label><br>
                    <input type="file" name="avatar" accept="image/*">
                </div>
                <div>
                    <label for="biografia">Biografía</label><br>
                    <textarea id="biografia" name="biografia" rows="4" cols="50"><?= htmlspecialchars($_POST['biografia'] ?? '') ?></textarea>
                </div>
                <br>
                <button type="submit">Guardar Perfil</button>
            </form>
            
        </div>
    </div>
</div>

