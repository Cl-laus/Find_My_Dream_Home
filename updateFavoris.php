<?php session_start();
require_once 'includes/_pdo_connect.php';

// Récupérer les ID

$user_id = $_SESSION['id'];

$articleId = $_GET['id'];

// Vérifier si l'utilisateur à les droits
if (empty($_SESSION['isLoggedIn'])) {
    //  redirection si pas connecte/ tous le monde a le droit
    $_SESSION['index_message'] = "Vous devez être connecté pour ajouter en favori cette annonce.";
    header('Location: index.php');
    exit;

}

// Récupére toutes les annonces en favoris de l'utilisateur et renvoi true/false

$sql  = "SELECT * FROM favoris WHERE user_id = :user_id AND listing_id = :listing_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':listing_id', $articleId, PDO::PARAM_INT);
$stmt->execute();
$isFavorited = $stmt->fetch(); // renvoi un ligne si elle existe(equivaut a true) sinon renvoi false

if ($isFavorited) {
    // Si déjà favori, on supprime la ligne
    $sql  = "DELETE FROM favoris WHERE user_id = :user_id AND listing_id = :listing_id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':listing_id', $articleId, PDO::PARAM_INT);

    $stmt->execute();


    //renvoi a la page Index avec message
    $_SESSION['index_message'] = "Annonce retirée des favoris.";
    header('Location: index.php');


} else {
    $now = date('Y-m-d H:i:s'); // au format sql
   $sql = "INSERT INTO favoris (user_id, listing_id, created_at) VALUES (:user_id, :listing_id, :created_at)";

    $stmt = $pdo->prepare($sql);
    // LIE LES VALEURS, pour secure
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':listing_id', $articleId);
    $stmt->bindValue(':created_at', $now);

    $stmt->execute();

      //renvoi a la page Index avec message
    $_SESSION['index_message'] = "Annonce ajoutée des favoris.";
    header('Location: index.php');

}
