<?php
require_once __DIR__ . '/../connexion_bd.php';
require_once __DIR__ . '/../fonctions.php';

$allLieux = getAllLieux($conn);

$lieuSelectionne = null;
$slugSelectionne = null;
$categorieSelectionne = null;
$nomSelectionne = null;
$dateExploSelectionne = null;
$numCheminBanniere = null;
$histoireLieuSelectionne = null;

if (isset($_POST['lieu'])) {
    list($slugSelectionne, $categorieSelectionne) = explode('|', $_POST['lieu']);
    $idLSelectionne = getIdL($conn, $categorieSelectionne, $slugSelectionne);
    $lieuSelectionne = getLieu($conn, $slugSelectionne, $categorieSelectionne);
    $nomSelectionne = $lieuSelectionne['nom'];
    $dateExploSelectionne = getDateFormateInt($lieuSelectionne['date_explo']);
    $numCheminBanniere = extraireNumeroAvantExtension(getImageBanniere($conn, $idLSelectionne, $categorieSelectionne));
    $histoireLieuSelectionne = getHistoireLieux($conn, $idLSelectionne, $categorieSelectionne);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/admin/admin.css">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/header/header.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/public/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../header.php'; ?>
    <main>
        <div class="container" data-nbSections = "<?php echo $nbSections ?>">
            <div class="block">
                <h1>Modifier un <span class="orange">lieu</span></h1>
                <section class="deuxForm">
                    <form method="POST" action="">
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
                    <form method="POST" action="save_lieu.php" onsubmit="return validerFormulaire()">
                        <input type="hidden" name="nbSections" id="nbSections" value="<?php echo $nbSections; ?>">
                        <input type="hidden" name="nbPhotos" id="nbPhotos" value="<?php echo $nbPhotos; ?>">
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
                        <div class="form-group">
                            <label></label>
                            <div class="boutons_section">
                                <button type="button" class="btn-supprimer_section">Supprimer la dernière section</button>
                                <button type="button" class="btn-ajouter_section">Ajouter une section</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn-enregistrer">Modifier</button>
                        </div>
                        <script src="/site_web/public/js/admin.js">
                        </script>
                    </form>
                </section>
            </div>
        </div>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>