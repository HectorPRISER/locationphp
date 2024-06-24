<?php
// valeur retournée par le formulaire d'ajout
$immat = $_POST["immatriculation"];
// Récupérez les autres informations de la voiture à partir de $_POST

try {
    $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
    $requete = 'INSERT INTO voiture (immatriculation, ... autres_champs) VALUES (?, ...)';
    $stmt = $connexion->prepare($requete);
    $stmt->execute([$immat, ... autres_valeurs]);

    echo "La voiture a été ajoutée avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>
<?php
// valeur retournée par le formulaire d'ajout
$immat = $_POST["immatriculation"];
// Récupérez les autres informations de la voiture à partir de $_POST

try {
    $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
    $requete = 'INSERT INTO voiture (immatriculation, ... autres_champs) VALUES (?, ...)';
    $stmt = $connexion->prepare($requete);
    $stmt->execute([$immat, ... autres_valeurs]);

    echo "La voiture a été ajoutée avec succès.";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}
?>
