<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

<div class="panel">
        <div class="admin-usuarios">
            <h2>Gestion de categorias</h2>
            <a href="/categorias/crear" style="display:inline-block; margin-bottom: 10px; background:#28a745; color:white; padding:5px 10px; text-decoration:none; border-radius:5px;"><span class="icon-add"></span> Nuevo Permiso</a>

            <table class="tabla-usuarios">
                <thead style="background-color: #f8f8f8;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categorias)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No hay categorias registradas.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td style="background-color: <?= htmlspecialchars($categoria['color']) ?>;"><?= htmlspecialchars($categoria['id']) ?></td>
                                <td><?= htmlspecialchars($categoria['nombre']) ?></td>
                                <td><span style="display:inline-block; width: 20px; height: 20px; border-radius: 4px; background-color: <?= htmlspecialchars($categoria['color']) ?>;"> </span> <?= htmlspecialchars($categoria['color']) ?></td>
                                

                                <td><?= htmlspecialchars($categoria['descripcion']) ?></td>
                                <td>
                                    <a href="/categorias/editar/<?= $categoria['id'] ?>" class="btn btn-editar"><span class="icon-create"></span></a>
                                    <a href="/categorias/eliminar/<?= $categoria['id'] ?>" class="btn btn-eliminar" onclick="return confirm('¿Está seguro de eliminar esta categoria?')"><span class="icon-delete"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
</div>