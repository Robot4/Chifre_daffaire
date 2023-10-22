<?php
// Establish a new database connection (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $client_id = $_GET["id"];

    // Delete the client with the provided ID from the database
    $sql = "DELETE FROM clients WHERE id = $client_id";

    if ($conn->query($sql) === TRUE) {
        // Client deleted successfully
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'sortie.php';

        // Redirect back to the referring page
        header("Location: $referrer");
        exit();
    } else {
        echo "Error deleting client: " . $conn->error;
    }
} else {
    echo "Invalid client ID.";
}

// Close the database connection
$conn->close();
?>
