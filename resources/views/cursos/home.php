<div class="container-cursos">
    <h1><?= htmlspecialchars($title) ?></h1>
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



        <?php if (!empty($cursos)): ?>
            <?php foreach ($cursos as $curso): ?>
                <article class="curso">
                    <?php if (!empty($curso['imagen_portada'])): ?>
                        <img src="public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Portada" class="img-portada">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                    
                    <?= nl2br(htmlspecialchars(limitarPalabras($curso['descripcion'], 10))) ?></p>
                    <small>Creado por: <?= htmlspecialchars($curso['creador']) ?> el <?= htmlspecialchars($curso['fecha_creacion']) ?></small>
                    <div class="acciones">
                        <a href="/curso/<?= $curso['id'] ?>">Ver curso</a>
                    </div>
                        
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay cursos disponibles.</p>
        <?php endif; ?>
    </div>
    
</div>
