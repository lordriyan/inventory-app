<?php $url = basename($_SERVER['PHP_SELF']);?>
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= ($url == "dashboard.php") ? "active" : ""; ?>" href="dashboard.php">
                    <i class="material-icons">dashboard</i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($url == "settings.php") ? "active" : ""; ?>" href="settings.php">
                    <i class="material-icons">settings</i>
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($url == "about.php") ? "active" : ""; ?>" href="about.php">
                    <i class="material-icons">person</i>
                    About
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Storage</span>
            <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= ($url == "data_barang.php") ? "active" : ""; ?>" href="data_barang.php">
                    <i class="material-icons">list</i>
                    Inventory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($url == "persediaan.php") ? "active" : ""; ?>" href="persediaan.php">
                    <i class="material-icons">description</i>
                    Stock
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($url == "eoq.php") ? "active" : ""; ?>" href="eoq.php">
                    <i class="material-icons">shopping_cart</i>
                    EOQ Calculator
                </a>
            </li>
        </ul>
    </div>
</nav>