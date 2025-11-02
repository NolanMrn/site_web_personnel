<?php
function getLieu($conn, $slug, $categorie) {
    $statement = $conn->prepare('SELECT * FROM LIEUX WHERE slug = ? AND nom_categorie = ?');
    $statement->bind_param("ss", $slug, $categorie);
    $statement->execute();
    $result = $statement->get_result();
    $lieu = $result->fetch_assoc();
    return $lieu;
}

function getMoisFr($numero) {
    $mois = [
        1 => 'janvier', 2 => 'février', 3 => 'mars',
        4 => 'avril', 5 => 'mai', 6 => 'juin',
        7 => 'juillet', 8 => 'août', 9 => 'septembre',
        10 => 'octobre', 11 => 'novembre', 12 => 'décembre'
    ];
    $numero = (int)$numero;
    return $mois[$numero] ?? '';
}

function nettoyerTexte($texte) {
    $texte = mb_strtolower($texte, 'UTF-8');
    $texte = iconv('UTF-8', 'ASCII//TRANSLIT', $texte);
    $texte = preg_replace('/[^a-z\/]/', '', $texte);
    return $texte;
}

function getDateFormate($date_explo){
    $annee = substr($date_explo, 0, 4);
    $moisChiffre = substr($date_explo, 5, 2);
    $moisLettre = getMoisFr($moisChiffre);
    return $moisLettre . " " . $annee;
}

function getAllCategories($conn) {
    $statement = $conn->prepare(
        'SELECT * FROM CATEGORIE'
    );
    $statement->execute();
    $categories = $statement->get_result();
    return $categories;
}

function getAllPays($conn) {
    $statement = $conn->prepare(
        'SELECT DISTINCT pays FROM DESCRIPTIFLIEUX'
    );
    $statement->execute();
    $pays = $statement->get_result();
    return $pays;
}

function getAllAnnees($conn) {
    $sql = "SELECT DISTINCT YEAR(date_explo) AS annee FROM LIEUX ORDER BY date_explo DESC";
    $result = $conn->query($sql);
    $annees = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $annees[] = $row['annee'];
        }
    }
    return $annees;
}

function getHistoireLieux($conn, $idL, $categorie) {
    $statement = $conn->prepare(
        'SELECT histoire_lieux FROM DESCRIPTIFLIEUX WHERE idL = ? AND nom_categorie = ?'
    );
    $statement->bind_param("ss", $idL, $categorie);
    $statement->execute();
    $result = $statement->get_result();
    $histoireLieux = $result->fetch_assoc(); 
    return $histoireLieux['histoire_lieux'] ?? '';
}

function getPays($conn, $idL, $categorie) {
    $statement = $conn->prepare(
        'SELECT pays FROM DESCRIPTIFLIEUX WHERE idL = ? AND nom_categorie = ?'
    );
    $statement->bind_param("ss", $idL, $categorie);
    $statement->execute();
    $result = $statement->get_result();
    $pays = $result->fetch_assoc(); 
    return $pays['pays'] ?? '';
}

function getStructure($conn, $idL, $categorie){
    $statement = $conn->prepare(
        'SELECT types, ref FROM STRUCTURE WHERE idL = ? AND nom_categorie = ? ORDER BY ordre_structure'
    );
    $statement->bind_param("is", $idL, $categorie);
    $statement->execute();
    $structure = $statement->get_result();
    return $structure;
}

function getImageGalerie($conn, $refGallerie){
    $statement = $conn->prepare(
        'SELECT chemin, cadrage FROM IMAGEGALLERIE where idG = ? ORDER BY ordreImg'
    );
    $statement->bind_param("i", $refGallerie);
    $statement->execute();
    $images = $statement->get_result();
    return $images;
}

function getParagraphe($conn, $refGallerie){
    $statement = $conn->prepare(
        'SELECT paragraphe FROM PARAGRAPHE where idG = ?'
    );
    $statement->bind_param("i", $refGallerie);
    $statement->execute();
    $result = $statement->get_result();
    $paragraphe = $result->fetch_assoc();
    return $paragraphe["paragraphe"] ?? '';
}

