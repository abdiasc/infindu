<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>
    <div class="panel">
        <div class="admin-usuarios">
            <h2>Crear Nuevo Curso</h2>

            <?php if (!empty($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form class="frm-create crear-curso-nuevo" method="post" action="/admin/crear-curso" enctype="multipart/form-data">
                <label for="nombre">Nombre del Curso:</label><br>
                <input type="text" name="nombre" id="nombre" required><br><br>

                <label for="descripcion">Descripción:</label><br>
                <textarea name="descripcion" id="descripcion" rows="4" required></textarea><br><br>

                <label for="categoria">Categoría:</label><br>
                <input type="text" name="categoria" id="categoria" required><br><br>

                <label for="nivel">Nivel:</label><br>
                <select name="nivel" id="nivel" required>
                    <option value="básico">Básico</option>
                    <option value="intermedio">Intermedio</option>
                    <option value="avanzado">Avanzado</option>
                </select><br><br>

                <label for="duracion">Duración (horas):</label><br>
                <input type="number" name="duracion" id="duracion" min="1" required><br><br>

                <label for="imagen_portada">Imagen de Portada:</label><br>
                <input type="file" name="imagen_portada" id="imagen_portada" accept="image/*"><br><br>

                <label for="estado">Estado:</label><br>
                <select name="estado" id="estado">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select><br><br>

                <label for="fecha_inicio">Fecha de Inicio:</label><br>
                <input type="date" name="fecha_inicio" id="fecha_inicio"><br><br>

                <label for="fecha_fin">Fecha de Fin:</label><br>
                <input type="date" name="fecha_fin" id="fecha_fin"><br><br>

                <label for="cupo_maximo">Cupo Máximo:</label><br>
                <input type="number" name="cupo_maximo" id="cupo_maximo" min="1"><br><br>

                <label for="visibilidad">Visibilidad:</label><br>
                <select name="visibilidad" id="visibilidad">
                    <option value="publico">Público</option>
                    <option value="privado">Privado</option>
                </select><br><br>

                <button type="submit">Crear Curso</button>
            </form>

            <p><a href="/admin">← Volver al Dashboard</a></p>
        </div>
    </div>
</div>










