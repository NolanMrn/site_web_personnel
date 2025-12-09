<?php

$admin = false;
if (isset($_SERVER['PHP_AUTH_USER'])) {
    $admin = true;
}

require_once __DIR__ . '/../connexion_bd.php';
require_once __DIR__ . '/../fonctions.php';

$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    include 'save_lieu.php';
}

$allLieux = getAllLieux($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
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
            <section class="block anim_section">
                <h1>Supprimer un <span class="orange">lieu</span></h1>
                <form method="POST">
                    <input type="hidden" name="action" value="supprimer">
                    <div class="form-group">
                        <label></label>
                        <?php 
                        if (!empty($success)) {
                            echo "<p class='success'>$success</p>";
                        } elseif (!empty($error)) {
                            echo "<p class='error'>$error</p>";
                        } else {
                            echo "<p></p>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="lieu">Liste des Lieux :</label>
                        <select id="lieu" name="lieu" required>
                            <option value="" disabled selected></option>
                            <?php
                            while ($lieu = $allLieux->fetch_assoc()) {
                                $categorie = htmlspecialchars($lieu["nom_categorie"]);
                                $nom = htmlspecialchars($lieu['nom']);
                                $slug = htmlspecialchars($lieu["slug"]);
                                printf(
                                    '<option value="%s|%s">%s (catégorie = %s / slug = %s)</option>',
                                    $slug, $categorie, $nom, $categorie, $slug
                                );
                            }
                            ?>
                        </select>
                    </div>
                     <div class="form-group">
                        <div></div>
                        <button type="submit" class="btn-enregistrer">Supprimer</button>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <?php include '../footer.php'; ?>
    <script src="/js/animation.js"></script>
</body>
</html>