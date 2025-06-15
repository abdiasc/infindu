<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-estudiante.php'; ?>
    <div class="panel">
        <div class="admin-usuarios">
            <?php if (!empty($estudiante)): ?>
                <div class="perfil-info">
                    <?php if (!empty($estudiante['avatar'])): ?>
                        <div class="profesor-avatar avatar-perfil">
                            <img src="../../../public/<?= htmlspecialchars($estudiante['avatar']) ?>" alt="Avatar" width="120">
                        </div>
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($usuario['nombre']) ?></h3>
                    
                    <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
                    <div class="datos-perfil">
                        <h3>Perfil academico</h3>
                        <ul>
                            <li><strong>Carrera:</strong> <?= htmlspecialchars($estudiante['carrera']) ?></li>
                            <li><strong>Semestre:</strong> <?= htmlspecialchars($estudiante['semestre'] ?? 'No especificado') ?></li>
                            <li><strong>Matrícula:</strong> <?= htmlspecialchars($estudiante['matricula'] ?? 'No especificada') ?></li>
                            <li><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($estudiante['fecha_nacimiento'] ?? 'No especificada') ?></li>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
                <p>No se encontró información de perfil para este profesor.</p>
            <?php endif; ?>

        </div>
    </div>
</div>