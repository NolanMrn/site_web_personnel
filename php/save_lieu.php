<?php
require_once 'connexion_bd.php';
require_once 'fonctions.php';

$nbSections = $_POST['nbSections'] ?? 0;

$nom = $_POST['nom'] ?? '';
$slug = $_POST['slug'] ?? '';
$categorie = $_POST['categorie'] ?? '';
$pays = $_POST['pays'] ?? '';
$date_explo = $_POST['date_explo'] ?? '';
$num_banniere = $_POST['num_banniere'] ?? '';
$histoire = $_POST['histoire'] ?? '';

$paragraphes = [];
$ordres = [];
$listeCadrageFinal = [];
$listeParagrapheFinal = [];

for ($i = 0 ; $i < $nbSections ; $i++) {
    $paragraphes[$i] = $_POST['paragraphe' . $i + 1] ?? '';
    $ordres[$i] = $_POST['ordre' . $i + 1] ?? '';

    $morceauxOrdresAvecNum = explode(" / ", $ordres[$i]);
    foreach ($morceauxOrdresAvecNum as $m) {
        $parts = explode(".", $m);
        if (isset($parts[1])) {
            $listeCadrageFinal[$i][] = $parts[1];
        }
    }
    foreach ($listeCadrageFinal as $lof) {
        foreach ($lof as $lo) {
            echo $lo . " / ";
        }
    }
    echo "<br>";
    $listeParagrapheFinal[$i] = explode("\n", $paragraphes[$i]);
    foreach ($listeParagrapheFinal as $lpf) {
        foreach ($lpf as $lp) {
            echo $lp . " / ";
        }
        echo "<br>";
    }
}

ajtLieux($conn, $categorie, $slug, $nom, $date_explo);
ajtDescriptifLieux($conn, $slug, $categorie, $num_banniere, $pays, $histoire);
ajtGallerie($conn, $categorie, $slug, $nbSections);
ajtImageGallerie($conn, $categorie, $slug, $listeCadrageFinal);
ajtParagraphe($conn, $categorie, $slug, $listeParagrapheFinal);
ajtStructure($conn,  $categorie, $slug);
?>