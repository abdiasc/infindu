<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($title ?? 'Mi App') ?></title>
    <link rel="stylesheet" href="/../public/css/style.css" />
    <link rel="stylesheet" href="/../public/css/iconos.css" />
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <main>
        <?= $content ?>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tarjetas = document.querySelectorAll('.tarjeta-curso:not(.inscrito)');
    const inputCurso = document.getElementById('curso_id');
    const boton = document.getElementById('btnInscribirse');

    tarjetas.forEach(tarjeta => {
        tarjeta.addEventListener('click', function () {
            tarjetas.forEach(t => t.classList.remove('seleccionado'));

            this.classList.add('seleccionado');
            inputCurso.value = this.dataset.cursoId;
            boton.disabled = false;
        });
    });
});

</script>

    
</body>
</html>
