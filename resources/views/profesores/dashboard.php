
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

            <div class="cursos-asignados">
                <h2>Cursos Asignados</h2>
                <div class="tarjetas-cursos">
                    <?php if (!empty($cursosAsignados)): ?>
                    <?php foreach ($cursosAsignados as $curso): ?>
                        <div class="curso-tarjeta">
                            <div class="tarjeta-head">
                                <h3><?= htmlspecialchars($curso['nombre']) ?></h3>
                                <p><?= htmlspecialchars($curso['nivel']) ?></p>
                                <img src="/public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Portada" class="img-curso-portada">
                            </div>
                            <div class="tarjeta-body">
                                <p><strong><span class="icon-calendar_today"> </span>Inicio </strong> <small class="fecha-inicio"><?= htmlspecialchars($curso['fecha_inicio']) ?></small> </p>
                                <p><strong><span class="icon-date_range"> </span>Fin </strong> <small class="fecha-fin"><?= htmlspecialchars($curso['fecha_fin']) ?></small></p>
                                <p><strong><span class="icon-verified"></span></strong> <?= htmlspecialchars($curso['estado']) ?></p>
                            </div>
                            <hr>
                            <div class="acciones">
                                <a class="btn-ver" href="/profesor/curso/<?= htmlspecialchars($curso['id']) ?>"> <span class="icon-text_snippet"></span> Ver Curso</a>
                                <a href="/profesor/curso/<?= $curso['id'] ?>/estudiantes">Ver Estudiantes</a>
                                <a class="btn-agregar-leccion" href="/profesor/curso/eliminar/<?= htmlspecialchars($curso['id']) ?>"> <span class="icon-post_add"></span> Agregar leccion</a>
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













