<?php

session_start();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === 'encryptedadminloginkey') {
    header('Location: /admin/list.php');
    exit();
} else {
    header('Location: /admin/login.php');
    exit();
}
?>
