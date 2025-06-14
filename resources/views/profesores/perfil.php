<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-profesor.php'; ?>
    <div class="panel">
        <div class="admin-usuarios">
            <?php if (!empty($profesor)): ?>
                <div class="perfil-info">
                    <?php if (!empty($profesor['avatar'])): ?>
                        <div class="profesor-avatar avatar-perfil">
                            <img src="../../../public/<?= htmlspecialchars($profesor['avatar']) ?>" alt="Avatar" width="120">
                        </div>
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($usuario['nombre']) ?></h3>
                    


            
                    <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
                    <div class="datos-perfil">
                        <h3>Perfil academico</h3>
                        <ul>
                            <li><strong>Especialidad:</strong> <?= htmlspecialchars($profesor['especialidad']) ?></li>
                            <li><strong>Título Académico:</strong> <?= htmlspecialchars($profesor['titulo_academico'] ?? 'No especificado') ?></li>
                            <li><strong>Años de experiencia:</strong> <?= htmlspecialchars($profesor['experiencia_anios'] ?? 'No especificado') ?></li>
                            <li><strong>Fecha de ingreso:</strong> <?= htmlspecialchars($profesor['fecha_ingreso'] ?? 'No especificado') ?></li>
                            <li><strong>Biografía:</strong> <br><?= nl2br(htmlspecialchars($profesor['biografia'] ?? 'No especificada')) ?></li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <p>No se encontró información de perfil para este profesor.</p>
            <?php endif; ?>

        </div>
    </div>
</div>