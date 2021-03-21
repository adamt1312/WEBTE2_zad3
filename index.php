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

                <form method="#" action="#" style="font-family: 'Exo';" >

                    <div>
                        <input type="email" placeholder="Email" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" style="text-indent: 15px;">
                    </div>

                    <div class="mt-7">
                        <input type="password" placeholder="Password" class="mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0" style="text-indent: 15px;">
                    </div>

                    <div class="mt-7">
                        <button class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Login
                        </button>
                    </div>

                    <div class="mt-7 flex">
<!--                        <label for="remember_me" class="inline-flex items-center w-full cursor-pointer">-->
<!--                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">-->
<!--                            <span class="ml-2 text-sm text-gray-600">-->
<!--                                        Remember me-->
<!--                                    </span>-->
<!--                        </label>-->

                        <div class="w-full text-center">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="signup.php">
                                Switch to sign up
                            </a>
                        </div>
                    </div>



                    <div class="flex mt-7 items-center text-center">
                        <hr class="border-gray-300 border-1 w-full rounded-md">
                        <label class="block font-medium text-sm text-gray-700 w-full">
                            Or login with
                        </label>
                        <hr class="border-gray-300 border-1 w-full rounded-md">
                    </div>

                    <div class="flex mt-7 justify-center w-full" style="height: 70px;">
                        <button class="mr-5 bg-blue-500 border-none px-4 py-2 rounded-xl cursor-pointer text-white shadow-xl hover:shadow-inner transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105" style="height: 45px;">

                            LDAP
                        </button>

                        <button class="bg-red-500 border-none px-4 py-2 rounded-xl cursor-pointer text-white shadow-xl hover:shadow-inner transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105" style="height: 45px;">

                            Google
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>
