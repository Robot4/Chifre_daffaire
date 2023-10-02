<?php
// Establish a database connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ca";

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_POST["id"])) {
    $client_id = $_POST["id"];

    // Retrieve client data based on $client_id
    $sql = "SELECT * FROM clients WHERE id = $client_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Generate the edit form HTML with pre-filled data
        echo '<div class="edite">';

        echo '<form id="editClientForm" action="update_client.php" method="POST" enctype="multipart/form-data">';
        // Include form fields similar to the "Add Client" form
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="file" name="image" accept="image/*"  value="' . $row['image'] . '">';
        echo '<br>';

        echo '<input type="text" name="name" placeholder="Name" required value="' . $row['name'] . '">';
        echo '<br>';

        echo '<input type="text" name="commande" placeholder="Commande" required value="' . $row['commande'] . '">';
        echo '<br>';

        echo '<input type="text" name="prix" placeholder="Prix" required value="' . $row['prix'] . '">';
        echo '<br>';

        echo '<input type="text" name="ville" placeholder="Ville" required value="' . $row['ville'] . '">';
        echo '<br>';

        // Dropdown for status
        echo '<select name="status" required>';
        echo '<option value="Demandé" ' . ($row['status'] == 'Demandé' ? 'selected' : '') . '>Demandé</option>';
        echo '<option value="Livré" ' . ($row['status'] == 'Livré' ? 'selected' : '') . '>Livré</option>';
        echo '<option value="Retour" ' . ($row['status'] == 'Retour' ? 'selected' : '') . '>Retour</option>';
        echo '<option value="Refusé" ' . ($row['status'] == 'Refusé' ? 'selected' : '') . '>Refusé</option>';
        echo '</select>';

        // Include other form fields and submit button
        echo '<input class="send" type="submit" value="Update Client">';
        echo '</form>';
        echo '</div>';

    } else {
        echo "Client not found.";
    }
} else {
    echo "Invalid client ID.";
}

// Close the database connection
$conn->close();

