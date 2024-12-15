<?php
session_start(); // Pastikan sesi dimulai

include ('../db/conn.php');
include ('../navbar.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input
    if ($password !== $confirm_password) {
        $error_message = "Password dan konfirmasi password tidak cocok.";
    } else {
        // Hash password untuk keamanan
        // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email atau username sudah terdaftar
        $query = $conn->prepare("SELECT * FROM users WHERE username = ? OR userEmail = ?");
        $query->bind_param("ss", $username, $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Username atau email sudah terdaftar.";
        } else {
            // Simpan data ke database
            $insert_query = $conn->prepare("INSERT INTO users (username, userEmail, userPassword) VALUES (?, ?, ?)");
            $insert_query->bind_param("sss", $username, $email, $password);
            if ($insert_query->execute()) {
                $success_message = "Registrasi berhasil! Silakan login.";
            } else {
                $error_message = "Terjadi kesalahan, silakan coba lagi.";
            }
        }
    }
}
?>
<link rel="stylesheet" href="../assets/style.css">

<div class="register-page">
    <div class="register-form">
        <form method="post" action="" id="userRegister">
            <h1>User Registration</h1>
            <?php if (!empty($error_message)): ?>
                <p style="color: red; padding-top: 3vh"><?= htmlspecialchars($error_message); ?></p>
            <?php elseif (!empty($success_message)): ?>
                <p style="color: green; padding-top: 3vh"><?= htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
            <label for="username">Username</label>
            <input type="text" name="username" required> <br>
            <label for="email">Email</label>
            <input type="email" name="email" required> <br>
            <label for="password">Password</label>
            <input type="password" name="password" required> <br>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" required> <br>
            <button type="submit" form="userRegister">Register</button>
        </form>
    </div>
</div>