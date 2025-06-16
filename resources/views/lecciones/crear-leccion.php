<div class="form-crear-leccion">
    <h2>Añadir nueva lección al curso: <?= htmlspecialchars($curso['nombre']) ?></h2>

    <form method="post" action="/profesor/curso/guardar-leccion/<?= $curso['id'] ?>">
        <input type="hidden" name="curso_id" value="<?= htmlspecialchars($curso['id']) ?>">
        <label for="titulo">Título de la lección:</label>
        <input type="text" name="titulo" required>

        <label for="contenido">Contenido:</label>
        <textarea name="contenido" rows="6" required></textarea>

        <label for="video_url">URL del video (opcional):</label>
        <input type="url" name="video_url">

        <button type="submit">Guardar lección</button>
    </form>

    <p><a href="/profesor/curso/<?= $curso['id'] ?>">← Volver al curso</a></p>
</div>
