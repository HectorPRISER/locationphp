<!DOCTYPE HTML>
<html>
<head>
<title>Infos voitures</title>
</head>
<body>
<?php
if (isset($_GET["immatriculation"])) {
    // valeur retournée par le formulaire de sélection
    $immat = $_GET["immatriculation"];
    try {
        $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
        $requete = 'SELECT immatriculation, marque.libelle AS marque, modele.libelle AS modele, image, prix, categorie.libelle AS categorie, compteur AS voiture
        FROM voiture
        JOIN modele USING (id_modele)
        JOIN marque USING (id_marque)
        JOIN categorie USING (id_categorie)
        WHERE immatriculation = ?';
        $stmt = $connexion->prepare($requete);
        $stmt->execute([$immat]);
        $voiture = $stmt->fetch();

        if ($voiture) {
            echo "<table>\n";
            echo "\t<tr><th>Immatriculation</th>
                <th>modele</th>
                <th>marque</th>
                <th>prix</th>
                <th>compteur</th>
                <th>image</th></tr>\n";
            echo "\t<tr>\n";
            echo "\t\t<td>" . $voiture["immatriculation"] . "</td>\n";
            echo "\t\t<td>" . $voiture["modele"] . "</td>\n";
            echo "\t\t<td>" . $voiture["marque"] . "</td>\n";
            echo "\t\t<td>" . $voiture["prix"] . "</td>\n";
            echo "\t\t<td>" . $voiture["voiture"] . "</td>\n";
            echo "\t\t<td><img src='images/" . $voiture["image"] . "'></td>\n";
            echo "\t</tr>\n";
            echo "</table>\n";
        } else {
            echo "Aucune voiture trouvée avec l'immatriculation spécifiée.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
}
?>
</body>
</html>
