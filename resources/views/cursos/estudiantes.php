<!-- resources/views/cursos/estudiantes.php -->
<h1><?= $title ?></h1>

<?php if (empty($estudiantes)): ?>
    <p>No hay estudiantes inscritos en este curso.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudiantes as $estudiante): ?>
                <tr>
                    <td><?= htmlspecialchars($estudiante['nombre']) ?></td>
                    <td><?= htmlspecialchars($estudiante['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
