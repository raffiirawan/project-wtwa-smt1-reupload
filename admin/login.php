<?php
session_start(); // Pastikan sesi dimulai

// Redirect jika pengguna sudah login
if (isset($_SESSION['logged_in'])) {
    header("Location: /project/admin/dashboard.php");
    exit;
}
include ('../db/conn.php');
include ('../navbar.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk keamanan
    $query = $conn->prepare("SELECT * FROM users WHERE username = ? AND userEmail = ? AND userPassword = ?");
    $query->bind_param("sss", $username, $email, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Set sesi pengguna
        $_SESSION['logged_in'] = true;
        header("Location: /project/admin/dashboard.php");
        exit;
    } else {
        $error_message = "Akun Anda belum terdaftar di web kami.";
    }
}
?>
<link rel="stylesheet" href="../assets/style.css">

<div class="login-page">
    <div class="login-form">
        <form method="post" action="" id="userLogin">
            <h1>User Login</h1>
            <?php if (!empty($error_message)): ?>
                <p style="color: red; padding-top: 3vh"><?= htmlspecialchars($error_message); ?></p>
            <?php endif; ?>
            <label for="username">Username</label>
            <input type="text" name="username" required> <br>
            <label for="email">Email</label>
            <input type="email" name="email" required> <br>
            <label for="password">Password</label>
            <input type="password" name="password" required> <br>
            <button type="submit" form="userLogin">Login</button>
        </form>
    </div>
</div>