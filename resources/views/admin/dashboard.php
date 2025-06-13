<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
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
                    <div class="card-curso">
                        <?php if (!empty($curso['imagen_portada'])): ?>
                            <img src="public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Portada" class="img-portada">
                        <?php endif; ?>

                        <h4><?= htmlspecialchars($curso['nombre']) ?></h4>

                        <p><?= nl2br(htmlspecialchars(limitarPalabras($curso['descripcion'], 20))) ?></p>

                        <ul>
                            <li><strong>Categoría:</strong> <?= htmlspecialchars($curso['categoria']) ?></li>
                            <li><strong>Nivel:</strong> <?= htmlspecialchars($curso['nivel']) ?></li>
                            <li><strong>Duración:</strong> <?= htmlspecialchars($curso['duracion']) ?> horas</li>
                            <li><strong>Fecha Inicio:</strong> <?= htmlspecialchars($curso['fecha_inicio']) ?></li>
                            <li><strong>Fecha Fin:</strong> <?= htmlspecialchars($curso['fecha_fin']) ?></li>
                            <li><strong>Cupo Máximo:</strong> <?= htmlspecialchars($curso['cupo_maximo']) ?></li>
                            <li><strong>Visibilidad:</strong> <?= htmlspecialchars($curso['visibilidad']) ?></li>
                            <li><strong>Estado:</strong> <?= htmlspecialchars($curso['estado']) ?></li>
                            <li><strong>Creado por:</strong> <?= htmlspecialchars($curso['creador']) ?></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
