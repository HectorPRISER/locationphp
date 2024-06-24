<?php
// valeur retournée par le paramètre dans l'URL
$immat = $_GET["immatriculation"];

try {
    $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
    $requete = 'DELETE FROM voiture WHERE immatriculation = ?';
    $stmt = $connexion->prepare($requete);
    $stmt->execute([$immat]);

    echo "La voiture a été supprimée avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>
