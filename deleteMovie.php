<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Movie</title>
    <link rel="stylesheet" href="./assests/style.css">
</head>
<body>
<?php
include "./db/conn.php";

// Pastikan ID movie diterima dari URL
if (isset($_GET['idMovie']) && is_numeric($_GET['idMovie'])) {
    $idMovie = intval($_GET['idMovie']);

    // Cek apakah film dengan ID tersebut ada di database
    $stmt = $conn->prepare("SELECT * FROM moviedata WHERE idMovie = ?");
    $stmt->bind_param("i", $idMovie);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Hapus data dari database
        $deleteStmt = $conn->prepare("DELETE FROM moviedata WHERE idMovie = ?");
        $deleteStmt->bind_param("i", $idMovie);
        if ($deleteStmt->execute()) {
            echo "<p>Film berhasil dihapus.</p>";
        } else {
            echo "<p>Terjadi kesalahan saat menghapus data.</p>";
        }
    } else {
        echo "<p>Film tidak ditemukan.</p>";
    }
} else {
    echo "<p>ID film tidak valid.</p>";
}

// redirect
    echo "<p class='sucess-crud'>Data film berhasil diperbarui.</p>";
    echo "<p class='sucess-crud'><a href='/project/admin/dashboard.php' class='sucess-crud-redirect'>Kembali ke Dashboard</a></p>";
?>
</body>
</html>