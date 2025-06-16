<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-estudiante.php'; ?>
    <div class="panel">
        <div class="admin-usuarios">
            <h2><?= $title ?></h2>
            <?php if (!empty($mensaje)): ?>
                <p style="color: green;"><?= htmlspecialchars($mensaje) ?></p>
            <?php endif; ?>

            <form method="POST" action="/inscripciones/inscribir" id="cursoForm">
                <div class="tarjetas-cursos">
                    <?php foreach ($cursos as $curso): ?>
                        <?php $inscrito = in_array($curso['id'], $idsInscritos ?? []); ?>
                        <div class="tarjeta-curso <?= $inscrito ? 'inscrito' : '' ?>" 
                             data-curso-id="<?= $curso['id'] ?>" 
                             <?= $inscrito ? 'data-inscrito="1"' : '' ?>
                             <?= $inscrito ? 'style="pointer-events: none; opacity: 0.6;"' : '' ?>>
                            <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                            <p class="nivel"><?= htmlspecialchars($curso['nivel'] ?? '') ?></p>
                            <hr>
                            <p><?= htmlspecialchars($curso['descripcion'] ?? '') ?></p>
                            <p><strong>Duración:</strong> <?= htmlspecialchars($curso['duracion'] ?? '') ?></p>
                            <p><strong>Categoría:</strong> <?= htmlspecialchars($curso['categoria'] ?? '') ?></p>
                            <?php if ($inscrito): ?>
                                <p style="color: gray;"><em>Ya inscrito</em></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <input type="hidden" name="curso_id" id="curso_id" required>

                <br>
                <button type="submit" id="btnInscribirse" disabled>Inscribirse</button>
            </form>
        </div>
    </div>
</div>
