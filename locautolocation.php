<!DOCTOTYPE HTML>
<html>
</html>
<head>
<title>Liste location</title>
</head>
<body>
<?php
// valeur retournée par le formulaire de sélection
try {
$connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root','');
$requete = 'SELECT *
FROM location';
$resultat = $connexion->query($requete);

echo "<table>\n";
echo "\t<tr><th>Date début</th>

    <th>Date fin</th>
    
    <th>Compteur début</th>

    <th>Compteur fin</th>

    <th></th>Compteur fin</tr>";
while ($ligne = $resultat->fetch()) {
    echo "\t<tr>\n";

    echo "\t\t<td>" . $ligne["date_debut"]. "</td>\n";

    echo "\t\t<td>" . $ligne["date_fin"]. "</td>\n";

    echo "\t\t<td>" . $ligne["compteur_debut"]. "</td>\n";

    echo "\t\t<td>" . $ligne["compteur_fin"]. "</td>\n";

    echo "\t</tr>\n";
}
echo "</table>";
} catch (PDOException $e) {
echo "Erreur : " . $e->getMessage() . "<br/>";
die();
}

?>
</body>
</html>