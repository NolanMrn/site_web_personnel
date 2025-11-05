<?php
require_once 'fonctions.php';
initVenv();

$host = $_ENV['BD_HOST'];
$user = $_ENV['BD_USER'];
$pass = $_ENV['BD_PASSWORD'];
$db = $_ENV['BD_DATABASE_NAME'];

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>