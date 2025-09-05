<?php
session_start();
include 'php_includes/connection.php'; // ✅ DB connection
include 'php_includes/audit.php';      // ✅ Audit logger

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['login_email']);
    $password = $_POST['login_password'];

    // Escape input
    $email = mysqli_real_escape_string($con, $email);

    // Fetch password, salt, and role
    $sql = "SELECT password, salt, role FROM members WHERE email = '$email' LIMIT 1;";
    $query = mysqli_query($con, $sql);

    if (!$query || mysqli_num_rows($query) < 1) {
        // ✅ Log failed login (email not found)
        log_audit($con, $email, "Login Failed - Email not found");

        $message = "Login Failed!";
        header("location: signlog.php?message=" . $message);
        exit;
    }

    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

    // Hash check (must match signup hashing)
    $hash = hash('sha256', $row['salt'] . hash('sha256', $password));

    if ($hash != $row['password']) {
        // ✅ Log failed login (wrong password)
        log_audit($con, $email, "Login Failed - Wrong password");

        $message = "Login Failed!";
        header("location: signlog.php?message=" . $message);
        exit;
    } else {
        // ✅ Success
        session_regenerate_id(true);
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $row['role'];   // store role in session

        // ✅ Log successful login
        log_audit($con, $email, "Login Successful");

        header("location: index.php");
        exit;
    }
}
?>
