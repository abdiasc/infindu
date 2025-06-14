<div class="sidebar">
    <h2>Panel de Administración</h2>
    <p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> (Administrador)</p>

    <ul class="menu">
        <li><a href="/admin/usuarios"> <span class="icon-people_outline"></span> Usuarios</a></li>
        <li><a href="/categorias"> <span class="icon-category"></span> Categorías</a></li>
        <li><a href="/admin/roles"> <span class="icon-dashboard"></span> Roles</a></li>
        <li><a href="/admin/permisos"> <span class="icon-assignment_turned_in"></span> Permisos</a></li>
        <li><a href="/admin/cursos"> <span class="icon-school"></span> Cursos</a></li>
        <li><a href="/admin/reportes"> <span class="icon-assignment"></span> Reportes</a></li>
        <li><a href="/admin/configuracion"> <span class="icon-settings"></span> Configuración</a></li>
    </ul>

    <p class="btn-iniciar"><a href="/admin/crear-curso"><span class="icon-add"></span> Crear nuevo curso</a></p>
</div>
