<?php

include "../includes/_process.php";
include "../includes/_helpers.php";

$adminInfo = Session::checkAdminSession();

$prevScannedResults = getPrevScan(false);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Dashboard - SiteScanX</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet"/>
    <link href="<?php echo getBaseUrl(); ?>/assets/user-portal/css/styles.css" rel="stylesheet"/>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="dashboard.php">SiteScanX</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="<?php echo getBaseUrl() ?>/admin/dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Scanner
                    </a>

                    <div class="sb-sidenav-menu-heading">Auth</div>
                    <a class="nav-link" href="#." id="logoutBtn">
                        <div class="sb-nav-link-icon"><i class="fas fa-sign-out"></i></div>
                        Logout
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= $adminInfo['name'] ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">One small scan for the site, one giant leap for optimized SEO.
                    </li>
                </ol>
                <div class="row">
                    <span id="liveAlertPlaceholder"></span>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-search me-1"></i>
                                Scanner Module
                            </div>
                            <div class="card-body">
                                <form class="needs-validation" action="#." method="POST">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Website URL</label>
                                        <input type="url" class="form-control" id="website" name="website"
                                               placeholder="https://yourwebsite.com">
                                        <small class="text-muted">Please note only the homepage hyperlinks will be
                                            scanned!</small>
                                    </div>
                                    <hr class="my-4">
                                    <button class="w-100 btn btn-primary btn-sm" id="initateScanBtn" type="submit">
                                        Initiate Scanner
                                        <i class="fas fa-search"></i>
                                    </button>


                                    <?php
                                    if (count($prevScannedResults) > 0) {
                                        ?>
                                        <button class="w-100 btn btn-success btn-sm mt-4" id="viewScannedResults">
                                            <i class="fas fa-list"></i>
                                            View Previously Scanned Results
                                        </button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6" id="scanLogBox">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-search me-1"></i>
                                Scan Logs
                            </div>
                            <div class="card-body">
                                <div id="log"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12" id="scanResultsBox">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-search me-1"></i>
                                Scan Results
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php
                                    $count = 1;
                                    foreach ($prevScannedResults as $prevScannedResult) {
                                        ?>
                                        <li class="list-group-item"><?= $count++ ?>. <?php echo $prevScannedResult['url'] ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; SiteScanX 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

<script src="<?php echo getBaseUrl(); ?>/assets/user-portal/js/scripts.js"></script>

</body>
</html>