function getDescription($conn, $categorie){
    $statement = $conn->prepare(
        'SELECT description_cat FROM CATEGORIE where nom_categorie = ?'
    );
    $statement->bind_param("s", $categorie);
    $statement->execute();
    $result = $statement->get_result();
    $description = $result->fetch_assoc();
    return $description["description_cat"] ?? '';
}

function getAllLieuxCategorie($conn, $categorie){
    $statement = $conn->prepare(
        'SELECT idL, slug, nom, date_explo FROM LIEUX NATURAL JOIN CATEGORIE WHERE nom_categorie = ? ORDER BY date_explo DESC;'
    );
    $statement->bind_param("s", $categorie);
    $statement->execute();
    $lieux = $statement->get_result();
    return $lieux;
}

function getAllLieux($conn){
    $statement = $conn->prepare(
        'SELECT idL, slug, nom, date_explo, nom_categorie FROM LIEUX ORDER BY date_explo DESC;'
    );
    $statement->execute();
    $lieux = $statement->get_result();
    return $lieux;
}

function getTroisDernierslLieux($conn){
    $statement = $conn->prepare(
        'SELECT idL, slug, nom, date_explo, nom_categorie FROM LIEUX ORDER BY date_explo DESC LIMIT 3;'
    );
    $statement->execute();
    $lieux = $statement->get_result();
    return $lieux;
}

function getImageBanniere($conn, $idL, $categorie){
    $statement = $conn->prepare(
        'SELECT chemin_img_banniere FROM DESCRIPTIFLIEUX WHERE idL = ? AND nom_categorie = ?'
    );
    $statement->bind_param("is", $idL, $categorie);
    $statement->execute();
    $result = $statement->get_result();
    $chemin = $result->fetch_assoc();
    return $chemin["chemin_img_banniere"] ?? '';
}

function getIdL($conn, $categorie, $slug) {
    $statement = $conn->prepare(
        'SELECT idL FROM LIEUX WHERE nom_categorie = ? AND slug = ?'
    );
    $statement->bind_param("ss", $categorie, $slug);
    $statement->execute();
    $result = $statement->get_result();
    $idL = $result->fetch_assoc();
    return $idL["idL"] ?? '';
}

function getGalleries($conn, $categorie, $idL) {
    $statement = $conn->prepare(
        'SELECT idG FROM GALLERIE WHERE nom_categorie = ? AND idL = ?'
    );
    $statement->bind_param("si", $categorie, $idL);
    $statement->execute();
    $galleries = $statement->get_result();
    return $galleries;
}

function verifSlugUniqueParCategorie($conn, $slug, $categorie) {
    $statement = $conn->prepare(
        'SELECT count(*) as nbSlug FROM LIEUX WHERE slug = ? and nom_categorie = ?'
    );
    $statement->bind_param("ss", $slug, $categorie);
    $statement->execute();
    $result = $statement->get_result();
    $nbSlug = $result->fetch_assoc(); 
    if ($nbSlug['nbSlug'] === 0) {
        return true;
    } else {
        return false;
    }
}

function verifOuAjtCategorie($conn, $categorie) {
    $statement = $conn->prepare('SELECT COUNT(*) AS nb FROM CATEGORIE WHERE nom_categorie = ?');
    $statement->bind_param("s", $categorie);
    $statement->execute();
    $result = $statement->get_result();
    $row = $result->fetch_assoc();
    if ($row['nb'] == 0) {
        $insert = $conn->prepare('INSERT INTO CATEGORIE (nom_categorie) VALUES (?)');
        $insert->bind_param("s", $categorie);
        $insert->execute();
    }
}

function ajtLieux($conn, $categorie, $slug, $nom, $dateExplo){
    $statement = $conn->prepare(
        'INSERT INTO LIEUX (nom_categorie, slug, nom, date_explo) 
        VALUES (?, ?, ?, ?)'
    );
    $statement->bind_param("ssss", $categorie, $slug, $nom, $dateExplo);
    $statement->execute();
}

