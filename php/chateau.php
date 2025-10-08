<?php
include 'connexion_bd.php';
include 'fonctions.php';

if (isset($_GET['slug']) && (isset($_GET['categorie']))) {
    $slug = $_GET['slug'];
    $categorie = $_GET['categorie'];
} else {
    die("Slug ou categorie pas dans l'url.");
}

$statement = $conn->prepare('SELECT * FROM LIEUX WHERE slug = ? AND nom_categorie = ?');
$statement->bind_param("ss", $slug, $categorie);
$statement->execute();
$result = $statement->get_result();
$lieu = $result->fetch_assoc(); 

if ($lieu) {
    $annee = substr($lieu["date_explo"], 0, 4);
    $moisChiffre = substr($lieu["date_explo"], 5, 2);
    $moisLettre = getMoisFr($moisChiffre);
    $histoireLieux = getHistoireLieux($conn, $lieu["idL"], $lieu["nom_categorie"]);
    $structure = getStrucure($conn, $lieu["idL"], $lieu["nom_categorie"]);
} else {
    die ("<p>Lieu introuvable 😕</p>");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="/site_web/css/individuel/positionnement.css">
    <link rel="stylesheet" type="text/css" href="/site_web/css/individuel/styles.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/img/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    include 'header.php';
    ?>
    <main>
        <div class="container">
            <section class="histoire">
                <div class="titre">
                    <?php
                    echo "<h1>{$lieu["nom"]}</h1>";
                    ?>
                    <img src="/site_web/img/accueil/drapeau_francais.png" alt="">
                    <?php
                    echo "<p>Date de l’exploration : {$moisLettre} {$annee}</p>";
                    ?>
                </div>
                <?php
                echo "<p>{$histoireLieux}</p>";
                ?>
            </section>
            <section class="exploration">
                <?php
                while ($bloc = $structure->fetch_assoc()) {
                    if ($bloc["types"] == "paragraphe") {
                        $result = getParagraphe($conn, $bloc["ref"]);
                        $paragraphe = $result->fetch_assoc();
                        echo "<p>{$paragraphe["paragraphe"]}</p>";
                    }
                    else if ($bloc["types"] == "galerie"){

                        $images = getImageGalerie($conn, $bloc["ref"]);
                        while ($img = $images->fetch_assoc()) {

                            $chemin = $img["chemin"];
                            $cadrage = $img["cadrage"];
                            echo "<article class=\"$cadrage\">
                                    <img src=\"$chemin\" alt=\"\">
                                </article>";
                        }
                    }
                }
                ?>
            </section>
        </div>
    </main>
</body>

</html>
