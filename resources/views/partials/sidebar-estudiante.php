<div class="sidebar">
    <h2>Panel de Administración</h2>
    
    <?php if ($estudiante): ?>
        <div class="content-avatar">
            <?php if (!empty($estudiante['avatar'])): ?>
                <div class="profesor-avatar avatar-perfil">
                    <img src="../../../public/<?= htmlspecialchars($estudiante['avatar']) ?>" alt="Avatar" width="120">
                </div>
            <?php endif; ?>
        </div>
        <div class="datos-perfil">
            <ul>
                <li><strong>Carrera:</strong> <?= htmlspecialchars($estudiante['carrera']) ?></li>
                <li><strong>Semestre:</strong> <?= htmlspecialchars($estudiante['semestre'] ?? 'No especificado') ?></li>
                <li><strong>Matrícula:</strong> <?= htmlspecialchars($estudiante['matricula'] ?? 'No especificada') ?></li>
                <li><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($estudiante['fecha_nacimiento'] ?? 'No especificada') ?></li>
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
