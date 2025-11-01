<?php
include 'connexion_bd.php';
include 'fonctions.php';

$lieux = getAllLieux($conn);
$nbLieux = $lieux->num_rows;
$categories = getAllCategories($conn);
$allPays = getAllPays($conn);
$AllAnnees = getAllAnnees($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/site_web/css/galerie/galerie.css">
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
            <section class="block">
                <nav class="filtre">
                    <section class="haut">
                        <p>Filtres</p>
                        <button id="btn_croix" type="button" class="btn_croix"></button>
                    </section>
                    <form class="recherche">
                        <button id="btn_recherche" type="button" class="btn_recherche"></button>
                        <input id="recherche_case" type="text" class="recherche_case" placeholder="Rechercher un lieu précis...">
                    </form>
                    <article data-filtre="categorie">
                        <p>Par <span class="orange">catégorie</span> :</p>
                        <ul>
                            <?php
                            while ($cat = $categories->fetch_assoc()) {
                                printf('<li><button class="btn_filtre" id="%s">%s</button></li>', 
                                    htmlspecialchars($cat['nom_categorie']),
                                    htmlspecialchars($cat['nom_categorie'])
                                );
                            }
                            ?>
                        </ul>
                    </article>
                    <article  data-filtre="pays">
                        <p>Par <span class="orange">pays</span> :</p>
                        <ul>
                            <?php
                            while ($p = $allPays->fetch_assoc()) {      
                                printf('<li><button class="btn_filtre" id="%s">%s</button></li>',
                                    htmlspecialchars($p['pays']),
                                    htmlspecialchars($p['pays'])
                                );
                            }
                            ?>
                        </ul>
                    </article>
                    <article  data-filtre="annee">
                        <p>Par <span class="orange">années</span> :</p>
                        <ul>
                            <?php
                            foreach ($AllAnnees as $a) {
                                printf('<li><button class="btn_filtre" id="%s">%s</button></li>',
                                    htmlspecialchars($a),
                                    htmlspecialchars($a),
                                );
                            }
                            ?>
                        </ul>
                    </article>
                </nav>
                <section class="explos_photos">
                    <h1 class="resultat_recherche"></h1>
                    <?php
                    while ($lieu = $lieux->fetch_assoc()) {
                        $categorie = htmlspecialchars($lieu["nom_categorie"]);
                        $cheminImg = htmlspecialchars(getImageBanniere($conn, $lieu["idL"], $categorie));
                        $cheminPhysique = $_SERVER['DOCUMENT_ROOT'] . $cheminImg;
                        if (!file_exists($cheminPhysique)) {
                            $cheminImg = "/site_web/img/accueil/image_defaut.png";
                        }
                        $pays = htmlspecialchars(getPays($conn, $lieu["idL"], $categorie));
                        $nom = htmlspecialchars($lieu["nom"]);
                        $annee = htmlspecialchars(substr($lieu["date_explo"], 0, 4));
                        $moisChiffre = htmlspecialchars(substr($lieu["date_explo"], 5, 2));
                        $slug = htmlspecialchars($lieu["slug"]);
                        $lienUrl = htmlspecialchars(
                            "/site_web/php/lieu_indiv.php?slug={$slug}&categorie={$categorie}");
                        ?>
                        <article class="unLieu" data-categorie="<?php echo $categorie ?>" data-pays="<?php echo $pays ?>" data-annee="<?php echo $annee ?>">
                            <img src="<?php echo $cheminImg ?>" alt="">
                            <div class="content">
                                <article>
                                    <div>
                                        <hr class="trait-blanc">
                                        <h2><?php echo $nom ?></h2>
                                        <hr class="trait-blanc">
                                    </div>
                                    <div>
                                        <img src="/site_web/img/accueil/drapeau_<?php echo $pays ?>.png" alt="">
                                        <p><?php echo $moisChiffre ?>/<?php echo $annee ?></p>
                                    </div>
                                </article>
                                <a href="<?php echo $lienUrl ?>">
                                    <div>
                                        <p>Découvrir</p>
                                    </div>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                    ?>
                </section>
            </section>
        </div>
    </main>
    <?php include 'footer.php'; ?>
    <script src="/site_web/js/galerie.js"></script>
</body>
</html>