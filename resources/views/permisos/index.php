


<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2>Gestión de Permisos</h2>
            <a href="/permisos/crear" style="display:inline-block; margin-bottom: 10px; background:#28a745; color:white; padding:5px 10px; text-decoration:none; border-radius:5px;"><span class="icon-add"></span> Nuevo Permiso</a>

            <table class="tabla-usuarios">
                <thead style="background-color: #f8f8f8;">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($permisos)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No hay permisos registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($permisos as $permiso): ?>
                            <tr>
                                <td><?= htmlspecialchars($permiso['id']) ?></td>
                                <td><?= htmlspecialchars($permiso['nombre']) ?></td>
                                <td><?= htmlspecialchars($permiso['descripcion']) ?></td>
                                <td>
                                    <a href="/permisos/editar/<?= $permiso['id'] ?>" class="btn btn-editar"><span class="icon-create"></span></a>
                                    <a href="/permisos/eliminar/<?= $permiso['id'] ?>" class="btn btn-eliminar" onclick="return confirm('¿Está seguro de eliminar este permiso?')"><span class="icon-delete"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            

        </div>
    </div>
</div>
