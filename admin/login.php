<?php 
	session_start();
	//connecting to database 
	
	require_once("functions/dbcon.php");
	
	//fetching email and password from url string
	$email=mysql_real_escape_string($_GET['email1']);
	$password=mysql_real_escape_string($_GET['password1']);
	
	// check if e-mail address syntax is valid or not
	//$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
	//if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
//		echo "invaild";
//	}
//	else
//	{
		// Matching user input email and password with stored email and password in database.
		$sql="SELECT * FROM tbl_login WHERE u_username= '$email' AND u_password = '$password' ";
		
			$res=mysql_query($sql);
			$count=mysql_num_rows($res); 
			$data=mysql_fetch_array($res);
			if($count==1)
			{
				
				$_SESSION['sess_user_id'] = $data['u_id'];;
				$_SESSION['sess_username'] = $data['u_username'];
				
				echo "correct";
			}else{
				echo "wrong";
			}
		
?>
