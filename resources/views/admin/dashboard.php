<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <div class="cursos">
                <h2>Cursos</h2>
                <div class="tarjetas">
                    <?php if (!empty($cursos)): ?>
                    <?php foreach ($cursos as $curso): ?>
                        <div class="tar-curso" style="background-image: url('/public<?= htmlspecialchars($curso['imagen_portada']) ?>');">
                            <div class="overlay"></div>
                            <div class="contenido">
                                <p class="nivel"><?= htmlspecialchars($curso['nivel']) ?></p>
                                <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                                <p><strong><span class="icon-verified"></span></strong> <?= htmlspecialchars($curso['estado']) ?></p>
                                <p><a href="/profesor/curso/<?= htmlspecialchars($curso['id']) ?>"> <span class="icon-text_snippet"></span> Ver Curso</a></p>
                                <p><a href="/profesor/curso/<?= $curso['id'] ?>/estudiantes">Estudiantes</a></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                
                    <?php else: ?>
                        <p>No tienes cursos asignados aún.</p>
                    <?php endif; ?>

                </div>
                
            </div>
           
        </div>
    </div>
</div>
