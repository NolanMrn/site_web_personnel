<?php
include 'connexion_bd.php';
include 'fonctions.php';

if (isset($_GET['categorie'])) {
    $categorie = $_GET['categorie'];
} else {
    die(header('Location: /404.php'));
}

$description = getDescription($conn, $categorie);
$lieux = getAllLieuxCategorie($conn, $categorie);
$nbLieux = $lieux->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/site_web/css/categorie/positionnement.css">
    <link rel="stylesheet" type="text/css" href="/site_web/css/categorie/styles.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <section class="explos">
                <?php 
                printf('<h1>Catégorie : %s</h1>', htmlspecialchars($categorie));
                printf('<p>%s</p>', htmlspecialchars($description));
                ?>
                <section class="explos_photos">
                    <?php
                    while ($lieu = $lieux->fetch_assoc()) {
                        $cheminImg = htmlspecialchars(getImageBanniere($conn, $lieu["idL"], $categorie));
                        $pays = htmlspecialchars(getPays($conn, $lieu["idL"], $categorie));
                        $nom = htmlspecialchars($lieu["nom"]);
                        $annee = htmlspecialchars(substr($lieu["date_explo"], 0, 4));
                        $moisChiffre = htmlspecialchars(substr($lieu["date_explo"], 5, 2));
                        $slug = htmlspecialchars($lieu["slug"]);
                        $lienUrl = htmlspecialchars(
                            "/site_web/php/lieu_indiv.php?slug={$slug}&categorie={$categorie}");
                        
                        echo "<article>
                                <img src=\"{$cheminImg}\" alt=\"\">
                                <div class=\"content\">
                                    <article>
                                        <div>
                                            <hr class=\"trait-blanc\">
                                            <h2>{$nom}</h2>
                                            <hr class=\"trait-blanc\">
                                        </div>
                                        <div>
                                            <img src=\"/site_web/img/accueil/drapeau_{$pays}.png\" alt=\"\">
                                            <p>{$moisChiffre}/{$annee}</p>
                                        </div>
                                    </article>
                                    <a href=\"{$lienUrl}\">
                                        <div>
                                            <p>Découvrir</p>
                                        </div>
                                    </a>
                                </div>
                            </article>";
                    }
                    $reste = $nbLieux % 3;
                    if ($reste == 0) {
                        $nbAjouter = 0;
                    } else {
                        $nbAjouter = 3 - $reste;
                    }
                    for ($i = 0; $i < $nbAjouter; $i++) {
                        printf("<article style=\"background-color: #222222;\"></article>");
                    }
                    ?>
                </section>
            </section>
        </div>
    </main>
</body>
</html>