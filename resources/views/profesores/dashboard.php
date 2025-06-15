
<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-profesor.php'; ?>
    <div class="panel">
        <div class="admin-usuarios">
            <h2>Panel del Profesor</h2>
            <p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> (Profesor)</p>

            <?php if (!empty($mostrarAlerta)): ?>
                <div style="background-color: #ffeeba; color: #856404; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ffeeba;">
                    <strong>¡Perfil Incompleto!</strong> Aún no has completado tu registro como profesor. 
                    <a href="/perfil/completar" style="text-decoration: underline; color: #856404;">Haz clic aquí para completarlo</a>.
                </div>
            <?php endif; ?>

            <div class="cursos">
                <h2>Cursos Asignados</h2>
                <div class="tarjetas">
                    <?php if (!empty($cursosAsignados)): ?>
                    <?php foreach ($cursosAsignados as $curso): ?>
                        <div class="tar-curso" style="background-image: url('/public<?= htmlspecialchars($curso['imagen_portada']) ?>');">
                            <div class="overlay"></div>
                            <div class="contenido">
                                <p class="nivel"><?= htmlspecialchars($curso['nivel']) ?></p>
                                <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                                <p><strong><span class="icon-verified"></span></strong> <?= htmlspecialchars($curso['estado']) ?></p>
                                <p><a href="/profesor/curso/<?= htmlspecialchars($curso['id']) ?>"> <span class="icon-text_snippet"></span> Ver Curso</a></p>
                                <p><a href="/profesor/curso/<?= $curso['id'] ?>/estudiantes">Estudiantes</a></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                
                    <?php else: ?>
                        <p>No tienes cursos asignados aún.</p>
                    <?php endif; ?>

                </div>
                
            </div>


            

            
        </div>
    </div>
</div>













