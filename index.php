<?php

include "./includes/_process.php";
include "./includes/_helpers.php";


$prevScannedResults = getPrevScan(false);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>SiteScanX</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo getBaseUrl(); ?>/assets/landing-page/css/styles.css" rel="stylesheet"/>
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-5">
        <a class="navbar-brand" href="#!">SiteScanX</a>

    </div>
</nav>
<!-- Page Content-->
<div class="container px-4 px-lg-5">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7">

            <span id="liveAlertPlaceholder">
            </span>

            <div class="card border-1">
                <div class="card-header"><h5 class="text-center my-4">Admin Login</h5></div>
                <div class="card-body">
                    <form action="#." method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputEmail" type="email" name="email"
                                   value="ladaposamuel@gmail.com"/>
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputPassword" type="password" name="password"
                                   placeholder="Password"/>
                            <label for="inputPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button type="submit" id="loginbtn" class="btn btn-primary">Login</button>

                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small">
                        <b>Email:</b> ladaposamuel@gmail.com <br>
                        <b>Password:</b> password
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <h1 class="font-weight-light">SiteScanX</h1>
            <p>View Latest Generated Sitemap</p>
            <?php if (checkSiteMapfile()) { ?>
                <a class="btn btn-primary" href="public/sitemap.html" target="_blank">View Latest Sitemap</a><br>
                <!--                <small>Last Updated: 3 Secs ago</small>-->
            <?php } else { ?>

                <small>No sitemap.html found yet, please check again in the next hour or contact an Admin.</small>

            <?php } ?>
        </div>
        </span>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo getBaseUrl(); ?>/assets/landing-page/js/scripts.js"></script>
</body>
</html>
