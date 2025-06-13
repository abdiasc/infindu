
<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-estudiante.php'; ?>
    <div class="panel">
        <div class="admin-usuarios">
            <h2>Panel del Estudiante</h2>
            <p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></p>

            <?php if (!empty($mostrarAlerta)): ?>
                <div style="background-color: #ffeeba; color: #856404; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ffeeba;">
                    <strong>¡Perfil Incompleto!</strong> Aún no has completado tu registro como estudiante. 
                    <a href="/perfil/completar_estudiante" style="text-decoration: underline; color: #856404;">Haz clic aquí para completarlo</a>.
                </div>
            <?php endif; ?>
            
        </div>
    </div>
</div>
