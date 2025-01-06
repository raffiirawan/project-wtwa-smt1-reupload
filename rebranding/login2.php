<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php
    include "navbar2.php"
    ?>

    <div class="h-screen flex flex-col bg-stone-200 text-center items-center justify-center gap-4">
        <h2 class="w-full text-xl font-semibold">User Login</h2>
        <div class="w-96 bg-zinc-50 rounded-lg">
            <form action="" class="flex flex-col p-3 gap-1 text-left">
                <label for="username">Username</label>
                <input type="text" name="username" class="p-2 rounded-md bg-slate-200 focus:bg-zinc-50">
                <label for="email">Email</label>
                <input type="email" name="email" class="p-2 rounded-md bg-slate-200 focus:bg-zinc-50">
                <label for="password">Password</label>
                <input type="password" name="password" class="p-2 rounded-md bg-slate-200 focus:bg-zinc-50">
                <button type="submit" class="w-full bg-blue-600 p-2 mt-4 rounded-md text-white hover:bg-blue-800">Login</button>
                <p class="text-sm text-center">Or <a href="#" class="text-blue-600 hover:text-blue-800">Register</a> New Account</p>
            </form>
        </div>
    </div>
</body>
</html>