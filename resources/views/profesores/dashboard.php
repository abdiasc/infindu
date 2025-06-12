<h2>Panel del Profesor</h2>
<p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> (Profesor)</p>

<?php if (!empty($mostrarAlerta)): ?>
    <div style="background-color: #ffeeba; color: #856404; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ffeeba;">
        <strong>¡Perfil Incompleto!</strong> Aún no has completado tu registro como profesor. 
        <a href="/perfil/completar" style="text-decoration: underline; color: #856404;">Haz clic aquí para completarlo</a>.
    </div>
<?php endif; ?>

<?php if ($profesor): ?>
    <h3>Datos del Perfil</h3>
    <?php if (!empty($profesor['avatar'])): ?>
        <img src="../../../public/<?= htmlspecialchars($profesor['avatar']) ?>" alt="Avatar" width="120">
    <?php endif; ?>
    <ul>
        <li><strong>Especialidad:</strong> <?= htmlspecialchars($profesor['especialidad']) ?></li>
        <li><strong>Título Académico:</strong> <?= htmlspecialchars($profesor['titulo_academico'] ?? 'No especificado') ?></li>
        <li><strong>Años de experiencia:</strong> <?= htmlspecialchars($profesor['experiencia_anios'] ?? 'No especificado') ?></li>
        <li><strong>Fecha de ingreso:</strong> <?= htmlspecialchars($profesor['fecha_ingreso'] ?? 'No especificado') ?></li>
        <li><strong>Biografía:</strong> <br><?= nl2br(htmlspecialchars($profesor['biografia'] ?? 'No especificada')) ?></li>
    </ul>
<?php else: ?>
    <p>No se encontró información de perfil para este usuario.</p>
<?php endif; ?>

<ul>
    <li><a href="/cursos">Ver mis cursos</a></li>
    <li><a href="#">Subir archivos</a></li>
    <li><a href="/logout">Cerrar sesión</a></li>
</ul>