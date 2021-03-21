<?php

require_once "controllers/UserController.php";

$user_controller = new UserController();

if ($user_controller->isRegistered($_POST['email'])) {
    echo 'Sorry, this email is already registered';

}
else if ($_POST['type'] == 'classic') {
    $user_controller->registerUser($_POST['name'],$_POST['surname'],$_POST['email'],$_POST['password'],$_POST['type'],null);
    header('Location: https://wt156.fei.stuba.sk/authentication');
}



?>
