<?php
require_once '../../connexion_bd.php';
require_once 'fonctions.php';

$troisDerniersLieux = getTroisDernierslLieux($conn);
$nbLieux = $troisDerniersLieux->num_rows;

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/accueil.css">
        <link rel="stylesheet" type="text/css" href="/css/header.css">
        <title>Exploratio_nln</title>
        <link rel="icon" type="image/PNG" href="/img/accueil/photo_profil.png">
        <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <main>
            <section class="photo_acc">
                <div class="overlay"></div>
                <article>
                    <h1>Explorer pour perdurer</h1>
                    <a href="/php/galerie.php">
                        <div>
                            <p>Voir la galerie</p>
                        </div>
                    </a>
                </article>
            </section>
            <div class="parent">
                <div class="container">
                    <section class="def_urbex anim_section">
                        <h1>L'<span class="orange">urbex</span> qu'est ce que c'est ?</h1>
                        <p>L'urbex, abréviation de l'anglais « urban exploration » (exploration urbaine), est une
                            pratique qui consiste à visiter et à documenter des lieux construits et abandonnés par
                            l’homme. Ces sites peuvent être des friches industrielles, d’anciennes usines, des entrepôts,
                            mais aussi des châteaux, des villas ou des hôpitaux désaffectés.</p>
                        <p>Les explorateurs urbains respectent un code strict, dont l'une des règles fondamentales est
                            de ne jamais révéler la localisation exacte des lieux visités afin de les préserver de la
                            dégradation et du pillage.</p>
                        <p>Pour moi, l'exploration est un moyen de faire perdurer l'histoire de ces lieux, de ne pas les
                            oublier, et de les immortaliser grâce à la photographie.</p>
                    </section>
                    <section class="def_site anim_section">
                        <h1>Un lieu d'<span class="orange">images</span>, pas d'adresses</h1>
                        <p>Ce site a pour but de vous partager mes clichés capturées au cours de mes explorations. C'est une 
                            vitrine photographique. Nous nous engageons fermement à respecter l'éthique Urbex : nous ne
                            partageons aucune adresse et condamnons toute dégradation.</p>
                        <p>Notre unique mission est de documenter l'histoire de ces lieux, sans jamais compromettre leur intégrité
                            ou leur tranquillité.</p>
                    </section>
                    <section class="explos_recentes anim_section">
                        <article class="voir_plus">
                            <?php
                            if ($nbLieux == 0) {
                                printf("<h1>Aucune exploration récente</h1>");
                            } else {
                                printf("<h1>Mes dernières <span class='orange'>explorations</span></h1>");
                                
                            }
                            ?>
                            <a href="/php/galerie.php">
                                <p>Voir Plus</p>
                                <img src="/img/accueil/fleche.png" alt="fleche">
                            </a>
                        </article>
                        <section class="explos_recentes_photos">
                            <?php
                            while ($lieu = $troisDerniersLieux->fetch_assoc()) {
                                $categorie = htmlspecialchars($lieu["nom_categorie"]);
                                $cheminImg = htmlspecialchars(getImageBanniere($conn, $lieu["idL"], $categorie));
                                $cheminPhysique = $_SERVER['DOCUMENT_ROOT'] . $cheminImg;
                                if (!file_exists($cheminPhysique)) {
                                    $cheminImg = "/img/accueil/image_defaut.png";
                                }
                                $pays = htmlspecialchars(getPays($conn, $lieu["idL"], $categorie));
                                $nom = htmlspecialchars($lieu["nom"]);
                                $annee = htmlspecialchars(substr($lieu["date_explo"], 0, 4));
                                $moisChiffre = htmlspecialchars(substr($lieu["date_explo"], 5, 2));
                                $slug = htmlspecialchars($lieu["slug"]);
                                $lienUrl = htmlspecialchars(
                                    "/php/lieu_indiv.php?slug={$slug}&categorie={$categorie}");
                                ?>
                                <article class="unLieu" data-categorie="<?php echo $categorie ?>" data-pays="<?php echo $pays ?>" data-annee="<?php echo $annee ?>">
                                    <img src="<?php echo $cheminImg ?>" alt="">
                                    <div class="content">
                                        <article>
                                            <div class="premier">
                                                <hr class="trait-blanc">
                                                <h2><?php echo $nom ?></h2>
                                                <hr class="trait-blanc">
                                            </div>
                                            <div>
                                                <img src="/img/accueil/drapeau_<?php echo $pays ?>.png" alt="">
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
                    <section class="reseaux anim_section">
                        <section>
                            <h1>Suivez-moi et mes compagnons d’aventure sur <span class="orange">Instagram</span></h1>
                            <section class="insta">
                                <article class="un_insta">
                                    <img src="/img/accueil/photo_profil.png" alt="photo de profil">
                                    <div>
                                        <img src="/img/accueil/logo_instagram.png" alt="logo instagram">
                                        <a href="https://www.instagram.com/exploratio_nln/">@Exploratio_nln</a>
                                    </div>
                                </article>
                                <article class="un_insta">
                                    <img src="/img/accueil/pikachurbex.jpeg" alt="photo de profil">
                                    <div>
                                        <img src="/img/accueil/logo_instagram.png" alt="logo instagram">
                                        <a href="https://www.instagram.com/pikachurbex/">@pikachurbex</a>
                                    </div>
                                </article>
                                <article class="un_insta">
                                    <img src="/img/accueil/grendnez.jpeg" alt="photo de profil">
                                    <div>
                                        <img src="/img/accueil/logo_instagram.png" alt="logo instagram">
                                        <a href="https://www.instagram.com/grendnez_xploration/">@grendnez_xploration</a>
                                    </div>
                                </article>
                                <article class="un_insta">
                                    <img src="/img/accueil/tim_explo.png" alt="photo de profil">
                                    <div>
                                        <img src="/img/accueil/logo_instagram.png" alt="logo instagram">
                                        <a href="https://www.instagram.com/tim_explo_urbain/">@tim_explo_urbain</a>
                                    </div>
                                </article>
                            </section>
                        </section>
                    </section>
                </div>
            </div>
        </main>
        <?php include 'footer.php'; ?>
        <script src="/js/animation.js"></script>
        <script src="/js/responsive.js"></script>
    </body>
</html>