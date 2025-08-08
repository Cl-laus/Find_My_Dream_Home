<?php session_start();
require_once 'includes/_pdo_connect.php';

// Récupérer l'ID et le role de l'utilisateur connecté, recuperés dans login

$user_id   = $_SESSION['id'];
$user_role = $_SESSION['role'];
$articleId = $_GET['id'];

// Récupérer l'user_id de l'articlde dans la BDD pour verifier si il a droit de modifier
 $sql = 'SELECT user_id
            FROM listing 
            
            WHERE id = :articleId';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT); // securise
    $stmt->execute();

    $product = $stmt->fetch();

// Vérifier si l'utilisateur à les droits
if (empty($_SESSION['isLoggedIn']) || ! ($user_role === "admin" || $user_id === $product['user_id'])) {
    //  redirection si pas les droits de modifier
    $_SESSION['index_message'] = "Vous devez être connecté en tant qu'admin ou etre le créateur pour supprimer cette annonce.";
    header('Location: index.php');
    exit;

} else {
    //suppresion de la base de données
    $query = 'DELETE FROM listing 
             WHERE id = :articleId';

    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':articleId', $articleId, PDO::PARAM_INT); // securise
    $stmt->execute();

    //renvoi a la page Index avec message
    $_SESSION['index_message'] = "Votre annonce a bien été supprimée.";
    header('Location: index.php');
}
