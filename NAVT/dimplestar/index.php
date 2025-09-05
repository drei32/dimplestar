<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Dimple Star Transport</title>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="icon" href="images/icon.ico" type="image/x-con">
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1><a href="index.php"><img src="images/logo.png" class="logo" alt="Dimple Star Transport" /></a></h1>
		<ul id="mainnav">
			<li class="current"><a href="index.php">Home</a></li>
			<li><a href="about.php">About Us</a></li>
			<li><a href="terminal.php">Terminals</a></li>
			<li><a href="routeschedule.php">Routes / Schedules</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="book.php">Book Now</a></li>
		</ul>
	</div>

	<div id="content">
		<div id="gallerycontainer">
			<div style="margin:0 auto; padding:30px 20px 20px 20px; max-width: 100%; width: 100%;">
			<div class="login">
    <div id="right">
        <?php
            session_start();
            if(isset($_SESSION['email'])){
                $email = $_SESSION['email'];
                echo "<span>Welcome, $email!</span>";
                echo "<a href='logout.php'>Logout</a>";
            }
            if(empty($email)){
                echo "<a href='signlog.php'>SignUp / Login</a>";
            }
        ?>
    </div>
</div>

<h3><?php include_once("php_includes/date_time.php"); ?></h3>
				<p>Contact us at:</p>
				<h2>0929 209 0712</h2>
				<p>
					Block 1 lot 10, Southpoint Subd.<br>
					Brgy Banay-Banay, Cabuyao, Laguna
				</p>

				<div id="right">
				
				</div>

				<div class="column-clear"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div id="footer">
		<a href="index.php"><img src="images/footer-logo.jpg" alt="Dimple Star Transport" /></a>
		<p>&copy; Dimple Star Transport<br /></p>
	</div>
</div>
</body>
</html>
