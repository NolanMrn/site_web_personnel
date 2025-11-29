<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/gestionAdmin.css">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/header.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/public/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../header.php'; ?>
    <main>
        <div class="container">
            <section class="anim_section">
                <article class="titre">
                    <h1>Bienvenue sur la page <span class="orange">Admin</span></h1>
                </article>
                <article class="btn">
                    <ul>
                        <li>
                            <a href="/site_web/public/php/admin/AjouterLieuAdmin.php">Ajouter un lieu</a>
                        </li>
                        <li>
                            <a href="/site_web/public/php/admin/ModifierLieuAdmin.php">Modifier un lieu</a>
                        </li>
                        <li>
                            <a href="/site_web/public/php/admin/SupprimerLieuAdmin.php">Supprimer un lieu</a>
                        </li>
                    </ul>
                </article>
            </section>
        </div>
    </main>
    <?php include '../footer.php'; ?>
    <script src="/site_web/public/js/animation.js"></script>
</body>
</html>