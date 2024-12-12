<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assests/style.css">
    <title>Edit Movie</title>
</head>
<body>
    <?php
    include "./db/conn.php";
    include "navbar.php";

    // Ambil ID movie dari URL
    if (isset($_GET['idMovie']) && is_numeric($_GET['idMovie'])) {
        $idMovie = intval($_GET['idMovie']);

        // Ambil data movie dari database
        $stmt = $conn->prepare("SELECT * FROM moviedata WHERE idMovie = ?");
        $stmt->bind_param("i", $idMovie);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $movie = $result->fetch_assoc();
        } else {
            echo "<p>Film tidak ditemukan.</p>";
            exit;
        }
    } else {
        echo "<p>ID film tidak valid.</p>";
        exit;
    }

    // Proses submit form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $movieTitle = $_POST['movieTitle'];
        $movieDesc = $_POST['movieDesc'];
        $movieYear = $_POST['movieYear'];
        $movieUploader = $_POST['movieUploader'];
        $movieGenre = $_POST['movieGenre'];

        // File upload handling
        $movieImg = $movie['movieImg']; // Default to existing image
        if (!empty($_FILES['movieImg']['name'])) {
            $movieImg = basename($_FILES['movieImg']['name']);
            move_uploaded_file($_FILES['movieImg']['tmp_name'], "./uploads/posters/$movieImg");
        }

        $movieVideo = $movie['movieVid']; // Default to existing video
        if (!empty($_FILES['movieVideo']['name'])) {
            $movieVideo = basename($_FILES['movieVideo']['name']);
            move_uploaded_file($_FILES['movieVideo']['tmp_name'], "./uploads/video/$movieVideo");
        }

        // Update data ke database
        $updateStmt = $conn->prepare(
            "UPDATE moviedata SET movieTitle = ?, movieDesc = ?, movieImg = ?, movieVid = ?, movieGenre = ?, movieReleaseYear = ?, uploader = ? WHERE idMovie = ?"
        );
        $updateStmt->bind_param(
            "sssssssi",
            $movieTitle,
            $movieDesc,
            $movieImg,
            $movieVideo,
            $movieGenre,
            $movieYear,
            $movieUploader,
            $idMovie
        );

        if ($updateStmt->execute()) {
            echo "<p class='sucess-crud'>Movie Updated sucessfully</p>";
            echo "<p class='sucess-crud'><a href='/project/admin/dashboard.php' class='sucess-crud-redirect'>Return to Dashboard</a></p>";
        } else {
            echo "<p class:'sucess-edit'>Terjadi kesalahan saat memperbarui data.</p>";
        }
    }
    ?>

    <div class="edit-movie">
        <h1>Edit Movie</h1>
        <div class="edit-movie-form">
            <form action="" method="post" id="editMovie" enctype="multipart/form-data">
                <label for="movieTitle">Movie Title</label>
                <input type="text" name="movieTitle" value="<?= htmlspecialchars($movie['movieTitle']) ?>" required> <br>

                <label for="movieDesc">Movie Description</label>
                <textarea name="movieDesc" id="movieDesc" required><?= htmlspecialchars($movie['movieDesc']) ?></textarea>

                <label for="movieImg">Movie Poster</label>
                <input type="file" name="movieImg"> <br>
                <img src="./uploads/posters/<?= htmlspecialchars($movie['movieImg']) ?>" alt="Current Poster" width="100"><br>

                <label for="movieVideo">Movie File</label>
                <input type="file" name="movieVideo"> <br>
                <video width="200" controls>
                    <source src="./uploads/video/<?= htmlspecialchars($movie['movieVid']) ?>" type="video/mp4">
                </video><br>

                <label for="movieGenre">Movie Genre:</label>
                <select name="movieGenre" id="movieGenre" required>
                    <?php
                    $sqlGenres = "SELECT movieGenre FROM moviegenre";
                    $resultGenres = $conn->query($sqlGenres);

                    if ($resultGenres->num_rows > 0) {
                        while ($row = $resultGenres->fetch_assoc()) {
                            $selected = ($movie['movieGenre'] === $row['movieGenre']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row['movieGenre']) . '" ' . $selected . '>' . htmlspecialchars($row['movieGenre']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No genres found</option>';
                    }
                    ?>
                </select>

                <label for="movieYear">Movie Release Year</label>
                <input type="text" name="movieYear" value="<?= htmlspecialchars($movie['movieReleaseYear']) ?>" required> <br>

                <label for="movieUploader">Uploader:</label>
                <select name="movieUploader" id="movieUploader" required>
                    <?php
                    $sqlUsers = "SELECT username FROM users";
                    $resultUsers = $conn->query($sqlUsers);

                    if ($resultUsers->num_rows > 0) {
                        while ($row = $resultUsers->fetch_assoc()) {
                            $selected = ($movie['uploader'] === $row['username']) ? 'selected' : '';
                            echo '<option value="' . htmlspecialchars($row['username']) . '" ' . $selected . '>' . htmlspecialchars($row['username']) . '</option>';
                        }
                    } else {
                        echo '<option value="">No users available</option>';
                    }
                    ?>
                </select>

                <button type="submit">Edit Movie</button>
            </form>
        </div>
    </div>
</body>
</html>