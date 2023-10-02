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

// Check if a file was uploaded successfully
if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    // Define the target directory for uploading images
    $targetDir = "images/";

    // Generate a unique filename for the uploaded image
    $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);

    // Define the full path to the uploaded file
    $targetFilePath = $targetDir . $fileName;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        // Retrieve data from the HTML form
        $name = $_POST["name"];
        $commande = $_POST["commande"];
        $prix = $_POST["prix"];
        $ville = $_POST["ville"];
        $status = $_POST["status"];

        // SQL query to insert data into the 'clients' table
        $sql = "INSERT INTO clients (image, name, commande, prix, ville, status) 
                VALUES ('$targetFilePath', '$name', '$commande', $prix, '$ville', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "Client added successfully.";
            header("Location: sortie.php");

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the image.";
    }
} else {
    echo "No image file uploaded.";
}
// Close the database connection
$conn->close();
?>
