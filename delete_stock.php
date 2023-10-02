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
    $sql = "DELETE FROM stock WHERE id = $client_id";

    if ($conn->query($sql) === TRUE) {
        // Client deleted successfully, perform the redirection
        header("Location: stock.php");
        exit(); // Make sure to exit to prevent further execution of the script
    } else {
        echo "Error deleting client: " . $conn->error;
    }
} else {
    echo "Invalid client ID.";
}

// Close the database connection
$conn->close();
?>
