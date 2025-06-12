<h2>Editar Lección</h2>
<form action="/lecciones/actualizar/<?= $leccion['id'] ?>" method="POST">
    <input type="hidden" name="curso_id" value="<?= $leccion['curso_id'] ?>">
    <label>Título:</label>
    <input type="text" name="titulo" value="<?= $leccion['titulo'] ?>" required><br>

    <label>Contenido:</label>
    <textarea name="contenido"><?= $leccion['contenido'] ?></textarea><br>

    <label>URL Video:</label>
    <input type="text" name="url_video" value="<?= $leccion['url_video'] ?>"><br>

    <label>Orden:</label>
    <input type="number" name="orden" value="<?= $leccion['orden'] ?>"><br>

    <button type="submit">Actualizar</button>
</form>
