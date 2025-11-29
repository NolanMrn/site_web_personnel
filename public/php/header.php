<?php
$page_actuelle = basename($_SERVER['PHP_SELF']);

$admin = false;
if (isset($_SERVER['PHP_AUTH_USER'])) {
    $admin = true;
}

?>

<header>
    <img src="/site_web/public/img/accueil/photo_profil.png" alt="photo profil">
    <h1>Exploratio_nln</h1>
    <button id="menu-btn">
        <img id="menu-icon" src="/site_web/public/img/accueil/hamburger.png" alt="">
    </button>
    <nav class="navMenu">
        <ul class="menu">
            <li><a href="/site_web/public/php/accueil.php" class="<?= $page_actuelle === 'accueil.php' ? 'active' : '' ?>">Accueil</a></li>
            <li><a href="/site_web/public/php/galerie.php" class="<?= $page_actuelle === 'galerie.php' ? 'active' : '' ?>">Galerie</a></li>
            <li><a href="/site_web/public/php/contact.php" class="<?= $page_actuelle === 'contact.php' ? 'active' : '' ?>">Contact</a></li>
            <?php 
            if ($admin) {
                ?>
                <li><a href="/site_web/public/php/admin/gestionAdmin.php">Admin</a></li>
                <?php 
            }
            ?>
        </ul>
    </nav>
</header>