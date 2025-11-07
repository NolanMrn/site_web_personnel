<?php
require_once __DIR__ . '/../connexion_bd.php';
require_once __DIR__ . '/../fonctions.php';

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'ajouter':
        $nbSections = $_POST['nbSections'] ?? 0;
        $nom = $_POST['nom'] ?? '';
        $slug = $_POST['slug'] ?? '';
        $num_banniere = $_POST['num_banniere'] ?? '';
        $histoire = $_POST['histoire'] ?? '';

        if ($_POST['nouveau_pays'] === "") {
            $pays = $_POST['pays'] ?? '';
        } else {
            $pays = $_POST['nouveau_pays'] ?? '';
        }
        if ($_POST['nouvelle_categorie'] === "") {
            $categorie = $_POST['categorie'] ?? '';
        } else {
            $categorie = $_POST['nouvelle_categorie'] ?? '';
        }
        $date_explo = $_POST['date_explo'] ?? '';
        $date_explo_bonne = $date_explo . "-01";

        $cadrage = [];
        $listeCadrageFinal = [];
        $listeParagraphe = [];
        for ($i = 0 ; $i < $nbSections ; $i++) {
            $listeParagraphe[$i] = $_POST['paragraphe' . $i + 1] ?? '';
            $cadrage[$i] = $_POST['ordre' . $i + 1] ?? '';

            $morceauxOrdresAvecNum = explode(" / ", $cadrage[$i]);
            foreach ($morceauxOrdresAvecNum as $m) {
                $parts = explode(".", $m);
                if (isset($parts[1])) {
                    $listeCadrageFinal[$i][] = $parts[1];
                }
            }
        }

        $SlugUnique = verifSlugUniqueParCategorie($conn, $slug, $categorie);
        if ($SlugUnique) {
            ajtLieuxEntier($conn, $categorie, $slug, $nom, $date_explo_bonne, $num_banniere, $pays, $histoire, $nbSections, $listeCadrageFinal, $listeParagraphe);
            echo "Lieu ajouté !!";
        } else {
            echo "slug existant, veuillez recharger le formulaire avec un nouveau slug";
        }
        break;


    case 'modifier':
        
        modifLieu($conn, $slug, $categorie, $nom, $pays, $date_explo_bonne, $histoire, $num_banniere);
        echo "Lieu modifié avec succès !";
        break;

    case 'supprimer':
        $lieu = $_POST['lieu'] ?? '';
        list($slug, $categorie) = explode('|', $lieu);
        $supp = supprimerLieuEntier($conn, $slug, $categorie);
        if ($supp) {
            echo "Le lieu a été supprimé avec succès !";
        } else {
            echo "Le lieu que vous vennez de choisir n'existe pas, veuillez réessayer";
        }
        break;

    default:
        echo "Aucune action reconnue.";
}
?>