<?php
require_once __DIR__ . '/../../connexion_bd.php';
require_once 'fonctions.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer et sécuriser les données
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(strip_tags($_POST['message']));

    // Adresse mail où tu veux recevoir les messages
    $to = "nolan.exploration@gmail.com";
    $subject = "Nouveau message depuis le formulaire de contact";
    $body = "Nom : $name\nEmail : $email\n\nMessage :\n$message";
    $headers = "From: $email\r\nReply-To: $email";

    // Envoyer l'email
    if (mail($to, $subject, $body, $headers)) {
        $success = "Votre message a été envoyé avec succès !";
    } else {
        $error = "Une erreur est survenue, veuillez réessayer.";
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/contact/contact.css">
    <link rel="stylesheet" type="text/css" href="/site_web/public/css/header/header.css">
    <title>Exploratio_nln</title>
    <link rel="icon" type="image/PNG" href="/site_web/public/img/accueil/photo_profil.png">
    <link href="https://fonts.googleapis.com/css2?family=Antonio&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container">
            <section class="contact">
                <article class="description">
                    <h1>Pour me <span class="orange">contacter</span></h1>
                    <p>Vous souhaitez en savoir plus sur les lieux présentés ou mes photos d'exploration urbaine ?
                        Je serai ravi de vous répondre.</p>
                    <p>Si vous rencontrez un problème technique ou un dysfonctionnement sur le site, merci de me le
                        signaler afin que je puisse corriger rapidement.</p>
                    <p>Pour tout autre avis, idée ou suggestion, n'hésitez pas à me contacter : vos retours sont
                        précieux pour améliorer le site.</p>
                </article>
                <article class="formulaire">
                    <?php
                    if (isset($success)) {
                        echo "<p class='success'>$success</p>";
                    } elseif (isset($error)) {
                        echo "<p class='error'>$error</p>";
                    }
                    ?>
                    <form action="" method="post">
                        <article>
                            <label for="name">Nom :</label>
                            <input type="text" id="name" name="name" placeholder="Votre nom" required>
                        </article>
                        <article>
                            <label for="email">Email :</label>
                            <input type="email" id="email" name="email" placeholder="Votre email" required>
                        </article>
                        <article>
                            <label for="message">Message :</label>
                            <textarea id="message" name="message" placeholder="Votre message..." rows="6" required></textarea>
                        </article>
                        <article>
                            <button type="submit">Envoyer</button>
                        </article>
                    </form>
                </article>
            </section>
        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>