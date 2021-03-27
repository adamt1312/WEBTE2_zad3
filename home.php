<?php

require_once 'controllers/UserController.php';
require_once 'helper/User.php';

session_start();
$u_email = $_SESSION['email'];
$uc = new UserController();
$user = $uc->getUser($u_email);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Exo&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/e73d803768.js" crossorigin="anonymous"></script>

</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7; font-family: 'Exo'">

<div class="w-full h-screen bg-center bg-no-repeat bg-cover" style="background-image: url('https://images.unsplash.com/photo-1609342475528-dd7d93e8311e?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=676&q=80');">
    <div class="w-full h-screen bg-opacity-50 bg-black flex justify-center items-center">
        <div class="mx-4 text-center text-white">
            <h1 class="font-bold text-6xl mb-4">Hey <?= $user->getName() ?>, </h1>
            <h2 class="font-bold text-3xl mb-12">This is your homepage</h2>
            <div id="infoWrapper">
                <div class="info" style="height: fit-content">
                    <span><b>Name</b></span>
                    <span> <?= $user->getName() ?></span>
                </div>
                <div class="info" style="height: fit-content">
                    <span><b>Surname</b></span>
                    <span><?= $user->getSurname() ?></span>
                </div>
                <div class="info" style="height: fit-content">
                    <span><b>Email</b></span>
                    <span><?= $user->getEmail() ?></span>
                </div>
                <div class="info" style="height: fit-content">
                    <span><b>Type of registration</b></span>
                    <span><?= $user->getType() ?></span>
                </div>
            </div>
            <div>
                <table class="rounded-t-lg m-5 w-5/6 mx-auto text-gray-100 bg-gradient-to-l from-blue-500 to-blue-800" style="display: none; margin-bottom: 3.5rem" id="tb1">
                    <tr class="text-center border-b-2 border-blue-300">
                        <th class="px-4 py-3">Log history</th>
                    </tr>
                    <?php
                        foreach ($user->getLogs() as $log) {
                            echo "<tr class=\"text-center border-b-2 border-blue-300\">
                                        <th class=\"px-4 py-3\">".$log->getTimestamp()."</th>                               
                                 </tr>";
                        }
                    ?>
                </table>

                <table class="rounded-t-lg m-5 w-5/6 mx-auto text-pink-100 bg-gradient-to-l from-red-500 to-red-800" style="display: none; margin-bottom: 3.5rem" id="tb2">
                    <tr class="text-center border-b-2 border-red-200 font-bold">
                        <th class="px-4 py-3">Classic</th>
                        <th class="px-4 py-3">Google</th>
                        <th class="px-4 py-3">LDAP</th>
                    </tr>
                    <tr class="bg-red-600 font-semibold">
                        <td class="px-4 py-3 border-b border-red-500"><?= $uc->getClassicType() ?></td>
                        <td class="px-4 py-3 border-b border-red-500"><?= $uc->getGoogleType() ?></td>
                        <td class="px-4 py-3 border-b border-red-500"><?= $uc->getLdapType() ?></td>
                    </tr>
                </table>
                <button class="bg-blue-500 rounded-md font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600 mr-2" id="btn_tb1">
                    Show logs
                </button>
                <button class="bg-red-500 rounded-md font-bold text-white text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-red-800 ml-2" id="btn_tb2">
                    Show stats
                </button>
            </div>

        </div>
        <a href="logout.php"><i class="fas fa-sign-out-alt fa-4x" style="display: flex; bottom: 20px; position: absolute; right: 30px; color: white;"></i></a>
    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>
