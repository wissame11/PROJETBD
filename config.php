<?php
$host = 'db'; //  c’est le nom du service MySQL dans ton docker-compose
$dbname = 'test-tremplin';
$username = 'root';
$password = 'verysecurepassword'; //  même mot de passe que dans docker-compose

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
