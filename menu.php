<?php
// Get the current page filename from the URL
$currentURL = $_SERVER['PHP_SELF'];

// Extract just the filename without the path
$currentPage = basename($currentURL);
?>

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

        <li <?php if (isset($currentPage) && $currentPage === 'sortie.php') echo 'class="active"'; ?>>
            <a href="sortie.php">
                <i class="fas fa-tasks"></i>
                <span class="nav-item">Achat</span>
            </a>
        </li>

        <li <?php if (isset($currentPage) && $currentPage === 'entre.php') echo 'class="active"'; ?>>
            <a href="entre.php">
                <i class="fas fa-wallet"></i>
                <span class="nav-item">Ventes</span>
            </a>
        </li>


        <li <?php if (isset($currentPage) && $currentPage === 'stock.php') echo 'class="active"'; ?>>
            <a href="stock.php">
                <i class="fas fa-chart-bar"></i>
                <span class="nav-item">Stock</span>
            </a></li>

        <li<?php if (isset($currentPage) && $currentPage === 'stock.php') echo 'class="active"'; ?>>
                <a href="">
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
