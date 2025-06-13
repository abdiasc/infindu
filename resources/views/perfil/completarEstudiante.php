
<div class="contenido">
    <div class="panel">
        <div class="admin-usuarios">
            <h2>Hola! <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> completa tu perfil de estudiante</h2>
            <p>Para poder acceder a todas las funcionalidades de la plataforma, es necesario que completes tu perfil.</p>
            <p>Por favor, completa la siguiente información:</p>
            <?php if (!empty($error)): ?>
                <div style="color: red; margin-bottom: 10px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form  class="frm-create" action="/perfil/guardar_estudiante" method="post" enctype="multipart/form-data">
                <div>
                    <label for="carrera">Carrera <span style="color:red">*</span></label><br>
                    <input type="text" id="carrera" name="carrera" required
                        value="<?= htmlspecialchars($_POST['carrera'] ?? '') ?>">
                </div>
                <div>
                    <label for="semestre">Semestre</label><br>
                    <input type="text" id="semestre" name="semestre"
                        value="<?= htmlspecialchars($_POST['semestre'] ?? '') ?>">
                </div>
                <div>
                    <label for="matricula">Matricula</label><br>
                    <input type="number" id="matricula" name="matricula" min="0"
                        value="<?= htmlspecialchars($_POST['matricula'] ?? '') ?>">
                </div>
                <div>
                    <label for="fecha_nacimiento">Fecha de nacimiento</label><br>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="<?= htmlspecialchars($_POST['fecha_nacimiento'] ?? '') ?>">
                </div><br>
                <div>
                    <label for="avatar">Avatar:</label>
                    <input type="file" name="avatar" accept="image/*">
                </div>
                <button type="submit">Guardar Perfil</button>
            </form>
            
        </div>
    </div>
</div>
