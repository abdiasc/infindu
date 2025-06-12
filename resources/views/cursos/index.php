<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2><?= $title ?></h2>
            <div style="text-align: right; margin-bottom: 10px;">
                <a href="/admin/crear-curso" class="btn btn-primary"> <span class="icon-add"></span> Crear Nuevo Curso</a>
            </div>

            <?php if (empty($cursos)): ?>
            <p>No hay cursos registrados aún.</p>
            <?php else: ?>
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Nivel</th>
                            <th>Duración</th>
                            <th>Estado</th>
                            <th>Profesor Asignado</th> <!-- NUEVO -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cursos as $curso): ?>
                            <tr>
                                <td><?= htmlspecialchars($curso['nombre']) ?></td>
                                <td><?= htmlspecialchars($curso['categoria']) ?></td>
                                <td><?= htmlspecialchars($curso['nivel']) ?></td>
                                <td><?= htmlspecialchars($curso['duracion']) ?> h</td>
                                <td><?= htmlspecialchars($curso['estado']) ?></td>
                                <td>
                                    <?= $curso['profesor_nombre'] ? htmlspecialchars($curso['profesor_nombre']) : '<em>No asignado</em>' ?>
                                </td>
                                <td style="width: 120px;">
                                    <a href="/admin/curso/<?= $curso['id'] ?>" title="Ver detalle" 
                                    class="btn btn-sm" 
                                    style="background-color:#17a2b8; color:white; padding:4px 8px; border-radius:4px; text-decoration:none; margin-right:4px;"><span class="icon-remove_red_eye"></span></a>

                                    <a href="/admin/curso/editar/<?= $curso['id'] ?>" title="Editar" 
                                    class="btn btn-sm" 
                                    style="background-color:#ffc107; color:black; padding:4px 8px; border-radius:4px; text-decoration:none; margin-right:4px;"><span class="icon-create"></span></a>

                                    <a href="/admin/curso/eliminar/<?= $curso['id'] ?>" title="Eliminar" 
                                    class="btn btn-sm" 
                                    style="background-color:#dc3545; color:white; padding:4px 8px; border-radius:4px; text-decoration:none;" 
                                    onclick="return confirm('¿Estás seguro de eliminar este curso?');"><span class="icon-delete"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        
    </div>
</div>
