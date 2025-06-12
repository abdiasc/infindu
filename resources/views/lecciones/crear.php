<h2>Nueva Lección</h2>
<form action="/lecciones/guardar" method="POST">
    <input type="hidden" name="curso_id" value="<?= $curso_id ?>">
    <label>Título:</label>
    <input type="text" name="titulo" required><br>

    <label>Contenido:</label>
    <textarea name="contenido"></textarea><br>

    <label>URL Video:</label>
    <input type="text" name="url_video"><br>

    <label>Orden:</label>
    <input type="number" name="orden" value="1"><br>

    <button type="submit">Guardar</button>
</form>