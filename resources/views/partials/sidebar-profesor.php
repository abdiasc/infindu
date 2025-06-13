<div class="sidebar">
    <h2>Panel de Administración</h2>
    
    <?php if ($profesor): ?>
        <div class="content-avatar">
            <?php if (!empty($profesor['avatar'])): ?>
                <div class="profesor-avatar avatar-perfil">
                    <img  src="../../../public/<?= htmlspecialchars($profesor['avatar']) ?>" alt="Avatar" width="120">
                </div>
            <?php endif; ?>
        </div>
        <div class="datos-perfil">
            <ul>
                <li><strong>Especialidad:</strong> <?= htmlspecialchars($profesor['especialidad']) ?></li>
                <li><strong>Título Académico:</strong> <?= htmlspecialchars($profesor['titulo_academico'] ?? 'No especificado') ?></li>
                <li><strong>Años de experiencia:</strong> <?= htmlspecialchars($profesor['experiencia_anios'] ?? 'No especificado') ?></li>
                <li><strong>Fecha de ingreso:</strong> <?= htmlspecialchars($profesor['fecha_ingreso'] ?? 'No especificado') ?></li>
                <li><strong>Biografía:</strong> <br><?= nl2br(htmlspecialchars($profesor['biografia'] ?? 'No especificada')) ?></li>
            </ul>
        </div>
        
    <?php else: ?>
        <p>No se encontró información de perfil para este usuario.</p>
    <?php endif; ?>
    <ul>
        <li><a href="/admin/cursos"> <span class="icon-school"></span>Mis cursos</a></li>
        <li><a href="/admin/reportes"> <span class="icon-assignment"></span> Reportes</a></li>
        <li><a href="/admin/configuracion"> <span class="icon-settings"></span> Configuración</a></li>
    </ul>

    <p class="btn-iniciar"><a href="/admin/crear-curso"><span class="icon-add"></span> Crear nuevo curso</a></p>
</div>
