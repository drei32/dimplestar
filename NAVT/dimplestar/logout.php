<?php
session_start();

// ✅ Include DB connection
include 'php_includes/connection.php';

// ✅ Include audit logger
include 'php_includes/audit.php';

if (isset($_SESSION['email'])) {
    // ✅ Log audit before destroying session
    log_audit($con, $_SESSION['email'], "Logout");
}

// ✅ Clear session
$_SESSION = array();
session_destroy();

// ✅ Redirect
header("location: signlog.php");
exit;
?>
