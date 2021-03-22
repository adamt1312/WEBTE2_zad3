<?php

require_once 'controllers/UserController.php';
require_once 'PHPGangsta/GoogleAuthenticator.php';

$uc = new UserController();

if ($uc->loginValidation($_POST['email'],$_POST['password'])) {

    $secret = $uc->getSecret($_POST['email']);

    if (isset($_POST['google_code'])) {
        $code = $_POST['google_code'];

        $ga = new PHPGangsta_GoogleAuthenticator();
        $result = $ga->verifyCode($secret, $code);

        // login existing user
        if ($result == 1) {
            session_start();
            $_SESSION['email'] = $_POST['email'];
            $uc->recordLog($uc->getUserId($_POST['email']));
            header('Location: https://wt156.fei.stuba.sk/authentication/home.php');
        }
        // wrong credentials
        else {
            echo '<a href="index.php">Wrong code, login failed, click to try again.<a/>';
        }
    }
    header("Location","login.php");
}
else echo '<a href="index.php">Wrong email or password entered, click to try again.<a/>';