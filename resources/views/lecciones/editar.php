
<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h3 style="color: #000;">Editar leccion</h3>
            <form class="frm-create" action="/lecciones/actualizar/<?= $leccion['id'] ?>" method="POST">
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
                <a class="btn-cancelar" href="/admin/cursos">← Volver</a>
            </form>
            

        </div>

    </div>
</div>