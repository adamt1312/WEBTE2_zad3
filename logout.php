<?php
session_start();

// google logout
if (str_contains($_SESSION['email'],'gmail.com')) {
    require_once "../../oauth2/vendor/autoload.php";

    $client = new Google_Client();
    $client->setAuthConfig('../../configs/credentials.json');

    //Unset token from session
    unset($_SESSION['upload_token']);

    // Reset OAuth access token
    $client->revokeToken();

}

//Destroy entire session
session_destroy();

//Redirect to homepage
header("Location:https://wt156.fei.stuba.sk/authentication/index.php");

?>