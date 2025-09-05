<?php
function log_audit($con, $email, $action) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';

    if ($con) {
        $stmt = $con->prepare("INSERT INTO audit_trail (user_email, action, ip_address, user_agent) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $action, $ip, $ua);
        $stmt->execute();
        $stmt->close();
    }
}
?>
