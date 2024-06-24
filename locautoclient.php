<!DOCTOTYPE HTML>
<html>
</html>
<head>
<title>Liste client</title>
</head>
<body>
<?php
// valeur retournée par le formulaire de sélection
try {
$connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root','');
$requete = 'SELECT nom, prenom, client.adresse, type_de_client.libelle
FROM client
JOIN type_de_client USING (id_type_de_client)';
$resultat = $connexion->query($requete);

echo "<table>\n";
echo "\t<tr><th>Nom</th>

    <th>Prénom</th>
    
    <th>Adresse</th>

    <th>Type client</th></tr\n>";
while ($ligne = $resultat->fetch()) {
    echo "\t<tr>\n";

    echo "\t\t<td>" . $ligne["nom"]. "</td>\n";

    echo "\t\t<td>" . $ligne["prenom"]. "</td>\n";

    echo "\t\t<td>" . $ligne["adresse"]. "</td>\n";

    echo "\t\t<td>" . $ligne["libelle"]. "</td>\n";

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