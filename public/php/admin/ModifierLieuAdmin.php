<?php

$admin = false;
if (isset($_SERVER['PHP_AUTH_USER'])) {
    $admin = true;
}

require_once __DIR__ . '/../connexion_bd.php';
require_once __DIR__ . '/../fonctions.php';

$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    include 'save_lieu.php';
}

$allLieux = getAllLieux($conn);

$lieuSelectionne = null;
$slugSelectionne = null;
$categorieSelectionne = null;
$nomSelectionne = null;
$dateExploSelectionne = null;
$numCheminBanniere = null;
$histoireLieuSelectionne = null;
$galeriesSelectionne = null;
$nbSections = 0;

if (isset($_POST['lieu'])) {
    list($slugSelectionne, $categorieSelectionne) = explode('|', $_POST['lieu']);
    $idLSelectionne = getIdL($conn, $categorieSelectionne, $slugSelectionne);
    $lieuSelectionne = getLieu($conn, $slugSelectionne, $categorieSelectionne);
    $nomSelectionne = $lieuSelectionne['nom'];
    $dateExploSelectionne = getDateFormateInt($lieuSelectionne['date_explo']);
    $numCheminBanniere = extraireNumeroAvantExtension(getImageBanniere($conn, $idLSelectionne, $categorieSelectionne));
    $histoireLieuSelectionne = getHistoireLieux($conn, $idLSelectionne, $categorieSelectionne);
    $galeriesSelectionne = getGalleries($conn, $categorieSelectionne, $idLSelectionne);
}

