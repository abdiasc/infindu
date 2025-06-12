


<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2><?= $title ?></h2>
            <p>Lista de roles</p>
            <a href="/roles/crear" class="btn-crear"> <span class="icon-add"></span> Crear nuevo rol</a>

            <table class="tabla-usuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $rol): ?>
                        <tr>
                            <td><?= htmlspecialchars($rol['id']) ?></td>
                            <td><?= htmlspecialchars($rol['nombre']) ?></td>
                            <td>
                                <a href="/roles/edit/<?= $rol['id'] ?>" class="btn btn-editar" ><span class="icon-create"></span></a>
                                <a href="/roles/delete/<?= $rol['id'] ?>" class="btn btn-eliminar" onclick="return confirm('¿Eliminar este rol?')"><span class="icon-delete"></span></a>
                                <a href="#" class="btn btn-roles"><span class="icon-supervised_user_circle"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        
    </div>
</div>
</div>