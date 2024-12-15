<?php 
session_start();
if (isset($_SESSION['logged_in'])): ?>
    <p style="color: white;">Welcome, <?= htmlspecialchars($_SESSION['logged_in']); ?>!</p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php
    include ('../db/conn.php');
    include ('../navbar.php'); 
    ?>
    <div class="movie-collection">
        <h1>Movie Collection</h1>
        <button class="add-movie-btn"><a href="/project/addMovie.php">Add Movie</a></button>
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Release Year</th>
                <th>Uploader</th>
                <th colspan="2">Action</th>
            </tr>
            <?php
            // Query to select data from the moviedata table
            $sql = "SELECT idMovie, movieTitle, movieDesc, movieReleaseYear, uploader FROM moviedata";
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["movieTitle"] . "</td>";
                    echo "<td>" . $row["movieDesc"] . "</td>";
                    echo "<td>" . $row["movieReleaseYear"] . "</td>";
                    echo "<td>" . $row["uploader"] . "</td>";
                    echo '<td><a href="../editMovie.php?idMovie=' . $row["idMovie"] . '">Edit</a></td>';
                    echo '<td><a href="../deleteMovie.php?idMovie=' . $row["idMovie"] . '" onclick="return confirmDelete()">Delete</a></td>';
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No movies found</td></tr>";
            }
            ?>
        </table>
    </div>
    <script src="../assets/script.js"></script>
</body>
</html>