<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2>Editar Permiso</h2>
            <form class="frm-create" action="/categorias/actualizar/<?= $categoria['id'] ?>" method="POST">
                <label for="nombre">Nombre del categoria:</label><br>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($categoria['nombre']) ?>" required><br><br>

                <label for="color">Color de la categoría:</label><br>
                <input type="color" id="color" value="<?= htmlspecialchars($categoria['color']) ?>"  name="color" required><br><br>

                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion" name="descripcion" rows="4" cols="50"><?= htmlspecialchars($categoria['descripcion']) ?></textarea><br><br>

                <button type="submit">Actualizar</button>
                <a class="btn-cancelar" href="/admin/permisos" >Cancelar</a>
            </form>
        </div>
    </div>
</div>
</div>