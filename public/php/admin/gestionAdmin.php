<?php 

$admin = false;
if (isset($_SERVER['PHP_AUTH_USER'])) {
    $admin = true;
}
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/gestionAdmin.css">
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <?php 
    if ($admin) { ?>
        <title>Exploratio_nln Admin</title>
        <?php 
    } else { ?>
        <title>Exploratio_nln</title>
        <?php 
    }     
    ?>
    <link rel="icon" type="image/PNG" href="/img/accueil/photo_profil.png">
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
                            <a href="/php/admin/AjouterLieuAdmin.php">Ajouter un lieu</a>
                        </li>
                        <li>
                            <a href="/php/admin/ModifierLieuAdmin.php">Modifier un lieu</a>
                        </li>
                        <li>
                            <a href="/php/admin/SupprimerLieuAdmin.php">Supprimer un lieu</a>
                        </li>
                    </ul>
                </article>
            </section>
        </div>
    </main>
    <?php include '../footer.php'; ?>
    <script src="/js/animation.js"></script>
</body>
</html>