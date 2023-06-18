<?php




 // Example usage:

//header('Content-Type: application/json');


include "../../includes/_process.php";

$loginOBJ = new AuthClass();
$apiHelper = new ApiHelper();

// structure JSON response
$response = array();
$response['success'] = false;
$response['messages'] = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {



    $url = htmlspecialchars(trim($_POST['url']));


    $scanner = new WebsiteScannerClass($url);
    $scanner->scanWebsite();
    $log = $scanner->getLog();



    foreach ($log as $message) {
        echo $message . "\n";
    }

}

