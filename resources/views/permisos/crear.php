<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2>Crear Permiso</h2>

            <form class="frm-create" action="/permisos/guardar" method="POST">
                <label for="nombre">Nombre del permiso:</label><br>
                <input type="text" id="nombre" name="nombre" required><br><br>

                <label for="descripcion">Descripción:</label><br>
                <textarea id="descripcion" name="descripcion" rows="4" cols="50"></textarea><br><br>

                <button type="submit">Guardar</button>
                <a class="btn-cancelar" href="/admin/permisos" >Cancelar</a>
            </form>

        </div>

        
    </div>
</div>
</div>