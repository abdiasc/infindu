<header>
    <a style="color: #fff; text-decoration:none" href="/"><h1>INFINDU</h1></a> 
    <nav>
        <ul style="display: flex; align-items: center; list-style: none; margin: 0; padding: 0;">
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
                        <li style="margin:0px;">
                            <img style="width: 30px; height: 30px; border-radius: 50%; object-fit: cover;" src="../../../public/<?= htmlspecialchars($profesor['avatar']) ?>" alt="Avatar" width="120">
                        </li>
                    <?php endif; ?>


                <li><strong><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></strong></li>
                <li><a href="/logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="/login">Iniciar sesión</a></li>
                <li><a href="/registro">Crear cuenta</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>