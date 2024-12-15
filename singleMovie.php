<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Watch Your Favorite Movies</title>
</head>
<body>
    <?php
        include "./db/conn.php";
        include "navbar.php";
        $idMovie = $_GET["idMovie"];
        
        $sql = "SELECT idMovie, movieTitle, movieDesc, movieImg, movieVid, movieGenre, movieReleaseYear FROM moviedata WHERE idMovie = $idMovie";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
            echo "<div class='movie-player'>";
                echo "<video src='./uploads/videos/" . $row["movieVid"] . "' poster='./uploads/posters/" . $row["movieImg"] . "' controls></video>";
            echo "</div>";

            echo "<div class='single-movie-card'>";
                echo "<img src='./uploads/posters/" . $row["movieImg"] . "' >";
                echo "<div class='movie-info'>";
                    echo "<h3>" . $row["movieTitle"] . "</h3>";
                    echo "<p>" . $row["movieDesc"] . "</p>";
                    echo "<div class='genres'>";
                        echo "<span>" . $row["movieGenre"] . "</span>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            }
        }
    ?>

    <!-- <div class="movie-player">
        <video src="./assets/video/minions.mp4" poster="./assets/img/Avenger.jpg" controls></video>
    </div>
    <div class="single-movie-card">
        <img src="./assets/img/Avenger-poster.jpg" alt="">
        <div class="movie-info">
            <h3>Avengers End Game (Years)</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corrupti ex nobis temporibus quidem quae? Voluptatibus fugiat beatae reiciendis. Accusantium, repellendus minima cum assumenda odit quaerat totam quae laboriosam cumque tenetur?</p>
            <div class="genres">
                <span>Action</span>
                <span>Sci-Fi</span>
            </div>
        </div>
    </div> -->
</body>
</html>