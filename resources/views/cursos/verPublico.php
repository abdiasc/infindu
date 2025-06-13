<div class="container-detalle-curso">
    <h1><?= htmlspecialchars($curso['nombre']) ?></h1>

    <?php if (!empty($curso['imagen_portada'])): ?>
        <img src="/public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Imagen del curso" class="img-portada">
    <?php endif; ?>

    <p><?= nl2br(htmlspecialchars($curso['descripcion'])) ?></p>
    <p><strong>Categoría:</strong> <?= htmlspecialchars($curso['categoria']) ?></p>
    <p><strong>Nivel:</strong> <?= htmlspecialchars($curso['nivel']) ?></p>
    <p><strong>Duración:</strong> <?= htmlspecialchars($curso['duracion']) ?> horas</p>
    <p><strong>Inicio:</strong> <?= htmlspecialchars($curso['fecha_inicio']) ?></p>
    <p><strong>Fin:</strong> <?= htmlspecialchars($curso['fecha_fin']) ?></p>
    <p><strong>Cupo:</strong> <?= htmlspecialchars($curso['cupo_maximo']) ?></p>
    <p><strong>Visibilidad:</strong> <?= htmlspecialchars($curso['visibilidad']) ?></p>
    <p><strong>Creado por:</strong> <?= htmlspecialchars($curso['creador']) ?> el <?= htmlspecialchars($curso['fecha_creacion']) ?></p>

    <hr>

    <h2>Lecciones</h2>
    <?php if (!empty($lecciones)): ?>
        <ul>
            <?php foreach ($lecciones as $leccion): ?>
                <li>
                    <strong><?= htmlspecialchars($leccion['titulo']) ?></strong><br>
                    <?= nl2br(htmlspecialchars($leccion['descripcion'])) ?><br>
                    <?php if ($leccion['url_video']): ?>
                        <a href="<?= htmlspecialchars($leccion['url_video']) ?>" target="_blank">Ver video</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No hay lecciones en este curso.</p>
    <?php endif; ?>

    <hr>

    <h2>Profesor Asignado</h2>
    <?php if ($profesorAsignado): ?>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($profesorAsignado['nombre']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($profesorAsignado['email']) ?></p>
    <?php else: ?>
        <p>No hay profesor asignado aún.</p>
    <?php endif; ?>
</div>
