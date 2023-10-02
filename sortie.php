<?php
// Establish a database connection (replace with your database credentials)
session_start(); // Start a session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all records from the 'clients' table
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);


// SQL query to select clients with 'Livré' or 'Refusé' status from 'clients' table
$sqlMoveToEntrer = "INSERT INTO entrer (image, name, commande, prix, ville, status)
                     SELECT image, name, commande, prix, ville, status
                     FROM clients
                     WHERE status IN ('Livré', 'Refusé')
                     AND moved_to_entrer = 0"; // Add a condition to check if not moved

if ($conn->query($sqlMoveToEntrer) === TRUE) {
    // Update the 'moved_to_entrer' field for the moved records
    $updateMovedFlag = "UPDATE clients
                         SET moved_to_entrer = 1
                         WHERE status IN ('Livré', 'Refusé')
                         AND moved_to_entrer = 0";

    if ($conn->query($updateMovedFlag) === TRUE) {
    } else {
        echo "Error updating 'moved_to_entrer' flag: " . $conn->error;
    }
} else {
    echo "Error moving data to 'entrer' table: " . $conn->error;
}


// SQL query to select clients with 'Livré' or 'Refusé' status from 'clients' table
$sqlMoveToEntrer = "INSERT INTO stock (image, name, commande, prix, ville, status)
                     SELECT image, name, commande, prix, ville, status
                     FROM clients
                     WHERE status IN ('Retour')
                     AND moved_to_entrer = 0"; // Add a condition to check if not moved

if ($conn->query($sqlMoveToEntrer) === TRUE) {
    // Update the 'moved_to_entrer' field for the moved records
    $updateMovedFlag = "UPDATE clients
                         SET moved_to_entrer = 1
                         WHERE status IN ('Retour')
                         AND moved_to_entrer = 0";

    if ($conn->query($updateMovedFlag) === TRUE) {
    } else {
        echo "Error updating 'moved_to_entrer' flag: " . $conn->error;
    }
} else {
    echo "Error moving data to 'entrer' table: " . $conn->error;
}

// SQL query to select clients with 'Refusé' status from 'clients' table
$sqlMoveToStock = "INSERT INTO stock (image, name, commande, prix, ville, status)
                     SELECT image, name, commande, prix, ville, status
                     FROM clients
                     WHERE status = 'Refusé'
                     AND moved_to_stock = 0"; // Add a condition to check if not moved

if ($conn->query($sqlMoveToStock) === TRUE) {
    // Update the 'moved_to_stock' field for the moved records
    $updateMovedFlag = "UPDATE clients
                         SET moved_to_stock = 1
                         WHERE status = 'Refusé'
                         AND moved_to_stock = 0";

    if ($conn->query($updateMovedFlag) === TRUE) {
    } else {
        echo "Error updating 'moved_to_stock' flag: " . $conn->error;
    }
} else {
    echo "Error moving data to 'stock' table: " . $conn->error;
}










// Calculate the total number of clients
$sqlCount = "SELECT COUNT(*) AS total FROM clients";
$countResult = $conn->query($sqlCount);
$countRow = $countResult->fetch_assoc();
$totalClients = $countRow['total'];

// Calculate the current page and the starting index
$perPage = 4;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

$startIndex = ($currentPage - 1) * $perPage;

// SQL query to select a limited number of records based on the current page
$sql = "SELECT * FROM clients LIMIT $startIndex, $perPage";
$result = $conn->query($sql);
?>



    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8" />
        <title>Dashboard | By Code Info</title>
        <link rel="stylesheet" href="css/sortie.css" />
        <!-- Font Awesome Cdn Link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
    <div class="container">
        <?php include 'menu.php'; ?>
        <section class="main">
            <h1>Client Table</h1>
            <center>
                <button id="showFormButton" class="add">
                    <i class="fas fa-plus"></i> Ajouter
                </button>
                <br>
                <br>
            </center>

<div class="container1">
            <div class="form">
                <!-- Add the "Ajouter" button -->

                <!-- Container for the form to add a new client (initially hidden) -->
                <div class="add-client-container" id="addClientContainer" style="display: none;">
                    <form action="add_client.php" method="POST" enctype="multipart/form-data" class="login-form">
                        <input type="file" name="image" accept="image/*" required>
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="text" name="commande" placeholder="Commande" required>
                        <input type="text" name="prix" placeholder="Prix" required>
                        <input type="text" name="ville" placeholder="Ville" required>
                        <select name="status" required>
                            <option value="Demandé">Demandé</option>
                            <option value="Livré">Livré</option>
                            <option value="Retour">Retour</option>
                            <option value="Refusé">Refusé</option>
                        </select>
                        <input class="send" type="submit" value="Add Client">
                    </form>
                </div>
            </div>
