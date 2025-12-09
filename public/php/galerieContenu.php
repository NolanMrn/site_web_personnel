<?php
require_once '../../connexion_bd.php';
require_once 'fonctions.php';

$anneeFiltre = isset($_GET['annee']) ? intval($_GET['annee']) : null;
$paysFiltre = isset($_GET['pays']) ? $_GET['pays'] : null;
$categorieFiltre = isset($_GET['categorie']) ? $_GET['categorie'] : null;

if (isset($_GET['page'])) {
    $page = max(1, intval($_GET['page']));
} else {
    $page = 1;
}
$limit = 12;
$offset = ($page - 1) * $limit;

$recherche = isset($_GET['recherche']) ? $_GET['recherche'] : '';

$lieux = getAllLieuxParDouze($conn, $limit, $offset, $categorieFiltre, $paysFiltre, $anneeFiltre, $recherche);
$nbLieuxTotal = getNbLieux($conn, $categorieFiltre, $paysFiltre, $anneeFiltre, $recherche);
$nbPages = ceil($nbLieuxTotal / $limit);
$nbLieux = $lieux->num_rows;

$categories = getAllCategories($conn);
$allPays = getAllPays($conn);
$AllAnnees = getAllAnnees($conn);

?>

<main>
    <div class="container">
        <section class="block">
            
            <nav class="filtre anim_section">
                <p class="nbLieuxOrdi">Nombre total de Lieux : <?php echo htmlspecialchars($nbLieuxTotal) ?></p>
                <section class="telephone">
                    <p>Nombre total de Lieux : <?php echo htmlspecialchars($nbLieuxTotal) ?></p>
                    <button id="btn-filtre" class="btn-filtre">
                        <img src="/img/accueil/filtre.png" alt="Icône filtre">
                        Filtres
                    </button>
                </section>
                <section class="navFiltre">
                    <section class="haut">
                        <p>Filtres</p>
                        <a href="/php/galerie.php" class="btn_croix"></a>
                    </section>
                    <form class="recherche" method="get" action="/php/galerie.php">
                        <button type="submit" class="btn_recherche"></button>
                        <input type="text" name="recherche" class="recherche_case" placeholder="Rechercher un lieu précis..." value="<?php echo htmlspecialchars($recherche); ?>">
                    </form>
                    <article>
                        <p>Par <span class="orange">catégorie</span> :</p>
                        <ul>
                            <?php
                            while ($cat = $categories->fetch_assoc()) {
                                $isActive = ($categorieFiltre === $cat['nom_categorie']) ? 'active' : '';
                                $categorieParam = $isActive ? '' : 'categorie=' . urlencode($cat['nom_categorie']);
                                $url = "";
                                if ($categorieParam) {
                                    $url .= "?" . $categorieParam;
                                }
                                if ($paysFiltre) {
                                    $url .= ($url ? "&" : "?") . "pays=" . urlencode($paysFiltre);
                                }
                                if ($anneeFiltre) {
                                    $url .= ($url ? "&" : "?") . "annee=" . $anneeFiltre;
                                }
                                $href = $url ?: "/php/galerie.php";
                                printf('<li><a href="%s" class="btn_filtre anim-link %s">%s</a></li>', 
                                    $href,
                                    $isActive,
                                    htmlspecialchars($cat['nom_categorie'])
                                );
                            }
                            ?>
                        </ul>
                    </article>
                    <article>
                        <p>Par <span class="orange">pays</span> :</p>
                        <ul>
                            <?php
                            while ($p = $allPays->fetch_assoc()) {      
                                $isActive = ($paysFiltre === $p['pays']) ? 'active' : '';
                                $paysParam = $isActive ? '' : "pays=" . urlencode($p['pays']);
                                $url = "";
                                if ($categorieFiltre) {
                                    $url .= "?" . "categorie=" . $categorieFiltre;
                                }
                                if ($paysParam) {
                                    $url .= ($url ? "&" : "?") . $paysParam;
                                }
                                if ($anneeFiltre) {
                                    $url .= ($url ? "&" : "?") . "annee=" . $anneeFiltre;
                                }
                                $href = $url ?: "/php/galerie.php";
                                printf(
                                    '<li><a href="%s" class="btn_filtre anim-link %s">%s</a></li>',
                                    $href,
                                    $isActive,
                                    htmlspecialchars($p['pays'])
                                );
                            }
                            ?>
                        </ul>
                    </article>
                    <article>
                        <p>Par <span class="orange">années</span> :</p>
                        <ul>
                            <?php
                            foreach ($AllAnnees as $a) {
                                $isActive = ((string) $anneeFiltre === $a) ? 'active' : '';
                                $anneeParam = $isActive ? '' : "annee=" . $a;
                                $url = "";
                                if ($categorieFiltre) {
                                    $url .= "?" . "categorie=" . $categorieFiltre;
                                }
                                if ($paysFiltre) {
                                    $url .= ($url ? "&" : "?") . "pays=" . urlencode($paysFiltre);
                                }
                                if ($anneeParam) {
                                    $url .= ($url ? "&" : "?") . $anneeParam;
                                }
                                $href = $url ?: "/php/galerie.php";
                                printf('<li><a href="%s" class="btn_filtre anim-link %s">%s</a></li>',
                                    $href,
                                    $isActive,
                                    htmlspecialchars($a)
                                );
                            }
                            ?>
                        </ul>
                    </article>
                </section>
            </nav>
            <section class="remplissage"></section>
            <section class="explos_photos anim_section">
                <?php
                if ($recherche) { ?>
                    <div class="resultat">
                        <h1>Résultats pour : "<?php echo htmlspecialchars($recherche) ?>"</h1>
                    </div>
                <?php 
                }
                while ($lieu = $lieux->fetch_assoc()) {
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
                    <article class="unLieu">
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
                $nbAjouter = 0;
                if ($reste !== 0) {
                    $nbAjouter = 3 - $reste;
                }
                for ($i = 0; $i < $nbAjouter; $i++) {
                    ?>
                    <article class="article_vide"></article>
                    <?php
                }
                ?>
            </section>
        </section>
        <section class="pagination anim_section">
            <?php
            $requeteChaine = '';
            if ($categorieFiltre) {
                $requeteChaine .= '&categorie=' . urlencode($categorieFiltre);
            }
            if ($paysFiltre) {
                $requeteChaine .= '&pays=' . urlencode($paysFiltre);
            }
            if ($anneeFiltre) {
                $requeteChaine .= '&annee=' . intval($anneeFiltre);
            }
            if ($recherche) {
                $requeteChaine .= '&recherche=' . urlencode($recherche);
            }
            if ($page > 1) {
                ?>
                <a href="?page=<?php echo $page - 1 . $requeteChaine; ?>" class="navPage"><</a>
                <?php 
            }
            ?>
            <span class="info_page">Page <span class="orange"><?php echo $page; ?></span> / <?php echo $nbPages; ?></span>
            <?php 
            if ($page < $nbPages) {
                ?>
                <a href="?page=<?php echo $page + 1 . $requeteChaine; ?>" class="navPage">></a>
                <?php
            }
            ?>
        </section>
    </div>
</main>