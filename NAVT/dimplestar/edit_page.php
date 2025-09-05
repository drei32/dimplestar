<?php
session_start();
include 'php_includes/connection.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin'){
    die("Access denied.");
}

$page_name = $_GET['page'] ?? 'about';

// Fetch content
$sql = "SELECT content FROM pages WHERE page_name='$page_name'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$content = $row['content'];

// Handle update
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $new_content = mysqli_real_escape_string($con, $_POST['content']);
    $update = "UPDATE pages SET content='$new_content' WHERE page_name='$page_name'";
    mysqli_query($con, $update);
    header("Location: about.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Page - <?php echo ucfirst($page_name); ?></title>
</head>
<body>
<h2>Edit <?php echo ucfirst($page_name); ?> Page</h2>
<form method="post">
    <textarea name="content" rows="20" cols="100"><?php echo htmlspecialchars($content); ?></textarea><br><br>
    <button type="submit">Save Changes</button>
</form>
</body>
</html>
