<?php
// Connexion à la base de données PostgreSQL
$host = "localhost";
$dbname = "bddGRATOSweb";
$user = "postgres";
$password = "ILYASS";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['fullName'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Préparer la requête d'insertion
    $sql = "INSERT INTO contact_messages (full_name, email, message) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $sql, [$full_name, $email, $message]);

    if ($result) {
        echo "Message envoyé avec succès!";
    } else {
        echo "Erreur lors de l'envoi du message: " . pg_last_error($conn);
    }
}
?>
