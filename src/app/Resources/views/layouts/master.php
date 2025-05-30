<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">My App</a>
    </div>
</nav>

<main class="container">
    <?= $content ?>
</main>

<footer class="bg-light text-center py-3 mt-5">
    <small>© <?= date('Y') ?> My Company</small>
</footer>
</body>
</html>
