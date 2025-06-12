






<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2><?= $title ?></h2>
            <p>Crear nuevo rol de usuario</p>
            <form class="frm-create"  method="POST" action="/roles/store">
                <label for="nombre">Nombre del rol:</label><br>
                <input type="text" name="nombre" id="nombre" required>
                <br><br>
                <button type="submit">Guardar</button>
                <a class="btn-cancelar" href="/admin/roles" >Cancelar</a>
            </form>
            <a href="/admin/roles">← Volver</a>

            

        </div>

        
    </div>
</div>
</div>