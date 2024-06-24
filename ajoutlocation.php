<!DOCTYPE html>
<html>
<head>
<title>Ajouter une location</title>
</head>
<body>
<?php
// valeur retournée par le formulaire de sélection
try {
    $connexion = new PDO('mysql:host=localhost;port=3306;dbname=locauto2', 'root', '');
    
    // Code for retrieving clients
    $requeteClients = 'SELECT id_client, nom, prenom FROM client';
    $resultatClients = $connexion->query($requeteClients);
    $clients = $resultatClients->fetchAll(PDO::FETCH_ASSOC);

    // Code for retrieving options
    $requeteOptions = 'SELECT id_option, libelle FROM choix_option';
    $resultatOptions = $connexion->query($requeteOptions);
    $options = $resultatOptions->fetchAll(PDO::FETCH_ASSOC);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the selected client ID and options from the form
        $clientId = $_POST['client'];
        $selectedOptions = $_POST['choix_option'];
        
        // Perform the rental insertion
        $requeteInsertion = 'INSERT INTO location (id_client) VALUES (:id_client)';
        $statement = $connexion->prepare($requeteInsertion);
        $statement->bindParam(':id_client', $clientId);
        $statement->execute();
        
        // Get the last inserted rental ID
        $rentalId = $connexion->lastInsertId();
        
        // Insert the selected options into the rental_options table
        $requeteOptionsLocation = 'INSERT INTO rental_options (id_location, id_option) VALUES (:id_location, :id_option)';
        $statementOptions = $connexion->prepare($requeteOptionsLocation);
        
        foreach ($selectedOptions as $optionId) {
            $statementOptions->bindParam(':id_location', $rentalId);
            $statementOptions->bindParam(':id_option', $optionId);
            $statementOptions->execute();
        }
        
        echo "Location ajoutée avec succès!";
    }
?>

<form method="POST" action="">
    <label for="client">Client:</label>
    <select name="client" id="client">
        <?php foreach ($clients as $client): ?>
            <option value="<?php echo $client['id_client']; ?>"><?php echo $client['nom'] . ' ' . $client['prenom']; ?></option>
        <?php endforeach; ?>
    </select>

    <br>
    <label for="choix_option">Options:</label>
    <select name="choix_option[]" id="choix_option" multiple>
        <?php foreach ($options as $option): ?>
            <option value="<?php echo $option['id_option']; ?>"><?php echo $option['libelle']; ?></option>
        <?php endforeach; ?>
    </select>
    
    <br>
    <input type="submit" value="Ajouter la location">
</form>

<?php
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
?>
</body>
</html>