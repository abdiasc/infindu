<h2>Estudiante</h2>
<p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> (Estudiante)</p>

<?php if (!empty($mostrarAlerta)): ?>
    <div style="background-color: #ffeeba; color: #856404; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ffeeba;">
        <strong>¡Perfil Incompleto!</strong> Aún no has completado tu registro como estudiante. 
        <a href="/perfil/completar_estudiante" style="text-decoration: underline; color: #856404;">Haz clic aquí para completarlo</a>.
    </div>
<?php endif; ?>

    <?php if ($estudiante): ?>
        <h3>Datos del Perfil</h3>
        <?php if (!empty($estudiante['avatar'])): ?>
            <img src="../../../public/<?= htmlspecialchars($estudiante['avatar']) ?>" alt="Avatar" width="120">
        <?php endif; ?>
        <ul>
            <li><strong>Carrera:</strong> <?= htmlspecialchars($estudiante['carrera']) ?></li>
            <li><strong>Semestre:</strong> <?= htmlspecialchars($estudiante['semestre'] ?? 'No especificado') ?></li>
            <li><strong>Matrícula:</strong> <?= htmlspecialchars($estudiante['matricula'] ?? 'No especificada') ?></li>
            <li><strong>Fecha de nacimiento:</strong> <?= htmlspecialchars($estudiante['fecha_nacimiento'] ?? 'No especificada') ?></li>
    <?php else: ?>
        <p>No se encontró información de perfil para este usuario.</p>
    <?php endif; ?>

<ul>
    <li><a href="/cursos">Ver mis cursos</a></li>
    <li><a href="#">Subir archivos</a></li>
    <li><a href="/logout">Cerrar sesión</a></li>
</ul>