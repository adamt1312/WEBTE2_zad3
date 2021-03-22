<?php

require_once 'PHPGangsta/GoogleAuthenticator.php';
require_once "controllers/UserController.php";

$user_controller = new UserController();

if ($user_controller->isRegistered($_POST['email'])) {
    echo 'Sorry, this email is already registered';

}
else if ($_POST['type'] == 'classic') {
    $websiteTitle = 'WEBTE2 - auth';

    $ga = new PHPGangsta_GoogleAuthenticator();
    echo "Please install Google Authenticator, and in the app insert secret code bellow or scan this QR code. <br />";
    $secret = $ga->createSecret();
    echo 'Secret code is: '.$secret.'<br />';

    $qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
    echo 'Google auth QR-Code:<br /><img src="'.$qrCodeUrl.'" />';

    echo "<a href='index.php'>GOT IT<a/>";

    $user_controller->registerUser($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['password'],$_POST['type'],null, $secret);
}

?>



