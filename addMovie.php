<?php
session_start();
include "./db/conn.php";

// Proses form ketika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    var_dump($_FILES);
    // Ambil data dari form
    $movieTitle = $_POST['movieTitle'];
    $movieDesc = $_POST['movieDesc'];
    $movieUploader = $_POST['movieUploader'];
    $movieGenre = $_POST['movieGenre'];

    // Upload poster file
    $movieImg = $_FILES['movieImg']['name'];
    $movieImgTmp = $_FILES['movieImg']['tmp_name'];
    move_uploaded_file($movieImgTmp, "./uploads/posters/" . $movieImg);

    // Upload video file
    $movieVideo = $_FILES['movieVideo']['name'];
    $movieVideoTmp = $_FILES['movieVideo']['tmp_name'];
    move_uploaded_file($movieVideoTmp, "uploads/videos/" . $movieVideo);

    $allowedPosterTypes = ['image/jpeg', 'image/JPEG', 'image/png', 'image/PNG', 'image/jpg', 'image/JPG'];
    $allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mov'];

    if (!in_array($_FILES['movieImg']['type'], $allowedPosterTypes)) {
        die("Invalid poster format!");
    }
    if (!in_array($_FILES['movieVideo']['type'], $allowedVideoTypes)) {
        die("Invalid video format!");
    }

    // Release Year
    $movieYear = $_POST['movieYear'];
    $sqlYear = "INSERT IGNORE INTO moviereleaseyear (movieReleaseYear) VALUES ('$movieYear')";
    $conn->query($sqlYear);

    // Ambil release_year_id
    $release_year_id = $conn->query("SELECT movieReleaseYear FROM moviereleaseyear WHERE movieReleaseYear='$movieYear'")->fetch_assoc()['movieReleaseYear'];

    // Masukkan data ke tabel moviedata
    $sqlMovie = "INSERT INTO moviedata (movieTitle, movieDesc, movieImg, movieVid, uploader, movieGenre, movieReleaseYear)
                 VALUES ('$movieTitle', '$movieDesc', '$movieImg', '$movieVideo', '$movieUploader', '$movieGenre', '$release_year_id')";

    if ($conn->query($sqlMovie) === TRUE) {
        echo "<p class='sucess-crud'>Movie added sucessfully</p>";
        echo "<p class='sucess-crud'><a href='./admin/dashboard.php' class='sucess-crud-redirect'>Kembali ke Dashboard</a></p>";
    } else {
        echo "Error: " . $sqlMovie . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Add Movie</title>
</head>
<body>
    <?php
    include "navbar.php";
    ?>
    <div class="add-movie">
        <h1>Add Movie</h1>
        <div class="add-movie-form">
            <form action="" method="POST" enctype="multipart/form-data" id="addMovie">
                <label for="movieTitle">Movie Title</label>
                <input type="text" name="movieTitle" required> <br>

                <label for="movieDesc">Movie Description</label>
                <textarea name="movieDesc" id="movieDesc"></textarea>

                <label for="movieImg">Movie Poster</label>
                <input type="file" name="movieImg" required> <br>

                <label for="movieVideo">Movie File</label>
                <input type="file" name="movieVideo" required> <br>

                <label for="movieGenre">Movie Genre:</label>
                <select name="movieGenre" id="movieGenre" required>
                <?php
                $sqlGenres = "SELECT movieGenre FROM moviegenre";
                $resultGenres = $conn->query($sqlGenres);

                if ($resultGenres->num_rows > 0) {
                    while ($row = $resultGenres->fetch_assoc()) {
                        echo '<option value="' . $row['movieGenre'] . '">' . $row['movieGenre'] . '</option>';
                    }
                } else {
                    echo 'No genres found.';
                }
                ?>
                </select>

                <label for="movieYear">Movie Release Year</label>
                <input type="text" name="movieYear"> <br>

                <label for="movieUploader">Uploader:</label>
                <select name="movieUploader" id="movieUploader" required>
                    <?php
                    $sqlUsers = "SELECT username FROM users";
                    $resultUsers = $conn->query($sqlUsers);

                    if ($resultUsers->num_rows > 0) {
                        while ($row = $resultUsers->fetch_assoc()) {
                            echo '<option value="' . $row['username'] . '">' . $row['username'] . '</option>';
                        }
                    } else {
                        echo '<option value="">No users available</option>';
                    }
                    ?>
                </select>
                <button type="submit" form="addMovie">Add Movie</button>
            </form>
        </div>
    </div>
</body>
</html>