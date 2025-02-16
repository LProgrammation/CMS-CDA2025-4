<?php
// CONNEXION VARIABLE IMPORTANT
$servername = "localhost"; // Modify servername if not localhost
$username = "root";
$password = "root"; // Modify password used for root user
$dbname = 'cms_cda2025_4'; // Modify is you want another database name

$conn = new mysqli($servername, $username, $password);

// CHECK CONNEXION
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// CREATE DATABASE
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Base de données créée avec succès ou déjà existante \n";
} else {
    echo "Erreur lors de la création de la base de données : " . $conn->error . "\n";
}

// SELECT DATABASE
$conn->select_db($dbname);

$sql = file_get_contents('./ressources/bddSQL.sql');

// INSERT TABLES AND DATAS IN DATABASE
if ($conn->multi_query($sql)) {
    echo "Script exécuté avec succès";
} else {
    echo "Erreur: " . $conn->error;
}

$conn->close();
?>