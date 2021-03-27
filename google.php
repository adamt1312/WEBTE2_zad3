<?php

require_once 'controllers/UserController.php';
require_once "../../oauth2/vendor/autoload.php";

$uc = new UserController();

$redirect_uri = 'https://wt156.fei.stuba.sk/authentication/index.php';

$client = new Google_Client();
$client->setAuthConfig('../../configs/credentials.json');
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);

if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    $_SESSION['upload_token'] = $token;

    // redirect back to the example
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

// set the access token as part of the client
if (!empty($_SESSION['upload_token'])) {
    $client->setAccessToken($_SESSION['upload_token']);
    if ($client->isAccessTokenExpired()) {
        unset($_SESSION['upload_token']);
    }
} else {
    $authUrl = $client->createAuthUrl();
}

if ($client->getAccessToken()) {
    //Get user profile data from google
    $UserProfile = $service->userinfo->get();
    var_dump($client->getAccessToken());
    if(!empty($UserProfile)){
        $email = $UserProfile['email'];

        // login existing user
        if ($uc->isRegistered($email)) {
            session_start();
            $_SESSION['email'] = $email;
            $uc->recordLog($uc->getUserId($email));
            header('Location: https://wt156.fei.stuba.sk/authentication/home.php');
        }
        // register new user
        else {
            $uc->registerUser($UserProfile['given_name'],$UserProfile['family_name'],$email,null,'google',$UserProfile['id'],null);
            header('Location: ldap_google_register_notice.php');
        }

    }else{
        echo '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
}
else {
    $authUrl = $client->createAuthUrl();
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}
?>


