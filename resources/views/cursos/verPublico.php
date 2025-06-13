<div class="container-detalle-curso">
    <div class="slider">
        <div class="slider-bg" style="background-image: url('/public/<?= htmlspecialchars($curso['imagen_portada']) ?>');"></div>

        <div class="overlay"></div>

        <div class="texto-slider">
            <div class="texto-curso-slider">
                <h1><?= htmlspecialchars($curso['nombre']) ?></h1>
                <p><?= nl2br(htmlspecialchars($curso['descripcion'])) ?></p>
                <div class="curso-datos-slider">
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($curso['categoria']) ?></p>
                    <p><strong>Nivel:</strong> <?= htmlspecialchars($curso['nivel']) ?></p>
                    <p><strong>Duración:</strong> <?= htmlspecialchars($curso['duracion']) ?> horas</p>
                    <p><strong>Inicio:</strong> <?= htmlspecialchars($curso['fecha_inicio']) ?></p>
                    <p><strong>Fin:</strong> <?= htmlspecialchars($curso['fecha_fin']) ?></p>
                    <p><strong>Cupo:</strong> <?= htmlspecialchars($curso['cupo_maximo']) ?></p>
                    <p><strong>Visibilidad:</strong> <?= htmlspecialchars($curso['visibilidad']) ?></p>
                    <p><strong>Creado por:</strong> <?= htmlspecialchars($curso['creador']) ?> el <?= htmlspecialchars($curso['fecha_creacion']) ?></p>
                </div>
            </div>
            <div class="slider-image">
                <?php if (!empty($curso['imagen_portada'])): ?>
                    <img src="/public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Imagen del curso" class="img-responsive">
                <?php else: ?>
                    <p>No hay imagen de portada disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="lecciones-publico">
        <div class="lecciones-lista">
            <h2>Lecciones del Curso</h2>
            <?php if (count($lecciones) > 0): ?>
                <ul class="lista-lecciones">
                    <?php foreach ($lecciones as $leccion): ?>
                        <li class="leccion-item">
                            <h3><?= htmlspecialchars($leccion['titulo']) ?></h3>
                            <p><?= nl2br(htmlspecialchars($leccion['contenido'])) ?></p>
                            <a href="<?= htmlspecialchars($leccion['url_video']) ?>" target="_blank" class="btn-ver-video">Ver Video</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No hay lecciones disponibles para este curso.</p>
            <?php endif; ?>
        
        </div>
        <div class="profesor-asignado-curso">
            <h2>Profesor Asignado</h2>
            <div class="profesor-avatar">
                <?php if (!empty($profesorAsignado) && !empty($profesorDatos)): ?>
                    <img src="/public/<?= htmlspecialchars($profesorDatos['avatar']) ?>" alt="Avatar del profesor" width="120">
                <?php else: ?>
                    <p>No hay imagen de profesor disponible.</p>
                <?php endif; ?>
            </div>
            <div class="profesor-datos">
                <?php if (!empty($profesorAsignado) && !empty($profesorDatos)): ?>
                    <p><strong>Nombre:</strong> <?= htmlspecialchars($profesorAsignado['nombre']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($profesorAsignado['email']) ?></p>
                <?php else: ?>
                    <p>No hay profesor asignado aún.</p>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
    .
</div>