function ajtDescriptifLieux($conn, $idL, $slug, $categorie, $NumCheminImgBanniere, $pays, $histoire){
    $chemin = "/site_web/public/img/" . nettoyerTexte($categorie) . "/" . $slug . "/image" . $NumCheminImgBanniere . ".jpeg";
    $statement = $conn->prepare(
        'INSERT INTO DESCRIPTIFLIEUX (idL, nom_categorie, chemin_img_banniere, pays,  histoire_lieux) 
        VALUES (?, ?, ?, ?, ?)'
    );
    $statement->bind_param("issss", $idL, $categorie, $chemin, $pays, $histoire);
    $statement->execute();
}

function ajtGallerie($conn, $idL, $categorie, $nbSections){
    for ($i = 0 ; $i < $nbSections ; $i++) {
        $statement = $conn->prepare(
            'INSERT INTO GALLERIE (idL, nom_categorie) 
            VALUES (?, ?)'
        );
        $statement->bind_param("is", $idL, $categorie);
        $statement->execute();
    }
}

function ajtImageGallerie($conn, $galleriesArray, $categorie, $slug, $listeCadrage){
    $cheminDebut = "/site_web/public/img/" . nettoyerTexte($categorie) . "/" . $slug . "/image";
    $cptOrdre = 1;
    $cptImage = 1;
    $index = 0;
    foreach ($galleriesArray as $gallerie) {
        foreach ($listeCadrage[$index] as $cadrage) {
            $cheminEntier = $cheminDebut . $cptImage . ".jpeg";
            $statement = $conn->prepare(
                'INSERT INTO IMAGEGALLERIE (idG, chemin, ordreImg, cadrage)
                VALUES (?, ?, ?, ?)'
            );
            $statement->bind_param("isis", $gallerie["idG"], $cheminEntier, $cptOrdre, $cadrage);
            $statement->execute();
            $cptImage += 1;
            $cptOrdre += 1;
        }
        $cptOrdre = 0;
        $index++;
    }
}

function ajtParagraphe($conn, $galleriesArray, $listeParagraphe){
    $index = 0;
    foreach ($galleriesArray as $gallerie) {
        $statement = $conn->prepare(
            'INSERT INTO PARAGRAPHE (idG, paragraphe)
            VALUES (?, ?)'
        );
        $statement->bind_param("is", $gallerie["idG"], $listeParagraphe[$index]);
        $statement->execute();
        $index++;
    }
}

function ajtStructure($conn, $idL, $galleriesArray, $categorie){
    $ref = ["paragraphe", "galerie"];
    $cptOrdre = 1;
    foreach ($galleriesArray as $gallerie) {
        for ($i = 0 ; $i < 2 ; $i++) {
             $statement = $conn->prepare(
                'INSERT INTO STRUCTURE (idL, nom_categorie, ordre_structure, types, ref)
                VALUES (?, ?, ?, ?, ?)'
            );
            $statement->bind_param("isisi", $idL, $categorie, $cptOrdre, $ref[$i], $gallerie["idG"]);
            $statement->execute();
            $cptOrdre += 1;
        }
    }
}

function ajtLieuxEntier($conn, $categorie, $slug, $nom, $date_explo, $num_banniere, $pays, $histoire, $nbSections, $listeCadrageFinal, $listeParagrapheFinal) {
    verifOuAjtCategorie($conn, $categorie);

    ajtLieux($conn, $categorie, $slug, $nom, $date_explo);
    $idL = (int)getIdL($conn, $categorie, $slug);

    ajtDescriptifLieux($conn, $idL, $slug, $categorie, $num_banniere, $pays, $histoire);

    ajtGallerie($conn, $idL, $categorie, $nbSections);
    $galleries = getGalleries($conn, $categorie, $idL);
    $galleriesArray = [];
    while ($g = $galleries->fetch_assoc()) {
        $galleriesArray[] = $g;
    }

    ajtImageGallerie($conn, $galleriesArray, $categorie, $slug, $listeCadrageFinal);

    ajtParagraphe($conn, $galleriesArray, $listeParagrapheFinal);

    ajtStructure($conn,  $idL, $galleriesArray, $categorie);
}
?>