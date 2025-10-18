<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title ?? 'Accueil', ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
    <h1>Bienvenue sur Chocoblast</h1>
    <p>Bonjour <?= htmlspecialchars($user ?? 'anonymous', ENT_QUOTES, 'UTF-8') ?> !</p>

    <p>Cette page est rendue via <code>AbstractController::render()</code> et le service <code>Logger</code> écrit dans <code>info.log</code>.</p>
</body>
</html>

