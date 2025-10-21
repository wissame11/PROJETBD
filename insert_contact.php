<?php
require_once 'config.php'; // connexion à la base

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $genre = $_POST['genre'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $option = $_POST['option'] ?? '';
    $message = $_POST['message'] ?? '';
    $dispos = $_POST['dispos'] ?? '[]'; // JSON des disponibilités


    if ($nom && $prenom && $email && $message) {
        $sql = "INSERT INTO contacts (genre, nom, prenom, email, telephone, message, created_at)
                VALUES (:genre, :nom, :prenom, :email, :telephone, :message, NOW())";
                
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':genre' => $genre,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':message' => $message
        ]);
   // Récupérer l’ID du contact ajouté
        $contact_id = $pdo->lastInsertId();

        // Enregistrer les disponibilités
        $disponibilites = json_decode($dispos, true);
        if (!empty($disponibilites)) {
            $sqlDispo = "INSERT INTO disponibilites (contact_id, jour, heure, minutes)
                         VALUES (:contact_id, :jour, :heure, :minutes)";
            $stmtDispo = $pdo->prepare($sqlDispo);

            foreach ($disponibilites as $d) {
                $stmtDispo->execute([
                    ':contact_id' => $contact_id,
                    ':jour' => $d['jour'],
                    ':heure' => $d['heure'],
                    ':minutes' => $d['minutes']
                ]);
            }
        }
        echo "<h2> Message envoyé avec succès !</h2>";
        echo "<a href='index.php'>Retour</a>";
    } else {
        echo "<p style='color:red;'>Veuillez remplir tous les champs obligatoires.</p>";
    }
}
?>
