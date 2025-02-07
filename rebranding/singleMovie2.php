<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Watch Movies Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-200">
    <?php
    include "navbar2.php";
    ?>
    <div class="h-screen">
        <video class="w-screen max-h-full object-contain" src="../uploads/videos/Neon Genesis_Evangelion_26.mp4" poster="../uploads/posters/Evangelion-poster.jpg" controls></video>
    </div>
    <div class="my-2 mx-4 p-4 flex bg-zinc-50 gap-3 rounded-md">
        <div class="w-1/6">
            <img src="../uploads/posters/Evangelion-poster.jpg">
        </div>
        <div class="w-5/6">
            <h3 class="text-3xl">Neon Genesis Evangelion</h3>
            <p class="my-2 text-gray-600">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quo assumenda autem est blanditiis at alias dolorem quis debitis quia obcaecati voluptas, praesentium id architecto minus, odio sed fugiat magnam eum vero mollitia natus. Eveniet blanditiis laboriosam, vel doloribus officiis et iusto assumenda dolorum maxime itaque commodi reprehenderit, exercitationem ullam necessitatibus!</p>
            <span class="text-lg hover:text-cyan-500">Action</span> <span class="text-lg hover:text-cyan-500">Sci-Fi</span>
        </div>
    </div>
</body>
</html>