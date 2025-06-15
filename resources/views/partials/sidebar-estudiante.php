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
        
        <?php else: ?>
        <p>No se encontró información de perfil para este usuario.</p>
    <?php endif; ?>

    <ul class="menu">
        <li><a href="/estudiante/perfil"> <span class="icon-school"></span>Perfil</a></li>
        <li><a href="/inscripciones/formulario"> <span class="icon-school"></span>Inscribirme</a></li>
        <li><a href="/estudiante/cursos"> <span class="icon-school"></span>Mis cursos</a></li>
        <li><a href="/admin/reportes"> <span class="icon-assignment"></span> Reportes</a></li>
        <li><a href="/admin/configuracion"> <span class="icon-settings"></span> Configuración</a></li>
    </ul>

    <p class="btn-iniciar"><a href="/admin/crear-curso"><span class="icon-add"></span> Crear nuevo curso</a></p>
</div>
