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
    $paragraphes = [];
    for ($i = 1; $i <= 5; $i++) {
        $paragraphes[$i] = getParagraphe($conn, $lieu["idL"], $lieu["nom_categorie"], $i);
    }
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
    <header>
        <h1>Exploratio_nln</h1>
        <nav>
            <ul class="menu">
                <li><a href="/site_web/pages/accueil.html">Accueil</a></li>
                <li class="has-sous_menu"><a href="">Catégorie</a>
                    <ul class="sous_menu">
                        <li><a href="/site_web/pages/administratifs.html">Administratif</a></li>
                        <li><a href="/site_web/pages/chateaux.html">Château</a></li>
                        <li><a href="/site_web/pages/hopitaux.html">Hôpital</a></li>
                        <li><a href="/site_web/pages/loisirs.html">Loisir</a></li>
                        <li><a href="/site_web/pages/maisons.html">Maison</a></li>
                        <li><a href="/site_web/pages/militaires.html">Militaire</a></li>
                        <li><a href="/site_web/pages/religieux.html">Religieux</a></li>
                        <li><a href="/site_web/pages/usines.html">Usine</a></li>
                    </ul>
                </li>
                <li class="has-sous_menu"><a href="">Pays</a>
                    <ul class="sous_menu">
                        <li><a href="">France</a></li>
                        <li><a href="">Belgique</a></li>
                    </ul>
                </li>
                <li><a href="">Boutique</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </nav>
        <div class="search">
            <form class="search">
                <input type="text" name="text" class="search2" placeholder=" Rechercher...">
                <input type="submit" name="submit" class="submit" value="search">
            </form>
        </div>
    </header>
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
                    echo "<p>{$paragraphes[1]}</p>";
                    ?>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image1.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image2.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image3.jpeg" alt="">
                </article>
                <?php
                    echo "<p>{$paragraphes[2]}</p>";
                    ?>
                <article class="vertical">
                    <img src="/site_web/img/chateaux/bois/image4.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image5.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image6.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image7.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image8.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image9.jpeg" alt="">
                </article>
                <?php
                    echo "<p>{$paragraphes[3]}</p>";
                    ?>
                <article class="vertical">
                    <img src="/site_web/img/chateaux/bois/image10.jpeg" alt="">
                </article>
                <article class="vertical">
                    <img src="/site_web/img/chateaux/bois/image11.jpeg" alt="">
                </article>
                <article class="vertical">
                    <img src="/site_web/img/chateaux/bois/image12.jpeg" alt="">
                </article>
            </section>
        </div>
    </main>
</body>

</html>
