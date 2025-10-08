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
                <p>On remarque, en arrivant sur les lieux, que la végétation a repris ses droits depuis longtemps. Un ancien bassin 
                    entoure le château, et plusieurs dépendances se trouvent sur le domaine, sans présenter un grand intérêt.</p>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image1.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image2.jpeg" alt="">
                </article>
                <article class="horizontal">
                    <img src="/site_web/img/chateaux/bois/image3.jpeg" alt="">
                </article>
                <p>Dans le château, on ne trouve presque aucun tag ni trace de vandalisme ; le lieu semble seulement avoir été marqué par 
                    le temps. Le plafond s’effrite et l’ensemble est très dégradé. Les pièces sont vides, à l’exception de deux anciennes 
                    machines qui servaient probablement à l’époque au vétérinaire. Celle située à droite est un tarare, utilisé autrefois 
                    pour nettoyer le grain.</p>
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
                <p>Un seul escalier permet d’accéder à l’étage du château. Malheureusement, une fois arrivé en haut, il est impossible 
                    d’avancer davantage en raison du plancher qui s’est effondré à plusieurs endroits.</p>
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
