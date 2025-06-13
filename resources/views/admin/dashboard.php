<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2>Dashboard de Administración</h2>
            <p>En esta sección puedes gestionar los cursos y usuarios del sistema.</p>
            <h3>Cursos Disponibles</h3>
            <?php
                // Función para limitar la descripción a 20 palabras
                function limitarPalabras($texto, $limite = 20) {
                    $palabras = explode(' ', strip_tags($texto));
                    if (count($palabras) > $limite) {
                        return implode(' ', array_slice($palabras, 0, $limite)) . '...';
                    }
                    return $texto;
                }
            ?>
            <?php if (empty($cursos)): ?>
            <p>No hay cursos registrados aún.</p>
            <?php else: ?>
                <p>Total de cursos registrados: <strong><?= count($cursos) ?></strong></p>

                <div class="lista-cursos">
                    <?php foreach ($cursos as $curso): ?>
                        <div class="curso-tarjeta">
                            <div class="tarjeta-head">
                                <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                                <div class="info-tarjeta">
                                    
                                    <span><span class="icon-person"></span><?= htmlspecialchars($curso['creador']) ?></span>
                                    <span><span class="icon-equalizer"></span>  <?= htmlspecialchars($curso['nivel']) ?></span>
                                    <span><span class="icon-content_copy"></span> <?= htmlspecialchars($curso['categoria']) ?></span>
                                    
                                </div>
                        
                            
                                <?php if (!empty($curso['imagen_portada'])): ?>
                                    <img src="public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Portada" class="img-portada">
                                <?php endif; ?>
                            </div>
                            <div class="tarjeta-body">
                                <p><strong><span class="icon-calendar_today"> </span>Inicio </strong> <small class="fecha-inicio"><?= htmlspecialchars($curso['fecha_inicio']) ?></small> </p>
                                <p><strong><span class="icon-date_range"> </span>Fin </strong> <small class="fecha-fin"><?= htmlspecialchars($curso['fecha_fin']) ?></small></p>
                                <p><strong><span class="icon-verified"></span></strong> <?= htmlspecialchars($curso['estado']) ?></p>
                                <p><strong>Duración:</strong> <?= htmlspecialchars($curso['duracion']) ?> horas</p>
                                <p><strong>Cupo Máximo:</strong> <?= htmlspecialchars($curso['cupo_maximo']) ?></p>
                                <p><strong>Visibilidad:</strong> <?= htmlspecialchars($curso['visibilidad']) ?></p>
                            </div>
                            <hr>
                            <div class="acciones">
                                <a class="btn-ver" href="/admin/curso/<?= htmlspecialchars($curso['id']) ?>"> <span class="icon-text_snippet"></span> Ver Curso</a>
                                <a class="btn-editar-curso" href="/admin/curso/editar/<?= htmlspecialchars($curso['id']) ?>"> <span class="icon-edit"></span> Editar</a>
                                <a class="btn-eliminar-curso" href="/admin/curso/eliminar/<?= htmlspecialchars($curso['id']) ?>"> <span class="icon-delete"></span> Eliminar</a>      
                            </div>
                            <!--<p><?= nl2br(htmlspecialchars(limitarPalabras($curso['descripcion'], 20))) ?></p> -->
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>


        

        

        
    </div>
</div>
