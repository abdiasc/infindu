<header>
    <h1>INFINDU</h1>
    <nav>
        <ul>
            <li><a href="/">Inicio</a></li>
            <li><a href="/users">Usuarios</a></li>
            <li><a href="/cursos">Cursos</a></li>
            <li><a href="/profesores">Profesores</a></li>
            <li><a href="/estudiantes">Estudiantes</a></li>
            <li><a href="/nosotros">Nosotros</a></li>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <li><strong>👤 <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></li>
                <li><a href="/logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="/login">Iniciar sesión</a></li>
                <li><a href="/registro">Crear cuenta</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>