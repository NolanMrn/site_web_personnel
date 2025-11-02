<?php
require_once __DIR__ . '/../connexion_bd.php';
require_once __DIR__ . '/../fonctions.php';

$categories = getAllCategories($conn);
$pays = getAllPays($conn);
$nbSections = 0;
$nbPhotos = 0;
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
            <h1>Ajouter un lieu</h1>
            <form method="POST" action="save_lieu.php" onsubmit="return validerFormulaire()">
                <input type="hidden" name="nbSections" id="nbSections" value="<?php echo $nbSections; ?>">
                <input type="hidden" name="nbPhotos" id="nbPhotos" value="<?php echo $nbPhotos; ?>">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug :</label>
                    <input type="text" id="slug" name="slug" placeholder="doit être unique dans une catégorie" required>
                </div>
                <div class="form-group">
                    <label for="categorie">Catégorie :</label>
                    <select id="categorie" name="categorie" required>
                        <option value="" disabled selected></option>
                        <?php
                        while ($categorie = $categories->fetch_assoc()) {
                            printf(
                                '<option value=%s>%s</option>',
                                htmlspecialchars($categorie['nom_categorie']),
                                htmlspecialchars($categorie['nom_categorie'])
                            );
                        }
                        ?>
                        <option value="autre">Autre...</option>
                    </select>
                </div>
                <div class="form-group" id="nouvelle_categorie_container" style="display:none;">
                    <label for="nouvelle_categorie">Nouvelle catégorie :</label>
                    <input type="text" id="nouvelle_categorie" name="nouvelle_categorie">
                </div>
                <div class="form-group">
                    <label for="pays">Pays :</label>
                    <select id="pays" name="pays" required>
                        <option value="" disabled selected></option>
                        <?php
                        while ($unPays = $pays->fetch_assoc()) {
                            printf(
                                '<option value=%s>%s</option>',
                                htmlspecialchars($unPays['pays']),
                                htmlspecialchars($unPays['pays'])
                            );
                        }
                        ?>
                        <option value="autre">Autre...</option>
                    </select>
                </div>
                <div class="form-group" id="nouveau_pays_container" style="display:none;">
                    <label for="nouveau_pays">Nouveau Pays :</label>
                    <input type="text" id="nouveau_pays" name="nouveau_pays">
                </div>
                <div class="form-group">
                    <label for="date_explo">Date exploration :</label>
                    <input type="text" id="date_explo" name="date_explo" placeholder="Sous la forme AAAA-MM" required>
                </div>
                <div class="form-group">
                    <label for="num_banniere">Num photo bannière :</label>
                    <input type="number" id="num_banniere" name="num_banniere" required>
                </div>
                <div class="form-group">
                    <label for="histoire">Histoire du lieu :</label>
                    <textarea id="histoire" name="histoire" rows="6" required></textarea>
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
                    <button type="submit" class="btn-enregistrer">Enregistrer</button>
                </div>
                <script src="/site_web/public/js/admin.js">
                </script>
            </form>
        </div>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>