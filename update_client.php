<?php
// Establish a database connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and perform validation
    $client_id = $_POST["id"];
    $name = $_POST["name"];
    $commande = $_POST["commande"];
    $prix = floatval($_POST["prix"]); // Convert to float
    $ville = $_POST["ville"];
    $status = $_POST["status"];

    // Check if a new image file was uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Define the target directory for uploading images
        $targetDir = "images/";

        // Generate a unique filename for the uploaded image
        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);

        // Define the full path to the uploaded file
        $targetFilePath = $targetDir . $fileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Update the client's image path in the database
            $sql = "UPDATE clients SET image = ? WHERE id = ?";

            // Prepare and bind the SQL statement
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }

            // Bind parameters
            $stmt->bind_param("si", $targetFilePath, $client_id);

            // Execute the statement to update the image path
            if (!$stmt->execute()) {
                echo "Error updating client image: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error uploading the new image.";
        }
    }

    // Update the other client information in the database (excluding the image)
    $sql = "UPDATE clients SET name = ?, commande = ?, prix = ?, ville = ?, status = ? WHERE id = ?";

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssdssi", $name, $commande, $prix, $ville, $status, $client_id);

    // Execute the statement to update other client information
    if ($stmt->execute()) {
        echo "Client updated successfully.";
        header("Location: sortie.php");

    } else {
        echo "Error updating client: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
