<header class="main-header">
    <div class="logo">
        <a href="/">INFINDU</a>
    </div>

    <nav class="main-nav">
        <ul>
            <li><a href="/cursos">Cursos</a></li>
            <li><a href="/nosotros">Nosotros</a></li>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <?php
                    $roles = $_SESSION['usuario_roles'] ?? [];
                    $avatar = $_SESSION['usuario_avatar'] ?? null;

                    if (in_array('administrador', $roles)) {
                        echo '<li><a href="/admin">Dashboard Admin</a></li>';
                    } elseif (in_array('profesor', $roles)) {
                        echo '<li><a href="/profesor">Panel Profesor</a></li>';
                    } elseif (in_array('estudiante', $roles)) {
                        echo '<li><a href="/estudiante">Mi Panel</a></li>';
                    }
                ?>

                <?php if (!empty($profesor['avatar'])): ?>
                    <li class="avatar-li">
                        <img src="../../../public/<?= htmlspecialchars($profesor['avatar']) ?>" alt="Avatar" class="avatar-img">
                    </li>
                <?php elseif (!empty($estudiante['avatar'])): ?>
                    <li class="avatar-li">
                        <img src="../../../public/<?= htmlspecialchars($estudiante['avatar']) ?>" alt="Avatar" class="avatar-img">
                    </li>
                <?php endif; ?>

                <li><strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></li>
                <li><a href="/logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a class="btn-iniciar-sesion" href="/login">Iniciar sesión</a></li>
                <li><a class="btn-registrarse" href="/registro">Crear cuenta</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>