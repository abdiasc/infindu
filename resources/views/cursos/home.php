<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($cursos)): ?>
    <ul class="curso-lista">
        <?php foreach ($cursos as $curso): ?>
            <?php if (!empty($curso['imagen_portada'])): ?>
                            <img src="public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Portada" class="img-portada">
            <?php endif; ?>
            <li>
                <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                <p><?= htmlspecialchars($curso['descripcion']) ?></p>
                <small>Creado por: <?= htmlspecialchars($curso['creador']) ?> el <?= htmlspecialchars($curso['fecha_creacion']) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay cursos disponibles.</p>
<?php endif; ?>
