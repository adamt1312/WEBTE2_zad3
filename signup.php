<?php

?>
<!doctype html>
<html lang="en">
<head>
    <title>WEBTE2 - authentication</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo&display=swap" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
<!-- This is an example component -->
<div class="font-sans" style="width: 100%">
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center bg-gray-100 ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                <div style="height: 80px; justify-content: space-evenly; display: flex; flex-direction: column; align-items: center;">
                    <label for="" class="block text-md text-gray-700 text-center font-semibold" style="font-family: 'Exo'; display: flex;">
                        WEBTE2
                    </label>
                    <label for="" class="block text-md text-gray-700 text-center font-semibold" style="font-family: 'Exo'; display: flex;">
                        Authentication
                    </label>
                </div>

                <form method="post" action="registration_handler.php" style="font-family: 'Exo';">

                        <input type="text" placeholder="Name" name="name" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" style="text-indent: 15px;">

                    <div class="mt-7">
                        <input type="text" placeholder="Surname" name="surname" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" style="text-indent: 15px;">
                    </div>

                    <div class="mt-7">
                        <input type="email" placeholder="Email" name="email" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" style="text-indent: 15px;">
                    </div>

                    <div class="mt-7">
                        <input type="password" placeholder="Password" name="password" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" style="text-indent: 15px;">
                    </div>

                    <input type="hidden" name="type" value="classic">

                    <input type="hidden" name="google_id" value=null>



                    <div class="mt-7 flex">
                        <div class="w-full text-center">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="index.php">
                               Switch to log in
                            </a>
                        </div>
                    </div>

                    <div class="mt-7 mb-7">
                        <button class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>
