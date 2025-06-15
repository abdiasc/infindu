<div class="container-cursos">
    <div class="cursos-elementos">
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

        <div class="tarjetas">
            <?php if (!empty($cursos)): ?>
            <?php foreach ($cursos as $curso): ?>
                <div class="tar-curso" style="background-image: url('/public<?= htmlspecialchars($curso['imagen_portada']) ?>');">
                    <div class="overlay"></div>
                    <div class="contenido">
                        <p class="nivel"><?= htmlspecialchars($curso['nivel']) ?></p>
                        <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                        <p><strong><span class="icon-verified"></span></strong> <?= htmlspecialchars($curso['estado']) ?></p>
                        <p><a href="/cursos/<?= $curso['id'] ?>"> <span class="icon-text_snippet"></span> Ver Curso</a></p>
                        <p><a href="#">Inscribirme</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
                
            <?php else: ?>
                <p>No tienes cursos asignados aún.</p>
            <?php endif; ?>
        </div>

    </div>
    
</div>
