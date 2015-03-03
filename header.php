<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Superpandit</title>
		<meta name="google-site-verification" content="MMlLV58hJf9LvJvDjasCEqrae5aFP0LZ0qN0M2q_SxQ" />
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<div id="header">
			<div id="header-top">
				<div class="logo fL">
					<a href="index.php"><img src="images/logo.png" border="0" /></a>
				</div>
				<div class="header-right fR">
					<div class="logon-bg fL">
						<?php if(!isset($_SESSION['username']) and !isset($_SESSION['u_id'])){ ?>
							<a href="sign-up.php">
							<img src="images/signup.png" width="83" height="28" border="0" onmouseover="src='images/signup-h.png'" onmouseout="src='images/signup.png'" /></a> 
							<a href="login.php">
							<img src="images/login.png" class="social-img" width="83" height="28" border="0" onmouseover="src='images/login-h.png'" onmouseout="src='images/login.png'" />
							</a>
							<?php } else { ?>
							<a href="logout.php">
							<img src="images/logout.png" class="social-img" width="83" height="28" border="0" onmouseover="src='images/logout-h.png'" onmouseout="src='images/logout.png'" />
							</a>
						<?php } ?>
					</div>
					<div class="contact-icon fR">+ 91 - 8600009582</div>
				</div>
				<div class="nav fR"><?php include ('dropdown.php'); ?></div>
			</div>
		</div>
	</body>
</html>
