<?php 
	session_start();
	
	require_once("admin/functions/dbcon.php");
	
	if(isset($_POST['login']))  
	{   
		extract($_POST);  
		$email_id=mysql_real_escape_string($email_id);
		$pass=mysql_real_escape_string($pass);
		
		$res=mysql_query("SELECT u_id FROM tbl_users WHERE email_id LIKE '$email_id' and pass LIKE '$pass'");
		
		if(mysql_num_rows($res) == 1)
		{
			$data=mysql_fetch_assoc($res);
			echo "<script> alert('Successful Login.'); </script>"; 
			$_SESSION['username'] = $email_id;
			$_SESSION['u_id'] = $data['u_id']; ;
			header("location: index.php");
		}
		else
		{
			echo "<script> alert('Invalid data. Please check your Username and Password.'); </script>"; 
			header("location: login.php");
		}  
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Superpandit Pvt Ltd</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<div id="main-wrap">
			<?php include ('header.php'); ?>
			<div class="main-body-content">
				<div class="book-pan-bg">
					<h5>login</h5>
					<form method="POST">
						<div class="book-field-bg">User Name<input name="email_id" id="email_id" type="email" required class="book-field" /></div>
						<div class="cB2"></div>
						<div class="book-field-bg">Password<input name="pass" id="pass" type="password" required class="book-field" /></div>
						<div class="cB2"></div>
						
						<input type="submit" name="login" value="Login"  class="btn" onclick="this.style.border='1px solid #7cb61d';" onblur="this.style.border='1px solid #1585b7';"/>
						<div class="cB2"></div>
					</form>
					
				</div>
				<div class="cB"></div>
			</div>
			<div class="cB1"></div>
			<?php include ('footer.php'); ?>
			<div class="cB"></div>
		</div>
	</body>
</html>
