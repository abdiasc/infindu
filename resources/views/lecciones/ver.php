<div class="leccion-detalle">
    <h1><?php echo htmlspecialchars($leccion['titulo']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($leccion['contenido'])); ?></p>

    <?php if (!empty($leccion['video_url'])): ?>
        <div class="video">
            <iframe width="560" height="315" src="<?php echo htmlspecialchars($leccion['video_url']); ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    <?php endif; ?>

    <div class="navegacion-lecciones" style="margin-top: 20px;">
        <?php if ($leccionAnterior): ?>
            <a class="btn-anterior" href="/curso/ver/leccion/<?php echo $leccionAnterior['id']; ?>">← Lección Anterior</a>
        <?php endif; ?>

        <?php if ($leccionSiguiente): ?>
            <a class="btn-siguiente" href="/curso/ver/leccion/<?php echo $leccionSiguiente['id']; ?>">Lección Siguiente →</a>
        <?php endif; ?>
    </div>

    <p><a href="/curso/ver/<?php echo $curso['id']; ?>">← Volver al curso</a></p>
</div>