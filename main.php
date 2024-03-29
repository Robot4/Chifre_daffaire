<?php

$currentURL = $_SERVER['PHP_SELF'];

// Extract just the filename without the path
$currentPage = basename($currentURL);
?>

<?php
include 'db.php';

// SQL query to select all prix values from the 'clients' table
$sqlTotalPrix = "SELECT SUM(prix) AS total_prix FROM clients";
$totalPrixResult = $conn->query($sqlTotalPrix);
$totalPrixRow = $totalPrixResult->fetch_assoc();
$totalPrix = $totalPrixRow['total_prix'];

// SQL query to select the total number of items in stock from the 'stock' table
$sqlTotalStockItems = "SELECT SUM(1) AS total_stock_items FROM stock";
$totalStockItemsResult = $conn->query($sqlTotalStockItems);
$totalStockItemsRow = $totalStockItemsResult->fetch_assoc();
$totalStockItems = $totalStockItemsRow['total_stock_items'];



// Write a SQL query to fetch prix, ville, and status from the entrer and ville_price tables
$sql = "SELECT SUM(CASE 
                WHEN e.status = 'Livré' THEN e.prix - vp.price
                WHEN e.status = 'Refusé' THEN e.prix - 15
                ELSE 0
           END) AS total FROM entrer AS e
        LEFT JOIN ville_price AS vp ON e.ville = vp.ville";
$result = $conn->query($sql);
$totalPrice = 0; // Initialize the total price variable

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Get the total price from the query result
    $totalPrice = $row['total'];
}

//benefice
$totalDifference = $totalPrice - $totalPrix;


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
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Mehdi</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="icon" href="img/icon.jpg" type="image/jpg"> <!-- For .png format -->

</head>
<body>
<div class="container">

    <nav>
        <ul>

            <li><a href="#" class="logo">
                <img src="img/chiffre-daffaires.png" alt="">
                <span class="nav-item">DashBoard</span>
            </a></li>
            <li <?php if (isset($currentPage) && $currentPage === 'main.php') echo 'class="active"'; ?>>
                <a href="main.php">
                    <i class="fas fa-home"></i>
                    <span class="nav-item">Accueil</span>
                </a>
            </li>
            <li><a href="sortie.php">
                    <i class="fas fa-tasks"></i>
                    <span class="nav-item">Achat</span>
            </a></li>
            <li><a href="entre.php">
                <i class="fas fa-wallet"></i>
                <span class="nav-item">Ventes</span>
            </a></li>
            <li><a href="stock.php">
                <i class="fas fa-chart-bar"></i>
                <span class="nav-item">Stock</span>
            </a></li>

            <li><a href="">
                <i class="fas fa-cog"></i>
                <span class="nav-item">Settings</span>
            </a></li>
            <li><a href="">
                <i class="fas fa-question-circle"></i>
                <span class="nav-item">Help</span>
            </a></li>

            <li>

                <a href="#" class="logout" onclick="document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log out</span>
                </a>
            </li>

            <form id="logout-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="logout" value="1">
            </form>
        </ul>
    </nav>




    <section class="main">
        <center>
        <p style="color: white">Welcome, <?php echo $_SESSION['username']; ?></p>
        </center>


        <div class="main-skills">
            <div class="card">
                <i class="fas fa-laptop-code"></i>
                <h3>Les Dépenses</h3>
                <button><p><?php echo $totalPrix; ?> Dhs</p></button>
            </div>
            <div class="card">
                <i class="fab fa-wordpress"></i>
                <h3>Chiffre D'affaire</h3>
                <button> <?php echo $totalPrice; ?> Dhs</button>
            </div>
            <div class="card">
                <i class="fas fa-palette"></i>
                <h3>Bénéfices</h3>
                <button><?php echo $totalDifference; ?> Dhs</button>
            </div>
            <div class="card">
                <i class="fa fa-warehouse"></i>
                <h3>Stock</h3>
                <button><?php echo $totalStockItems; ?></button>
            </div>
        </div>

    </section>
</div>
</body>
</html>
