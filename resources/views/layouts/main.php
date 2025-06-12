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
</body>
</html>
