<!DOCTYPE HTML>
<html>
<head>
    <h2>Ajouter une voiture</h2>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">

    <label for="modele">Modèle :</label>
<select name="modele" id="modele" required>
    <option value="1">Modèle 1</option>
    <option value="2">Modèle 2</option>
    <!-- Ajoutez d'autres options pour les modèles existants -->
</select><br>


        <label for="immatriculation">Immatriculation :</label>
        <input type="text" name="immatriculation" id="immatriculation" required><br>

        <label for="marque">Marque :</label>
        <input type="text" name="marque" id="marque" required><br>

        <label for="prix">Prix :</label>
        <input type="text" name="prix" id="prix" required><br>

        <label for="compteur">Compteur :</label>
        <input type="text" name="compteur" id="compteur" required><br>

        <label for="image">Image :</label>
        <input type="file" name="image" id="image" required><br>

        <input type="submit" name="ajouter" value="Ajouter la voiture">
    </form>

    <?php
    if (isset($_POST["ajouter"])) {
        $immatriculation = $_POST["immatriculation"] ?? "";
        $marque = $_POST["marque"] ?? "";
        $prix = $_POST["prix"] ?? "";
        $compteur = $_POST["compteur"] ?? "";
        $image = $_FILES["image"]["name"] ?? "";
        $modele = $_POST["modele"] ?? "";

try {
    // Insertion des données dans la table 'voiture'
    $requete = 'INSERT INTO voiture (immatriculation, compteur, id_modele) VALUES (?, ?, ?)';
    $stmt = $connexion->prepare($requete);
    $stmt->execute([$immatriculation, $compteur, $modele]);

    // Reste du code pour l'insertion dans la table 'categorie' et affichage du message de succès
    // ...
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

        try {
            $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
            $requete = 'INSERT INTO voiture (immatriculation, compteur) VALUES (?, ?)';
            $stmt = $connexion->prepare($requete);
            $stmt->execute([$immatriculation, $compteur]);

            $id_voiture = $connexion->lastInsertId(); // Récupère l'ID de la dernière voiture insérée

            $requeteCategorie = 'INSERT INTO categorie (id_voiture, prix) VALUES (?, ?)';
            $stmtCategorie = $connexion->prepare($requeteCategorie);
            $stmtCategorie->execute([$id_voiture, $prix]);

            echo "La voiture a été ajoutée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    ?>
</body>
</html>
