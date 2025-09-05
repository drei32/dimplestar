<?php
$con = mysqli_connect("localhost","root","","dimplestar");

// If DB fails
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// ✅ Include audit trail function
include 'php_includes/audit.php';

$errors = array();
$successful = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if(empty($fname)){
        $errors['fname'] = "* First Name is required.";
    }
    if(empty($lname)){
        $errors['lname'] = "* Last Name is required.";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "* Not a valid e-mail address.";
    }
    if(strlen($password) < 8){
        $errors['password'] = "* Password must contain at least 8 characters.";
    }
    if($password !== $confirm_password){
        $errors['confirm_password'] = "* Passwords do not match.";
    }

    // If no validation errors
    if(count($errors) === 0){
        $stmt = $con->prepare("SELECT id FROM members WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0){
            $errors['email'] = "Email address is already registered.";

            // ✅ Log failed signup attempt
            log_audit($con, $email, "Signup Failed - Email already registered");

        } else {
            $salt = bin2hex(random_bytes(16)); 
            $hashed_password = hash('sha256', $salt . hash('sha256', $password));

            $stmt = $con->prepare("INSERT INTO members (fname, lname, email, password, salt) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fname, $lname, $email, $hashed_password, $salt);

            if($stmt->execute()){
                $successful = "<script>alert('You are successfully registered! Please login.');</script>";

                // ✅ Log successful signup
                log_audit($con, $email, "Signup Successful");

                $_POST = array();
            } else {
                $errors['general'] = "Something went wrong. Please try again.";

                // ✅ Log failed signup
                log_audit($con, $email, "Signup Failed - Database Error");
            }
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Dimple Star Transport</title>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="icon" href="images/icon.ico" type="image/x-con">
<style>
.error {
    color: red;
    font-size: 14px;
    margin: 4px 0;
    display: block;
}
.success {
    color: green;
    font-size: 14px;
    margin: 4px 0;
    display: block;
}
.password-rules {
    font-size: 13px;
    margin: 5px 0;
}
.password-rules span {
    display: block;
    color: red;
}
.password-rules span.valid {
    color: green;
}
.password-wrapper {
    position: relative;
}
.password-wrapper input {
    width: 100%;
    padding-right: 35px;
}
.password-wrapper .toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>
</head>
<body>
<div id="wrapper">
	<div id="header">
        <h1><a href="index.php"><img src="images/logo.png" class="logo" alt="Dimple Star Transport" /></a></h1>
        <ul id="mainnav">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="terminal.php">Terminals</a></li>
            <li><a href="routeschedule.php">Routes / Schedules</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="book.php">Book Now</a></li>
        </ul>
	</div>
    <div id="content">
    	<div id="gallerycontainer2">
			<div style="margin:0 auto; padding:30px; max-width: 600px;">
				
                <!-- Login -->
				<div class="login">
				<form method="post" action="login.php">
					<table>
						<tr><td>E-mail</td><td>Password</td></tr>
						<tr>
							<td><input type="text" name="login_email" id="login_email"></td>
							<td><input type="password" name="login_password" id="login_password"></td>
							<td><input type="submit" name="submit" id="login" value="Login"></td>
						</tr>
						<tr>
						    <td colspan="2"><?php if(isset($_GET['message'])){ echo "<h2>" .$_GET['message']. "</h2>"; } ?></td>
						</tr>
					</table>
				</form>
				</div>

                <!-- Signup -->
                <div class="form">
                <?= $successful ?>
                <?php if(isset($errors['general'])){ echo "<span class='error'>".$errors['general']."</span>"; } ?>
                <form method="post" action="signlog.php">
                    <table>
                        <tr><td colspan="2"><br><h1>Sign Up</h1><br></td></tr>
                        <tr>
                            <td><input type="text" name="fname" id="fname" placeholder="First Name" value="<?= $_POST['fname'] ?? '' ?>"></td>
                            <td><input type="text" name="lname" id="lname" placeholder="Last Name" value="<?= $_POST['lname'] ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td><?php if(isset($errors['fname'])){echo '<span class="error">'.$errors['fname'].'</span>'; } ?></td>
                            <td><?php if(isset($errors['lname'])){echo '<span class="error">'.$errors['lname'].'</span>'; } ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" name="email" id="email" placeholder="E-mail Address" value="<?= $_POST['email'] ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php if(isset($errors['email'])){echo '<span class="error">'.$errors['email'].'</span>'; } ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="password-wrapper">
                                    <input type="password" name="password" id="pw" placeholder="Password">
                                    <span class="toggle-password" onclick="togglePassword('pw', this)">👁️</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="password-rules" class="password-rules">
                                    <span id="rule-length">❌ At least 8 characters</span>
                                    <span id="rule-upper">❌ At least 1 uppercase letter</span>
                                    <span id="rule-number">❌ At least 1 number</span>
                                    <span id="rule-special">❌ At least 1 special character</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="password-wrapper">
                                    <input type="password" name="confirm_password" id="cpw" placeholder="Confirm Password">
                                    <span class="toggle-password" onclick="togglePassword('cpw', this)">👁️</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><span id="match-msg" class="error"></span></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" id="submit" value="Sign Up"></td>
                        </tr>
                    </table>
                </form>
                </div>
				
            </div>
        </div>
    </div>
   
    <div id="footer">
	    <a href="index.php"><img src="xres/images/footer-logo.jpg" alt="Dimple Star Transport" /></a>
	    <p>&copy;Dimple Star Transport<br /></p>
    </div>
</div>

<script>
function togglePassword(id, el) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        el.textContent = "🙈";
    } else {
        input.type = "password";
        el.textContent = "👁️";
    }
}

const passwordInput = document.getElementById("pw");
const confirmInput = document.getElementById("cpw");
const rules = {
    length: document.getElementById("rule-length"),
    upper: document.getElementById("rule-upper"),
    number: document.getElementById("rule-number"),
    special: document.getElementById("rule-special")
};
const matchMsg = document.getElementById("match-msg");

passwordInput.addEventListener("input", checkPassword);
confirmInput.addEventListener("input", checkPassword);

function checkPassword() {
    const pass = passwordInput.value;
    const confirm = confirmInput.value;

    // Rules
    if (pass.length >= 8) rules.length.classList.add("valid"), rules.length.textContent = "✔ At least 8 characters";
    else rules.length.classList.remove("valid"), rules.length.textContent = "❌ At least 8 characters";

    if (/[A-Z]/.test(pass)) rules.upper.classList.add("valid"), rules.upper.textContent = "✔ At least 1 uppercase letter";
    else rules.upper.classList.remove("valid"), rules.upper.textContent = "❌ At least 1 uppercase letter";

    if (/[0-9]/.test(pass)) rules.number.classList.add("valid"), rules.number.textContent = "✔ At least 1 number";
    else rules.number.classList.remove("valid"), rules.number.textContent = "❌ At least 1 number";

    if (/[^A-Za-z0-9]/.test(pass)) rules.special.classList.add("valid"), rules.special.textContent = "✔ At least 1 special character";
    else rules.special.classList.remove("valid"), rules.special.textContent = "❌ At least 1 special character";

    // Match
    if (confirm.length > 0) {
        if (pass === confirm) {
            matchMsg.textContent = "✔ Passwords match";
            matchMsg.classList.remove("error");
            matchMsg.classList.add("success");
        } else {
            matchMsg.textContent = "❌ Passwords do not match";
            matchMsg.classList.remove("success");
            matchMsg.classList.add("error");
        }
    } else {
        matchMsg.textContent = "";
    }
}
</script>
</body>
</html>
