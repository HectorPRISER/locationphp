<!DOCTYPE HTML>
<html>
<head>
    <title>Liste voitures</title>
</head>
<body>
    <?php
    try {
        $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root','');
        $requete = 'SELECT marque.libelle AS marque, modele.libelle AS modele, image, immatriculation
        FROM voiture
        JOIN modele USING (id_modele)
        JOIN marque USING (id_marque)';
        $resultat = $connexion->query($requete);
    
        echo "<table>\n";
        echo "\t<tr>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>\n";
    
        while ($ligne = $resultat->fetch()) {
            echo "\t<tr>\n";
    
            echo "\t\t<td>" . $ligne["marque"] . "</td>\n";
            echo "\t\t<td>" . $ligne["modele"] . "</td>\n";
            echo "\t\t<td><img src='images/" . $ligne["image"] . "'></td>\n";
            echo "\t\t<td>
                <form method='POST' action=''>
                    <input type='hidden' name='immatriculation' value='" . $ligne["immatriculation"] . "'>
                    <button type='submit' name='supprimer'>Supprimer</button>
                </form>
            </td>\n";
    
            echo "\t</tr>\n";
        }
    
        echo "</table>";
    
        // Traitement de la suppression de la voiture
        if (isset($_POST["supprimer"])) {
            $immat = $_POST["immatriculation"];
            try {
                $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
                $requeteSuppression = 'DELETE FROM voiture WHERE immatriculation = ?';
                $stmtSuppression = $connexion->prepare($requeteSuppression);
                $stmtSuppression->execute([$immat]);
    
                echo "La voiture a été supprimée avec succès.";
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                die();
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    </body>
    </html>
    