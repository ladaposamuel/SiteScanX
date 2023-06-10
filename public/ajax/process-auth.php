<?php
//header('Content-Type: application/json');


include "../../includes/_process.php";

$loginOBJ = new AuthClass();
$apiHelper = new ApiHelper();

// structure JSON response
$response = array();
$response['success'] = false;
$response['messages'] = array();


if (!array_key_exists("action", $_POST)) {
    echo $apiHelper->formatResponse(false, 'Invalid Login Action', null, 405);
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = $_POST['action'];

    switch ($action) {
        case 'login':
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));

            $result = $loginOBJ->login($email, $password);

            if ($result['status']) {
                $_SESSION['email'] = $email;
            }

            echo $apiHelper->formatResponse($result['status'], $result['message'], $result['status_code']);
            break; //END login

        case 'logout':
            $result = $loginOBJ->logout();

            if ($result['status'] === true) {
                $response['success'] = true;
            }

            echo $apiHelper->formatResponse($result['status'], $result['message'],$result['status_code']);

            break; //END login

        default:
            break; // END 'default'

    } // End Switch
}
?>
