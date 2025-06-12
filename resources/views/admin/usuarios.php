<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <?php

    function tiempo_transcurrido($fecha) {
        setlocale(LC_TIME, 'es_ES.UTF-8'); 
        $ahora = new DateTime();
        $fecha = new DateTime($fecha);
        $diferencia = $ahora->diff($fecha);
        

        if ($diferencia->y > 0) return "hace " . $diferencia->y . " año(s)";
        if ($diferencia->m > 0) return "hace " . $diferencia->m . " mes(es)";
        if ($diferencia->d > 0) return $diferencia->d == 1 ? "ayer" : "hace " . $diferencia->d . " días";
        if ($diferencia->h > 0) return "hace " . $diferencia->h . " hora(s)";
        if ($diferencia->i > 0) return "hace " . $diferencia->i . " minuto(s)";
        return "hace segundos";
    }
        
    
    ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2>Gestión de Usuarios</h2>
            <p>Lista de usuarios registrados en el sistema.</p>

            <a href="/users/crear" class="btn-crear">+ Crear nuevo usuario</a>

            <table class="tabla-usuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        
                        
                        foreach ($usuarios as $usuario): ?>
                        <?php 
                            $fecha = new DateTime($usuario['fecha_registro']);
                            $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
                            $formatter->setPattern('d MMMM yyyy');
                            $fecha_formateada = $formatter->format($fecha);
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['roles']) ?></td>

                            <td><?php echo $formatter->format($fecha);  ?></td>
                            <td>
                                <a href="/users/editar/<?= $usuario['id'] ?>" class="btn btn-editar"><span class="icon-create"></span></a>
                                <a href="/users/eliminar/<?= $usuario['id'] ?>" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de eliminar este usuario?')"><span class="icon-delete"></span></a>
                                <a href="/users/roles/<?= $usuario['id'] ?>" class="btn btn-roles"><span class="icon-view_list"></span></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        
    </div>
</div>
</div>