<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-estudiante.php'; ?>
    <div class="panel">
        <div class="admin-usuarios">
            <h1>Mis Cursos</h1>
            <div class="cursos cursos-inscritos">
                <?php if (empty($cursos)): ?>
                    <p>No tienes cursos inscritos.</p>
                <?php else: ?>
                    <?php foreach ($cursos as $curso): ?>
                        <div class="cursos-items">
                            <h2><?php echo htmlspecialchars($curso['nombre']); ?></h2>
                            <p class="nivel"><?php echo htmlspecialchars($curso['nivel']); ?></p>
                            <hr>
                            <p><?php echo htmlspecialchars($curso['descripcion']); ?></p>
                            <p><strong>Fecha de inicio:</strong> <?php echo htmlspecialchars($curso['fecha_inicio']); ?></p>
                            <p><strong>Fecha de fin:</strong> <?php echo htmlspecialchars($curso['fecha_fin']); ?></p>
                            <hr>
                            <a class="btn" href="/curso/ver/<?php echo $curso['id']; ?>">Ir al curso</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
