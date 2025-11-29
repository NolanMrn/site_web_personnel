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
$nomComplet = htmlspecialchars($lieu["nom"]);
$motsSepares = explode(' ', $nomComplet);
$motOrange = end($motsSepares);
$motStylise = '<span class="orange">' . $motOrange . '</span>';
$titreFinal = str_replace($motOrange, $motStylise, $nomComplet);

$pays = getPays($conn, $lieu["idL"], $lieu["nom_categorie"]);
$date = getDateFormate($lieu["date_explo"]);
$structure = getStructure($conn, $lieu["idL"], $lieu["nom_categorie"]);
$histoireLieux = getHistoireLieux($conn, $lieu["idL"], $lieu["nom_categorie"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/individuel.css">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/header.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/public/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <section class="retour">
                <a class="back-button" href="/site_web/public/php/galerie.php">← Retour à la galerie</a>
            </section>
            <section class="histoire">
                <div class="titre">
                    <div>
                        <?php
                            printf('<h1>%s</h1>', $titreFinal);
                            printf(
                                '<img src="/site_web/public/img/accueil/drapeau_%s.png" alt="drapeau %s">',
                                htmlspecialchars($pays),
                                htmlspecialchars($pays)
                            );
                        ?>
                    </div>
                    <?php
                    printf('<p>Date de l’exploration : <span class="orange">%s</span></p>', htmlspecialchars($date));
                    ?>
                </div>
                <?php
                printf('<p>%s</p>', nl2br(htmlspecialchars($histoireLieux)));
                ?>
            </section>
            <section class="exploration">
                <?php
                while ($bloc = $structure->fetch_assoc()) {
                    if ($bloc["types"] === "paragraphe") {
                        printf('<p>%s</p>', nl2br(htmlspecialchars(getParagraphe($conn, $bloc["ref"]))));
                    }   else if ($bloc["types"] === "galerie"){
                        $images = getImageGalerie($conn, $bloc["ref"]);
                        foreach ($images as $img) {
                            $cheminPhysique = $_SERVER['DOCUMENT_ROOT'] . $img['chemin'];
                            if (!file_exists($cheminPhysique)) {
                                $cheminImg = "/site_web/public/img/accueil/image_defaut.png";
                            } else {
                                $cheminImg = $img['chemin'];
                            }
                            printf(
                                '<article class="%s"><img src="%s" alt="%s"></article>',
                                htmlspecialchars($img['cadrage']),
                                htmlspecialchars($cheminImg),
                                htmlspecialchars("image de l'exploration")
                            );
                        }
                    }
                }
                ?>
            </section>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="/site_web/public/js/animation.js"></script>
    <script src="/site_web/public/js/responsive.js"></script>
</body>
</html>