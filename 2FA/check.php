<?php
    require_once 'PHPGangsta/GoogleAuthenticator.php';
    require_once '../controllers/UserController.php';

    $uc = new UserController();
    $secret = $uc->getSecret($_SESSION['']);
 
    if (isset($_POST['code'])) {
        $code = $_POST['code'];
 
        $ga = new PHPGangsta_GoogleAuthenticator();
        $result = $ga->verifyCode($secret, $code);
 
        if ($result == 1) {
            echo $result;
        } else {
            echo 'Login failed';
        }
    }
?>