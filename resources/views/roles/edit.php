


<div class="contenido">
    <?php include __DIR__ . '/../partials/sidebar-admin.php'; ?>

    <div class="panel">
        <div class="admin-usuarios">
            <h2><?= $title ?></h2>
            <form class="frm-create"  method="POST" action="/roles/edit/<?= $rol['id'] ?>">
                <label for="nombre">Nombre del rol:</label><br>
                <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($rol['nombre']) ?>" required>
                <br><br>
                <button type="submit">Actualizar</button>
                <a class="btn-cancelar" href="/admin/roles" >Cancelar</a>
            </form>


        </div>

        
    </div>
</div>
</div>