<h2><?= htmlspecialchars($curso['nombre']) ?></h2>
<p><?= htmlspecialchars($curso['descripcion']) ?></p>

<h3>Lecciones del curso</h3>

<ul class="lista-lecciones">
    <?php foreach ($lecciones as $leccion): ?>
        <li>
            <a href="/curso/ver/leccion/<?php echo $leccion['id']; ?>">
                <?php echo htmlspecialchars($leccion['titulo']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<h3>Archivos disponibles</h3>
<ul>
    <?php foreach ($archivos as $archivo): ?>
        <li><a href="<?= htmlspecialchars($archivo['ruta_archivo']) ?>" download><?= htmlspecialchars($archivo['nombre_archivo']) ?></a></li>
    <?php endforeach; ?>
</ul>
