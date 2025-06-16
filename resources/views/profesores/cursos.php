<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-profesor.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2><?= htmlspecialchars($title) ?></h2>

            <?php if (empty($cursos)): ?>
                <p>No hay cursos asignados.</p>
            <?php else: ?>
                <table class="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Nivel</th>
                            <th>Duración</th>
                            <th>Estado</th>
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
                                <td style="width: 180px;">
                                    <a href="/profesor/curso/<?= $curso['id'] ?>" title="Ver detalle" class="btn btn-sm" style="background-color:#17a2b8; color:white;">Ver</a>
                                    <a href="/profesor/curso/crear-leccion/<?= $curso['id'] ?>" title="Añadir lección"
                                        class="btn btn-sm"
                                        style="background-color:#28a745; color:white; padding:4px 8px; border-radius:4px; text-decoration:none;">
                                        Añadir lección
                                    </a>
                                    <!-- Agrega aquí otras acciones si deseas -->
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