if ($galeriesSelectionne != null) {
    $nbSections = 0;
    $tmp = [];
    $galeriesSelectionne->data_seek(0);
    while ($galerie = $galeriesSelectionne->fetch_assoc()) {
        $nbSections++;
        $tmp[] = $galerie;
    }
    $galeriesSelectionne->data_seek(0);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/admin.css">
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <?php 
    if ($admin) { ?>
        <title>Exploratio_nln Admin</title>
        <?php 
    } else { ?>
        <title>Exploratio_nln</title>
        <?php 
    }     
    ?>
    <link rel="icon" type="image/PNG" href="/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../header.php'; ?>
    <main>
        <div class="container" data-nbSections = "<?php echo $nbSections ?>">
            <div class="block anim_section">
                <h1>Modifier un <span class="orange">lieu</span></h1>
                <section class="deuxForm">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label></label>
                            <?php 
                            if (!empty($success)) {
                                echo "<p class='success'>$success</p>";
                            } elseif (!empty($error)) {
                                echo "<p class='error'>$error</p>";
                            } else {
                                echo "<p></p>";
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="lieu">Liste des Lieux :</label>
                            <select id="lieu" name="lieu" onchange=this.form.submit() required>
                                <option value="" disabled <?= $slugSelectionne ? '' : 'selected' ?>></option>
                                <?php
                                while ($lieu = $allLieux->fetch_assoc()) {
                                    $categorie = htmlspecialchars($lieu["nom_categorie"]);
                                    $nom = htmlspecialchars($lieu['nom']);
                                    $slug = htmlspecialchars($lieu["slug"]);
                                    $selected = ($slug === $slugSelectionne && $categorie === $categorieSelectionne) ? 'selected' : '';
                                    printf(
                                        '<option value="%s|%s" %s >%s (catégorie = %s / slug = %s)</option>',
                                        $slug, $categorie, $selected, $nom, $categorie, $slug
                                    );
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                    <form class="form_lieu <?= $lieuSelectionne ? 'visible' : '' ?>" method="POST" onsubmit="return validerFormulaire()">
                        <input type="hidden" name="nbSections" id="nbSections" value="<?php echo $nbSections; ?>">
                        <input type="hidden" name="nbPhotos" id="nbPhotos" value="<?php echo $nbPhotos; ?>">
                        <input type="hidden" name="idLieu" id="idLieu" value="<?php echo $idLSelectionne; ?>">
                        <input type="hidden" name="categorieLieu" id="categorieLieu" value="<?php echo $categorieSelectionne; ?>">
                        <input type="hidden" name="slugLieu" id="slugLieu" value="<?php echo $slugSelectionne; ?>">
                        <input type="hidden" name="action" value="modifier">
                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input value = "<?php echo htmlspecialchars($nomSelectionne) ?>" type="text" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="date_explo">Date exploration :</label>
                            <input value = "<?php echo htmlspecialchars($dateExploSelectionne) ?>" type="text" id="date_explo" name="date_explo" placeholder="Sous la forme AAAA-MM" required>
                        </div>
                        <div class="form-group">
                            <label for="num_banniere">Num photo bannière :</label>
                            <input value = "<?php echo htmlspecialchars($numCheminBanniere) ?>" type="number" id="num_banniere" name="num_banniere" required>
                        </div>
                        <div class="form-group">
                            <label for="histoire">Histoire du lieu :</label>
                            <textarea id="histoire" name="histoire" rows="6" required><?php echo htmlspecialchars($histoireLieuSelectionne)?></textarea>
                        </div>
                        <?php
                        $allSections = [];
                        if ($galeriesSelectionne != null) {
                            $nbSections = 0;
                            while ($galerie = $galeriesSelectionne->fetch_assoc()) {
                                $idG = $galerie['idG'];
                                $nbSections ++;
                                $paragraphe = getParagraphe($conn, $idG);
                                $CadragesImages = getImageGalerie($conn, $idG);
                                $lstCadrage = [];
                                while ($uncadrage = $CadragesImages->fetch_assoc()) {
                                    $lstCadrage[] = $uncadrage['cadrage'];
                                }
                                $allSections["ordre$nbSections"] = $lstCadrage;
                                $CadragesString = '';
                                for ($i = 0; $i < count($lstCadrage); $i++) {
                                    $CadragesString .= ($i + 1) . '.' . $lstCadrage[$i];
                                    if ($i < count($lstCadrage) - 1) {
                                        $CadragesString .= ' / ';
                                    }
                                }
                                ?>
                                <div class="section section<?php echo $nbSections ?>">
                                    <div class="form-group">
                                        <label for="paragraphe<?php echo $nbSections ?>">Paragraphe n°<?php echo $nbSections ?> :</label>
                                        <textarea id="paragraphe<?php echo $nbSections ?>" name="paragraphe<?php echo $nbSections ?>" rows="4" required><?php echo htmlspecialchars($paragraphe)?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <p>Images :</p>
                                        <div class="choix-orientation">
                                            <button type="button" class="btn-orientation" data-orientation="vertical">Vertical</button>
                                            <button type="button" class="btn-orientation" data-orientation="horizontal">Horizontal</button>
                                            <button type="button" class="btn-retour">Annuler la dernière image</button>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ordre<?php echo $nbSections ?>">Ordre :</label>
                                        <textarea id="ordre<?php echo $nbSections ?>" name="ordre<?php echo $nbSections ?>" class="ordre" rows="2" readonly><?php echo htmlspecialchars($CadragesString)?></textarea>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="form-group">
                            <div></div>
                            <div class="boutons_section">
                                <button type="button" class="btn-supprimer_section">Supprimer la dernière section</button>
                                <button type="button" class="btn-ajouter_section">Ajouter une section</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div></div>
                            <button type="submit" class="btn-enregistrer">Modifier</button>
                        </div>
                        <script>
                            const sections = new Map();
                            <?php
                            foreach ($allSections as $id => $liste) {
                                echo "sections.set('$id', " . json_encode($liste) . ");\n";
                            }
                            ?>
                        </script>
                        <script src="/js/admin.js">
                        </script>
                    </form>
                </section>
            </div>
        </div>
    </main>
    <?php include '../footer.php'; ?>
    <script src="/js/animation.js"></script>
</body>
</html>