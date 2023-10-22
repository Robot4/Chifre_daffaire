<?php
include 'db.php';

?>

<?php
function calculateTotal($conn)
{
    // Calculate the total based on the conditions
    $total = 0;

    // Query to calculate the total for "Livré" status
    $livreQuery = "SELECT SUM(prix - price) AS livré_total FROM sortie WHERE status = 'Livré'";
    $livreResult = $conn->query($livreQuery);
    $livreRow = $livreResult->fetch_assoc();
    $livreTotal = is_numeric($livreRow['livré_total']) ? $livreRow['livré_total'] : 0;

    // Query to calculate the total for "Refusé" status
    $refuseQuery = "SELECT SUM(prix - 15) AS refuse_total FROM sortie WHERE status = 'Refusé'";
    $refuseResult = $conn->query($refuseQuery);
    $refuseRow = $refuseResult->fetch_assoc();
    $refuseTotal = $refuseRow['refuse_total'];

    // Add the totals for "Livré" and "Refusé" statuses
    $total = $livreTotal + $refuseTotal;

    return $total;
}




// Check if the user is not logged in (session variable is not set)
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); // Redirect to the login page
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Ventes</title>
    <link rel="stylesheet" href="css/sortie.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="icon" href="img/icon.jpg" type="image/jpg"> <!-- For .png format -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
<div class="container">
    <?php include 'menu.php'; ?>
    <section class="main">

            <br>
            <br>
        <div class="search-bar">
            <form method="GET">
                <input class="cherch" type="text" name="search_query" id="searchQuery" placeholder="Search by Name or Ville" required>
            </form>
        </div>



        <script>
            // Get the search input element
            const searchInput = document.getElementById('searchQuery');

            // Attach the event listener to the form element
            const searchForm = searchInput.closest('form'); // Find the closest form element

            if (searchForm) {
                searchForm.addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the default form submission

                    // Trim and get the search query
                    const searchQuery = searchInput.value.trim();

                    // Check if the search query is not empty before performing the search
                    if (searchQuery) {
                        // Perform the search by redirecting to the search URL
                        window.location.href = `entre.php?search_query=${searchQuery}`;
                    }
                });
            }

        </script>



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

            if (isset($_GET['search_query'])) {
                $searchQuery = $_GET['search_query'];

                // SQL query to search clients by name or ville using a prepared statement
                $searchSql = "SELECT * FROM entrer WHERE name LIKE ? OR ville LIKE ?";

                // Prepare the statement
                $stmt = $conn->prepare($searchSql);

                if ($stmt) {
                    // Bind the search query to the placeholders
                    $searchParam = "%" . $searchQuery . "%";
                    $stmt->bind_param("ss", $searchParam, $searchParam);

                    // Execute the statement
                    $stmt->execute();

                    // Get the results
                    $result = $stmt->get_result();

                    // Close the statement
                    $stmt->close();

                    if ($result->num_rows > 0) {
                        while ($rowEntrer = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Display the image using an <img> tag
                            echo "<td><img src='" . $rowEntrer["image"] . "' alt='Client Image' width='80'></td>";
                            echo "<td>" . $rowEntrer["name"] . "</td>";
                            echo "<td>" . $rowEntrer["commande"] . "</td>";
                            echo "<td>" . $rowEntrer["prix"] . "</td>";
                            echo "<td>" . $rowEntrer["ville"] . "</td>";
                            // Apply different styles based on the status
                            $statusClass = "";

                            switch ($rowEntrer["status"]) {
                                case "Livré":
                                    $statusClass = "livre";
                                    break;
                                case "Refusé":
                                    $statusClass = "refuse";
                                    break;
                                default:
                                    // Set a default class if needed
                                    $statusClass = "default-button";
                                    break;
                            }

                            // Add a class to the <td> element to style it as a button
                            echo "<td>";
                            echo "<center>";
                            echo "<button class='status-button $statusClass'>" . $rowEntrer["status"] . "</button>";
                            echo "</center>";
                            echo "</td>";
                            // Add an edit button with a data-client-id attribute (if needed)
                            echo "<td><a href='javascript:void(0);' class='edit-client' data-client-id='" . $rowEntrer["id"] . "'><i class='fas fa-edit'></i> Edit</a> | <a href='delete_entre.php?id=" . $rowEntrer["id"] . "'><i class='fas fa-trash'></i> Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No clients with matching criteria found in 'entrer' table.</td></tr>";
                    }
                }
            }
            // If no search is performed, display the full data table
            else {
                // Continue with your regular data table processing code
                // Calculate the total number of clients
                $sqlCount = "SELECT COUNT(*) AS total FROM entrer";
                $countResult = $conn->query($sqlCount);
                $countRow = $countResult->fetch_assoc();
                $totalClients = $countRow['total'];

                // Calculate the current page and the starting index
                $perPage = 4; // Number of clients to display per page
                if (isset($_GET['page'])) {
                    $currentPage = $_GET['page'];
                } else {
                    $currentPage = 1;
                }

                $startIndex = is_numeric($currentPage) ? ($currentPage - 1) * $perPage : 0;

                // SQL query to select a limited number of records based on the current page
                $sql = "SELECT * FROM entrer ORDER BY id DESC LIMIT $startIndex, $perPage";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($rowEntrer = $result->fetch_assoc()) {
                        echo "<tr>";
                        // Display the image using an <img> tag
                        echo "<td><img src='" . $rowEntrer["image"] . "' alt='Client Image' width='80'></td>";
                        echo "<td>" . $rowEntrer["name"] . "</td>";
                        echo "<td>" . $rowEntrer["commande"] . "</td>";
                        echo "<td>" . $rowEntrer["prix"] . "</td>";
                        echo "<td>" . $rowEntrer["ville"] . "</td>";
                        // Apply different styles based on the status
                        $statusClass = "";

                        switch ($rowEntrer["status"]) {
                            case "Livré":
                                $statusClass = "livre";
                                break;
                            case "Refusé":
                                $statusClass = "refuse";
                                break;
                            default:
                                // Set a default class if needed
                                $statusClass = "default-button";
                                break;
                        }

                        // Add a class to the <td> element to style it as a button
                        echo "<td>";
                        echo "<center>";
                        echo "<button class='status-button $statusClass'>" . $rowEntrer["status"] . "</button>";
                        echo "</center>";
                        echo "</td>";
                        // Add an edit button with a data-client-id attribute (if needed)
                        echo "<td><a href='javascript:void(0);' class='edit-client' data-client-id='" . $rowEntrer["id"] . "'><i class='fas fa-edit'></i> Edit</a> | <a href='delete_entre.php?id=" . $rowEntrer["id"] . "'><i class='fas fa-trash'></i> Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No clients found in 'entrer' table.</td></tr>";
                }
            }

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
        $sqlCount = "SELECT COUNT(*) AS total FROM entrer";
        $countResult = $conn->query($sqlCount);
        $countRow = $countResult->fetch_assoc();
        $totalClients = $countRow['total'];

        // Display pagination buttons
        echo '<div class="here">';
        if ($currentPage > 1) {
            echo "<a class='dd' href='entre.php?page=" . ($currentPage - 1) . "'>Previous</a>";
        }

        if (is_numeric($totalClients) && is_numeric($startIndex) && $totalClients > $startIndex + $perPage) {
            echo "<a class='dd' href='entre.php?page=" . ($currentPage + 1) . "'>Next</a>";
        }
        echo '</div>';
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
