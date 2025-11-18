<?php
require_once __DIR__ . '/../connexion_bd.php';
require_once __DIR__ . '/../fonctions.php';

$allLieux = getAllLieux($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/admin/admin.css">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/header/header.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/public/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../header.php'; ?>
    <main>
        <div class="container">
            <section class="block anim_section">
                <h1>Supprimer un <span class="orange">lieu</span></h1>
                <form method="POST" action="save_lieu.php">
                    <input type="hidden" name="action" value="supprimer">
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
    <script src="/site_web/public/js/animation.js"></script>
</body>
</html>