<?php
include 'db.php';


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

// SQL query to select clients with 'Demandé' status and order by status


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


// SQL query to select clients and order by status
$sql = "SELECT * FROM clients
        ORDER BY CASE 
            WHEN status = 'Demandé' THEN 1 
            ELSE 2 
        END, name ASC
        LIMIT $startIndex, $perPage";
$result = $conn->query($sql);




if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search_query'])) {
    $searchQuery = $_GET['search_query'];

    // SQL query to search clients by name or ville
    $searchSql = "SELECT * FROM clients WHERE name LIKE '%" . $searchQuery . "%' OR ville LIKE '%" . $searchQuery . "%'";

    $result = $conn->query($searchSql);

}

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect to the login page after logging out
    exit;
}
?>





    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8" />
        <title>Achat</title>
        <link rel="stylesheet" href="css/sortie.css" />
        <!-- Font Awesome Cdn Link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/icon.jpg" type="image/jpg"> <!-- For .png format -->



    </head>
    <body>
    <div class="container">
        <?php include 'menu.php'; ?>
        <section class="main">
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

                <!-- Modify the Ville input to a <select> with options -->
                <select class="ville" name="ville" required>
                    <option value="" disabled selected>Select Ville</option>
                    <?php
                    // Establish a database connection (similar to your existing code)
                    // ...

                    // SQL query to select "ville" options from the ville_price table
                    $sqlVilleOptions = "SELECT ville FROM ville_price";
                    $villeOptionsResult = $conn->query($sqlVilleOptions);

                    if ($villeOptionsResult->num_rows > 0) {
                        while ($villeRow = $villeOptionsResult->fetch_assoc()) {
                            echo "<option value='" . $villeRow["ville"] . "'>" . $villeRow["ville"] . "</option>";

                        }
                    }


                    ?>
                </select>

                <select class="ville" name="status" required>
                    <option value="Demandé">Demandé</option>
                    <option value="Livré">Livré</option>
                    <option value="Retour">Retour</option>
                    <option value="Refusé">Refusé</option>

                </select>
                <input class="send" type="submit" value="Add Client">
            </form>
        </div>
    </div>



    <div class="search-bar">
        <form method="GET">
            <input class="cherch" type="text" name="search_query" id="searchQuery" placeholder="Search by Name or Ville" required>
        </form>
    </div>

    <script>
        // Get the search input element
        const searchInput = document.getElementById('searchQuery');

        // Listen for the "Enter" keypress
        searchInput.addEventListener('keyup', function (event) {
            if (event.key === 'Enter') {
                // Prevent the default form submission
                event.preventDefault();

                // Trim and get the search query
                const searchQuery = searchInput.value.trim();

                // Check if the search query is not empty before performing the search
                if (searchQuery) {
                    // Perform the search by redirecting to the search URL
                    window.location.href = `sortie.php?search_query=${searchQuery}`;
                }
            }
        });
    </script>


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
                            echo "<td><img src='" . $row["image"] . "' alt='Client Image' width='80'></td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["commande"] . "</td>";
                            echo "<td>" . $row["prix"] . "</td>";
                            echo "<td>" . $row["ville"] . "</td>";
                            // Apply different styles based on the status
                            $statusClass = "";

                            switch ($row["status"]) {
                                case "Demandé":
                                    $statusClass = "demande";
                                    break;
                                case "Livré":
                                    $statusClass = "livre";
                                    break;
                                case "Retour":
                                    $statusClass = "retour";
                                    break;
                                case "Refusé":
                                    $statusClass = "refuse";
                                    break;
                            }

                            // Add a class to the <td> element to style it as a button
                            echo "<td>";
                            echo "<center>";

                            echo "<button class='status-button $statusClass'>" . $row["status"] . "</button>";

                            echo "</center>";
                            echo "</td>";
                            // Add an edit button with a data-client-id attribute
                            echo "<td class='icon-container'><a href='javascript:void(0);' class='edit-client' data-client-id='" . $row["id"] . "'><i class='fas fa-edit'></i>Edit</a>
                                    <a href='delete_client.php?id=" . $row["id"] . "'><i class='fas fa-trash'></i>Delete</a></td>";



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
            $perPage = 4;
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