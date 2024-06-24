<!DOCTOTYPE HTML>
<html>
</html>
<head>
<title>Liste voitures</title>
</head>
<body>
<?php
// valeur retournée par le formulaire de sélection
try {
$connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root','');
$requete = 'SELECT voiture.immatriculation, marque.libelle AS marque, modele.libelle AS modele ,image
FROM voiture
JOIN modele USING (id_modele)
JOIN marque USING (id_marque)';
$resultat = $connexion->query($requete);

echo "<table>\n";
echo "\t<tr><th>marque</th>

    <th>modele</th>
    
    <th>image</th></tr\n>";
while ($ligne = $resultat->fetch()) {
    echo "\t<tr>\n";

    echo "\t\t<td>" . $ligne["marque"]. "</td>\n";

    echo "\t\t<td>" . $ligne["modele"]. "</td>\n";

    echo "\t\t<td><a href='projetlocautodonnevoiture.php?immatriculation=" . $ligne["immatriculation"] . "'><img src='images/" . $ligne["image"] . "'></a></td>\n";


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