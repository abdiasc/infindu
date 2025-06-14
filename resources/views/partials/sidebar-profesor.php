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
        
        
    <?php else: ?>
        <p>No se encontró información de perfil para este usuario.</p>
    <?php endif; ?>
    <ul class="menu">
        <li><a href="/profesor"> <span class="icon-dashboard"></span> Dashboard</a></li>
        <li><a href="/profesor/perfil"> <span class="icon-dashboard"></span> Perfil</a></li>
        <li><a href="/admin/cursos"> <span class="icon-school"></span>Mis cursos</a></li>
        <li><a href="/admin/reportes"> <span class="icon-assignment"></span> Reportes</a></li>
        <li><a href="/admin/configuracion"> <span class="icon-settings"></span> Configuración</a></li>
    </ul>

    <p class="btn-iniciar"><a href="/admin/crear-curso"><span class="icon-add"></span> Crear nuevo curso</a></p>
</div>
