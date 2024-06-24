<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $typeClient = $_POST['type_client'];

        $requete = "INSERT INTO client (nom, prenom, adresse, id_type_de_client)
                    VALUES (:nom, :prenom, :adresse, :type_client)";
        $statement = $connexion->prepare($requete);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':prenom', $prenom);
        $statement->bindParam(':adresse', $adresse);
        $statement->bindParam(':type_client', $typeClient);

        if ($statement->execute()) {
            echo "Le client a été ajouté avec succès.";
        } else {
            echo "Une erreur est survenue lors de l'ajout du client.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Ajouter un client</title>
</head>
<body>
    <h1>Ajouter un client</h1>
    <form method="POST" action="">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" name="adresse" required><br>

        <label for="type_client">Type de client:</label>
        <select id="type_client" name="type_client" required>
            <option value="1">Particulier</option>
            <option value="2">Entreprise</option>
            <option value="3">Administration</option>
            <option value="4">Association</option>
            <option value="5">Longue duree</option>
            <!-- Add more options if needed -->
        </select><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>