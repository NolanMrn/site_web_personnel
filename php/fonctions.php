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

function ajtLieux($conn, $categorie, $slug, $nom, $dateExplo){
    $statement = $conn->prepare(
        'INSERT INTO LIEUX (nom_categorie, slug, nom, date_explo) 
        VALUES (?, ?, ?, ?)'
    );
    $statement->bind_param("ssss", $categorie, $slug, $nom, $dateExplo);
    $statement->execute();
}

function ajtDescriptifLieux($conn, $slug, $categorie, $NumCheminImgBanniere, $pays, $histoire){
    $idL = (int)getIdL($conn, $categorie, $slug);
    $chemin = "/site_web/img/" . $categorie . "/" . $slug . "/image" . $NumCheminImgBanniere . ".jpeg";
    echo $chemin;
    $statement = $conn->prepare(
        'INSERT INTO DESCRIPTIFLIEUX (idL, nom_categorie, chemin_img_banniere, pays,  histoire_lieux) 
        VALUES (?, ?, ?, ?, ?)'
    );
    $statement->bind_param("issss", $idL, $categorie, $chemin, $pays, $histoire);
    $statement->execute();
}

function ajtGallerie($conn, $categorie, $slug, $nbSections){
    $idL = getIdL($conn, $categorie, $slug);
    for ($i = 0 ; $i < $nbSections ; $i++) {
        $statement = $conn->prepare(
            'INSERT INTO GALLERIE (idL, nom_categorie) 
            VALUES (?, ?)'
        );
        $statement->bind_param("is", $idL, $categorie);
        $statement->execute();
    }
}

function ajtImageGallerie($conn, $categorie, $slug, $listeCadrage){
    $idL = (int)getIdL($conn, $categorie, $slug);
    $galleries = getGalleries($conn, $categorie, $idL);
    $cheminDebut = "/site_web/img/" . $categorie . "/" . $slug . "/image";
    $cptOrdre = 1;
    $cptImage = 1;
    $index = 0;
    while ($gallerie = $galleries->fetch_assoc()) {
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

function ajtParagraphe($conn, $categorie, $slug, $listeParagraphe){
    $idL = (int)getIdL($conn, $categorie, $slug);
    $galleries = getGalleries($conn, $categorie, $idL);
    $index = 0;
    while ($gallerie = $galleries->fetch_assoc()) {
        $statement = $conn->prepare(
            'INSERT INTO PARAGRAPHE (idG, paragraphe)
            VALUES (?, ?)'
        );
        $statement->bind_param("is", $gallerie["idG"], $listeParagraphe[$index][0]);
        $statement->execute();
        $index++;
    }
}

function ajtStructure($conn,  $categorie, $slug){
    $idL = (int)getIdL($conn, $categorie, $slug);
    $galleries = getGalleries($conn, $categorie, $idL);
    $ref = ["paragraphe", "galerie"];
    $cptOrdre = 1;
    $index = 0;
    while ($gallerie = $galleries->fetch_assoc()) {
        for ($i = 0 ; $i < 2 ; $i++) {
             $statement = $conn->prepare(
                'INSERT INTO STRUCTURE (idL, nom_categorie, ordre_structure, types, ref)
                VALUES (?, ?, ?, ?, ?)'
            );
            $statement->bind_param("isisi", $idL, $categorie, $cptOrdre, $ref[$i], $gallerie["idG"]);
            $statement->execute();
            $cptOrdre += 1;
        }
        $index++;
    }
}
?>