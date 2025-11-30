<?php
$page_actuelle = basename($_SERVER['PHP_SELF']);
?>

<footer>
    <section>
        <article>
            <h3>Exploratio_nln</h3>
            <p>e-mail : nolan.exploration@gmail.com</p>
            <article>
                <img src="/site_web/public/img/accueil/logo_instagram.png" alt="logo instagram">
                <a href="https://www.instagram.com/exploratio_nln/">@Exploratio_nln</a>
            </article>
        </article>
        <article class="lien">
            <h3>Liens rapides</h3>
            <ul>
                <li><a href="/site_web/public/php/accueil.php" class="<?= $page_actuelle === 'accueil.php' ? 'active' : '' ?>">Accueil</a></li>
                <li><a href="/site_web/public/php/galerie.php" class="<?= $page_actuelle === 'galerie.php' ? 'active' : '' ?>">Galerie</a></li>
                <li><a href="" class="<?= $page_actuelle === 'contact.php' ? 'active' : '' ?>">Contact</a></li>
            </ul>
        </article>
        <article>
            <h3>Éthique & Légal</h3>
            <ul>
                <li><a href="/site_web/public/php/mentionsLegales.php">Mentions Légales</a></li>
                <li><a href="/site_web/public/php/confidentialite.php">Politique de Confidentialité</a></li>
                <li><a href="/site_web/public/php/droitsAuteur.php">CGU & Droit d'Auteur</a></li>
            </ul>
        </article>
    </section>
    <article class="copyright">
        <p>© 2025 Exploratio_nln - Tous droits réservés. | Crédit site : Exploratio_nln | 
            Hébergeur : [Nom de l'Hébergeur]</p>
    </article>
</footer>