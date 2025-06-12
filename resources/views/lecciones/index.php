<h2>Lecciones del Curso</h2>
<a href="/lecciones/crear/<?= $curso_id ?>">Crear nueva lección</a>
<ul>
<?php foreach ($lecciones as $leccion): ?>
    <li>
        <strong><?= $leccion['titulo'] ?></strong>
        <a href="/lecciones/editar/<?= $leccion['id'] ?>">Editar</a>
        <a href="/lecciones/eliminar/<?= $leccion['id'] ?>/<?= $curso_id ?>" onclick="return confirm('¿Eliminar esta lección?')">Eliminar</a>
    </li>
<?php endforeach; ?>
</ul>