</div>

            <div id="editClientModal" class="modal">
                <div class="modal-content">
                    <span class="close" id="closeEditModal">&times;</span>
                    <div id="editClientForm">
                        <!-- Edit form content will be injected here -->
                    </div>
                </div>
            </div>




            <!-- Your existing table code with headers -->
                <table>
                    <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Nom</th>
                        <th>Commande</th>
                        <th>Prix</th>
                        <th>Ville</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Display the image using an <img> tag
                            echo "<td><img src='" . $row["image"] . "' alt='Client Image' width='50'></td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["commande"] . "</td>";
                            echo "<td>" . $row["prix"] . "</td>";
                            echo "<td>" . $row["ville"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            // Add an edit button with a data-client-id attribute
                            echo "<td class='icon-container'><a href='javascript:void(0);' class='edit-client' data-client-id='" . $row["id"] . "'><i class='fas fa-edit'></i>Edit</a><a href='delete_client.php?id=" . $row["id"] . "'><i class='fas fa-trash'></i>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No clients found.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>

            <?php
            // Calculate the total number of clients and the current page
            $perPage = 5;
            if (isset($_GET['page'])) {
                $currentPage = $_GET['page'];
            } else {
                $currentPage = 1;
            }


            // Calculate the starting client index for the current page
            $startIndex = ($currentPage - 1) * $perPage;

            // SQL query to select a limited number of records based on the current page
            $sql = "SELECT * FROM clients LIMIT $startIndex, $perPage";
            $result = $conn->query($sql);
            echo '<div class"here">';
            if ($currentPage > 1) {
                echo "<a class=dd href='sortie.php?page=" . ($currentPage - 1) . "'>Previous</a>";
            }

            // Display "Next" button if there are more clients to show
            $sqlCount = "SELECT COUNT(*) AS total FROM clients";
            $countResult = $conn->query($sqlCount);
            $countRow = $countResult->fetch_assoc();
            $totalClients = $countRow['total'];

            if ($totalClients > $startIndex + $perPage) {
                echo "<a class=dd href='sortie.php?page=" . ($currentPage + 1) . "'>Next</a>";
            }

            echo '<div/>'

            // Close the database connection here, at the end of the script
            ?>


            </div>
            <script>


                // JavaScript code to toggle form visibility with a smooth animation
                const showFormButton = document.getElementById('showFormButton');
                const addClientContainer = document.getElementById('addClientContainer');

                showFormButton.addEventListener('click', function () {
                    if (addClientContainer.style.display === 'none' || addClientContainer.style.display === '') {
                        // Show the container with a smooth animation
                        addClientContainer.style.opacity = '0';
                        addClientContainer.style.display = 'block';
                        setTimeout(function () {
                            addClientContainer.style.opacity = '1';
                        }, 10); // Delay to allow the display property to take effect
                    } else {
                        // Hide the container with a smooth animation
                        addClientContainer.style.opacity = '0';
                        setTimeout(function () {
                            addClientContainer.style.display = 'none';
                        }, 300); // Delay to match the CSS transition duration (300ms)
                    }
                });

            </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Define the openEditForm function in the global scope
        function openEditForm(clientId) {
            // Use AJAX to fetch client data
            $.ajax({
                url: 'fetch_client_data.php',
                type: 'POST',
                data: { id: clientId },
                success: function(response) {
                    // Inject the form HTML with pre-filled data
                    var editClientForm = document.getElementById('editClientForm');
                    if (editClientForm) {
                        editClientForm.innerHTML = response;
                    }
                },
                error: function() {
                    alert('Error fetching client data.');
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const editButtons = document.querySelectorAll(".edit-client");
            const editClientModal = document.getElementById("editClientModal");
            const closeEditModal = document.getElementById("closeEditModal");
            const editClientForm = document.getElementById("editClientForm");

            editButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const clientId = this.getAttribute("data-client-id");
                    openEditForm(clientId);
                });
            });

            closeEditModal.addEventListener("click", function () {
                editClientModal.style.display = "none";
            });

            function openEditForm(clientId) {
                // Use AJAX to fetch client data
                $.ajax({
                    url: 'fetch_client_data.php',
                    type: 'POST',
                    data: { id: clientId },
                    success: function(response) {
                        // Inject the form HTML with pre-filled data
                        if (editClientForm) {
                            editClientForm.innerHTML = response;
                        }

                        // Show the modal with a slow animation
                        editClientModal.style.display = "block";
                    },
                    error: function() {
                        alert('Error fetching client data.');
                    }
                });
            }
        });

    </script>
        </section>




    </div>
    </body>
    </html>

<?php
// Close the database connection
$conn->close();
?>