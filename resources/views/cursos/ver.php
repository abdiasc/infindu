<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="panel-detalle">


            <div class="panel-detalle-header">
                <a href="/admin/cursos" class="btn-volver">← Volver</a>
            </div>

            <div class="panel-detalle-contenido">
                <div class="portada">
                    <div class="img-portada">
                        <?php if (!empty($curso['imagen_portada'])): ?>
                            <img src="/public/<?= htmlspecialchars($curso['imagen_portada']) ?>" alt="Portada" class="img-curso-portada">
                        <?php endif; ?>
                    </div>
                    <div class="asignar-profesor">
                        <h3>Asignar Profesor al Curso</h3>
                        <form action="/admin/curso/asignar-profesor" method="POST">
                            <input type="hidden" name="curso_id" value="<?= $curso['id'] ?>">

                            <label for="profesor_id">Selecciona un profesor:</label>
                            <select class="seleccionar-profesor" name="profesor_id" id="profesor_id" required>
                                <?php foreach ($profesores as $prof): ?>
                                    <option value="<?= $prof['id'] ?>"><?= htmlspecialchars($prof['nombre']) ?></option>
                                <?php endforeach; ?>
                            </select>

                            <button type="submit" class="btn-asignar-profesor">Asignar</button>
                        </form>
                    </div>
                    <div class="formulario-leccion">
                        <h3>Agregar nueva lección</h3>
                        <form action="/admin/lecciones/crear" method="POST">
                            <input type="hidden" name="curso_id" value="<?= htmlspecialchars($curso['id']) ?>">

                            <label for="titulo">Título:</label><br>
                            <input type="text" id="titulo" name="titulo" required><br>

                            <label for="contenido">Contenido:</label><br> 
                            <textarea id="contenido" name="contenido" required></textarea><br>                

                            <label for="url_video">URL del Video (opcional):</label><br>
                            <input type="text" id="url_video" name="url_video"><br>

                            <label for="orden">Orden:</label><br>
                            <input type="number" id="orden" name="orden" value="1" min="1"><br>

                            <button class="btn-add-clase" type="submit">Guardar Lección</button>
                        </form>
                    </div>


                </div>
                <div class="detalles">
                    <h3 class="titulo-curso"><?= htmlspecialchars($curso['nombre']) ?></h3>
                    <p class="descripcion-curso"><?= nl2br(htmlspecialchars($curso['descripcion'])) ?></p>
                    <div class="detalle-tarjetas">
                        <div class="tarjeta-detalle">
                            <strong><span class="icon-category"></span></strong> <?= htmlspecialchars($curso['categoria']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-school"></span></strong> <?= htmlspecialchars($curso['nivel']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-av_timer"></span></strong> <?= htmlspecialchars($curso['duracion']) ?> horas
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-date_range"></span></strong> <?= htmlspecialchars($curso['fecha_inicio']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-date_range"></span></strong> <?= htmlspecialchars($curso['fecha_fin']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-person_add_alt_1"></span></strong> <?= htmlspecialchars($curso['cupo_maximo']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-public"></span></strong> <?= htmlspecialchars($curso['visibilidad']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-library_books"></span></strong> <?= htmlspecialchars($curso['estado']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-supervised_user_circle"></span></strong> <?= htmlspecialchars($curso['creador']) ?>
                            </div>
                            <div class="tarjeta-detalle">
                                <strong><span class="icon-calendar_today"></span></strong> <?= htmlspecialchars($curso['fecha_creacion']) ?>
                            </div>
                        </div>
                    </div>
            </div>


            

            <div class="lecciones-curso">
                <h3>Lecciones del Curso</h3>
                <div class="lista-lecciones">
                    <?php foreach ($lecciones as $leccion): ?>
                        <div class="tarjeta-leccion">
                            <h4><?= htmlspecialchars($leccion['titulo']) ?></h4>
                            <p><?= nl2br(htmlspecialchars($leccion['contenido'])) ?></p>
                            <span class="fecha-leccion"><?= htmlspecialchars($leccion['url_video']) ?></span>
                        
                            <div class="acciones">
                                <a href="/lecciones/editar/<?= $leccion['id'] ?>" class="btn-editar">Editar lección</a>
                                
                                <a href="/lecciones/eliminar/<?= $leccion['id'] ?>/<?= $curso['id'] ?>" 
                                class="btn-eliminar" 
                                onclick="return confirm('¿Estás seguro de eliminar esta lección?')">
                                    Eliminar lección
                                </a>
                                
                                <a href="/lecciones/curso/<?= $curso['id'] ?>" class="btn-detalle">Detalle lección</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="profesor-asignado">
                    <div class="profesor-avatar">
                        <?php if (!empty($profesorAsignado) && !empty($profesorDatos)): ?>
                            <img src="../../../public/<?= htmlspecialchars($profesorDatos['avatar']) ?>" alt="Avatar" width="120">
                        <?php else: ?>
                            <p>No image</p>
                        <?php endif; ?>
                    </div>
                    <div class="profesor-datos">
                        
                        <h4>Profesor asignado</h4>
                        <?php if (!empty($profesorAsignado) && !empty($profesorDatos)): ?>
                            
                            <ul>
                                <li><strong>Nombre:</strong> <?= htmlspecialchars($profesorAsignado['nombre'] ?? '') ?></li>
                                <li><strong>Correo:</strong> <?= htmlspecialchars($profesorAsignado['email'] ?? '') ?></li>
                                <li><strong>Especialidad:</strong> <?= htmlspecialchars($profesorDatos['especialidad']) ?></li>
                                <li><strong>Título Académico:</strong> <?= htmlspecialchars($profesorDatos['titulo_academico']) ?></li>
                                <li><strong>Años de experiencia:</strong> <?= htmlspecialchars($profesorDatos['experiencia_anios']) ?></li>
                                <li><strong>Fecha de Ingreso:</strong> <?= date('d/m/Y', strtotime($profesorDatos['fecha_ingreso'])) ?></li>
                                <li><strong>Biografía:</strong> <br><?= nl2br(htmlspecialchars($profesorDatos['biografia'])) ?></li>
                            </ul>
                        <?php else: ?>
                            <p>No hay un profesor asignado actualmente a este curso.</p>
                        <?php endif; ?>
                
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
