<h2><?= htmlspecialchars($curso['nombre']) ?></h2>
<p><?= htmlspecialchars($curso['descripcion']) ?></p>

<h3>Lecciones del curso</h3>
<ul>
    <?php foreach ($lecciones as $leccion): ?>
        <li>
            <strong><?= htmlspecialchars($leccion['titulo']) ?></strong><br>
            <?= nl2br(htmlspecialchars($leccion['contenido'])) ?><br>
            <?php if ($leccion['url_video']): ?>
                <a href="<?= htmlspecialchars($leccion['url_video']) ?>" target="_blank">Ver video</a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

<h3>Archivos disponibles</h3>
<ul>
    <?php foreach ($archivos as $archivo): ?>
        <li><a href="<?= htmlspecialchars($archivo['ruta_archivo']) ?>" download><?= htmlspecialchars($archivo['nombre_archivo']) ?></a></li>
    <?php endforeach; ?>
</ul>
