<?php
require_once 'connexion_bd.php';
require_once 'fonctions.php';


if (isset($_GET['slug']) && (isset($_GET['categorie']))) {
    $slug = $_GET['slug'];
    $categorie = $_GET['categorie'];
} else {
    die(header('Location: /404.php'));
}

$lieu = getLieu($conn, $slug, $categorie);
if (!$lieu) {
    header('Location: /404.php');
    exit;
}

$nom = $lieu["nom"];
$pays = getPays($conn, $lieu["idL"], $lieu["nom_categorie"]);
$date = getDateFormate($lieu["date_explo"]);
$structure = getStructure($conn, $lieu["idL"], $lieu["nom_categorie"]);
$histoireLieux = getHistoireLieux($conn, $lieu["idL"], $lieu["nom_categorie"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/site_web/css/individuel/individuel.css">
    <link rel="stylesheet" type="text/css" href="/site_web/css/header/header.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <section class="histoire">
                <div class="titre">
                    <?php
                    printf('<h1>%s</h1>', htmlspecialchars($nom));
                    printf(
                        '<img src="/site_web/img/accueil/drapeau_%s.png" alt="drapeau %s">',
                        htmlspecialchars($pays),
                        htmlspecialchars($pays)
                    );
                    printf('<p>Date de l’exploration : %s</p>', htmlspecialchars($date));
                    ?>
                </div>
                <?php
                printf('<p>%s</p>', htmlspecialchars($histoireLieux));
                ?>
            </section>
            <section class="exploration">
                <?php
                while ($bloc = $structure->fetch_assoc()) {
                    if ($bloc["types"] === "paragraphe") {
                        printf('<p>%s</p>', htmlspecialchars(getParagraphe($conn, $bloc["ref"])));
                    }   else if ($bloc["types"] === "galerie"){
                        $images = getImageGalerie($conn, $bloc["ref"]);
                        foreach ($images as $img) {
                            printf(
                                '<article class="%s"><img src="%s" alt="%s"></article>',
                                htmlspecialchars($img['cadrage']),
                                htmlspecialchars($img['chemin']),
                                htmlspecialchars("image de l'exploration")
                            );
                        }
                    }
                }
                ?>
            </section>
        </div>
    </main>
</body>
</html>