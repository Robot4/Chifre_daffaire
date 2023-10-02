<?php
// Get the current page filename from the URL
$currentURL = $_SERVER['PHP_SELF'];

// Extract just the filename without the path
$currentPage = basename($currentURL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard | By Code Info</title>
    <link rel="stylesheet" href="css/style.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
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
                    <span class="nav-item">Home</span>
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
            <li><a href="" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Log out</span>
            </a></li>
        </ul>
    </nav>

    <section class="main">
        <div class="main-top">
            <h1>Skills</h1>
            <i class="fas fa-user-cog"></i>
        </div>
        <div class="main-skills">
            <div class="card">
                <i class="fas fa-laptop-code"></i>
                <h3>Les Dépenses</h3>
                <p>Join Over 1 million Students.</p>
                <button>Get Started</button>
            </div>
            <div class="card">
                <i class="fab fa-wordpress"></i>
                <h3>WordPress</h3>
                <p>Join Over 3 million Students.</p>
                <button>Get Started</button>
            </div>
            <div class="card">
                <i class="fas fa-palette"></i>
                <h3>graphic design</h3>
                <p>Join Over 2 million Students.</p>
                <button>Get Started</button>
            </div>
            <div class="card">
                <i class="fab fa-app-store-ios"></i>
                <h3>IOS dev</h3>
                <p>Join Over 1 million Students.</p>
                <button>Get Started</button>
            </div>
        </div>


    </section>
</div>
</body>
</html>
