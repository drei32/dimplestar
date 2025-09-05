<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dimple Star Transport</title>
<link rel="stylesheet" type="text/css" href="style/style.css">
<link rel="icon" href="images/icon.ico" type="image/x-con">
</head>
<body>
<div id="wrapper">

    <!-- Header -->
	<div id="header">
        <h1>
            <a href="index.php">
                <img src="images/logo.png" class="logo" alt="Dimple Star Transport" />
            </a>
        </h1>
        <ul id="mainnav">
			<li><a href="index.php">Home</a></li>
			<li class="current"><a href="about.php">About Us</a></li>
            <li><a href="terminal.php">Terminals</a></li>
			<li><a href="routeschedule.php">Routes / Schedules</a></li>
            <li><a href="contact.php">Contact</a></li>
			<li><a href="book.php">Book Now</a></li>
    	</ul>
	</div>

    <!-- Content -->
    <div id="content">
    	<div id="gallerycontainer">
            <div style="margin:0 auto; padding:30px 20px; max-width: 100%; width: 100%;">
				
                <div class="login">
					<div id="right">
						<?php
							session_start();
							if(isset($_SESSION['email'])){
								$email = $_SESSION['email'];
								echo "<span>Welcome, $email!</span>";
								echo "<a href='logout.php'>Logout</a>";
							} else {
								echo "<a href='signlog.php'>Login</a>";
							}
						?>
					</div>
				</div>

                <!-- Date / Time -->
                <div id="right" style="margin-bottom:20px;">
					<h3><?php include_once("php_includes/date_time.php"); ?></h3>
				</div>
			
<h1>About Us</h1>

<div style="text-align:center; margin:20px 0;">
    <img src="images/oldbus.jpg" alt="Dimple Star Transport bus history" 
         width="470" style="border-radius:8px; max-width:100%; height:auto;">
</div>

                <div id="fb">
                    <?php include_once("php_includes/fblike.php"); ?>
                </div>

                <h3>Our Story</h3>
                <p>
                Founded in the early 1990s, Dimple Star Transport has grown from a small local operator into one of the trusted bus companies serving Metro Manila and the island of Mindoro.  
                Originally known as <strong>Napat Transit</strong>, the company rebranded in 2004 to better reflect its expanding services and commitment to quality transport.
                </p>

                <h3>What We Do</h3>
                <p>
                We specialize in providing safe, reliable, and comfortable bus services across Metro Manila and key provinces.  
                With decades of experience in the industry, our fleet and team are dedicated to delivering a seamless travel experience for every passenger.
                </p>

                <!-- Mission & Vision in table -->
                <table style="width:100%; border-collapse:collapse; margin-top:20px; background:#f9f9f9; border-radius:8px;">
                  <tr>
                    <td style="padding:20px; vertical-align:top;">
                      <h3>Our Mission</h3>
                      <p>
                      To provide superior, safe, and affordable transport services that connect communities, support local development,  
                      and ensure convenience for commuters in Metro Manila and Mindoro.
                      </p>
                    </td>
                    <td style="padding:20px; vertical-align:top;">
                      <h3>Our Vision</h3>
                      <p>
                      To be a leader in the Philippine bus transport industry, known for innovation, service excellence,  
                      and strong commitment to passenger safety and comfort.
                      </p>
                    </td>
                  </tr>
                </table>
				  
				<div class="column-clear"></div>
            </div>
        </div>
    </div>
   
    <!-- Footer -->
    <div id="footer">
	    <a href="index.php"><img src="images/footer-logo.jpg" alt="Dimple Star Transport" /></a>
	    <p>&copy; Dimple Star Transport</p>
    </div>
 
</div>
</body>
</html>
