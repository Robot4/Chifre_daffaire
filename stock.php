<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Code Info</title>
    <link rel="stylesheet" href="css/sortie.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
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
                            <option value="Refusé">Refusé</option>
                            <option value="Retour">Retour</option> <!-- Add 'Retour' option -->
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
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ca";

            // Create a new database connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['status']) && $_POST['status'] == 'Retour') {
                    $image = $_POST['image'];
                    $name = $_POST['name'];
                    $commande = $_POST['commande'];
                    $prix = $_POST['prix'];
                    $ville = $_POST['ville'];
                    $status = $_POST['status'];

                    // Insert data into the "stock" table
                    $sql = "INSERT INTO stock (image, name, commande, prix, ville, status) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssssss", $image, $name, $commande, $prix, $ville, $status);

                    if ($stmt->execute()) {
                        // Data inserted successfully into the "stock" table
                        echo "Data inserted into stock table.";
                    } else {
                        echo "Error inserting data into stock table: " . $conn->error;
                    }

                }
            }

            // Rest of your code to fetch and display data from the "stock" table
            // ...

            // Close the database connection
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
        $sql = "SELECT * FROM entrer LIMIT $startIndex, $perPage";
        $result = $conn->query($sql);
        echo '<div class="here">';
        if ($currentPage > 1) {
            echo "<a class='dd' href='entre.php?page=" . ($currentPage - 1) . "'>Previous</a>";
        }

        // Display "Next" button if there are more clients to show
        $sqlCount = "SELECT COUNT(*) AS total FROM entrer";
        $countResult = $conn->query($sqlCount);
        $countRow = $countResult->fetch_assoc();
        $totalClients = $countRow['total'];

        if ($totalClients > $startIndex + $perPage) {
            echo "<a class='dd' href='entre.php?page=" . ($currentPage + 1) . "'>Next</a>";
        }

        echo '</div>';

        // Close the database connection here, at the end of the script
        $conn->close();
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
                    url: 'fetch_data_entre.php',
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
                        url: 'fetch_data_entre.php',
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