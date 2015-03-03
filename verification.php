<?php 
	
	require_once("admin/functions/dbcon.php");
	if(isset($_GET['code1']) and isset($_GET['code2'])){
		$code = $_GET['code1'];
		$email_id = $_GET['code2'];
		
		$code = base64_decode($code);
		$email_id = base64_decode($email_id);
		
		$select="SELECT * FROM tbl_users WHERE email_id like '$email_id'";
		$res=mysql_query($select);
		$count=mysql_num_rows($res);
		if($count==0){
			$select_query = "select * from tbl_temp_users where code = $code and email_id like '$email_id'";
			
			$res_query=mysql_query($select_query);
			$count=mysql_num_rows($res_query);
			if($count!=0){
				$data=mysql_fetch_array($res_query);
				extract($data);
				$ins_query = "insert into tbl_users values('', '$f_name', '$l_name', $mobile, '$email_id', '$address', '$pass') ";
				
				$res_select = mysql_query($ins_query);
				if($res_select)
				{
					echo"<script>alert('Registration Successfull');</script>";
				}
				else
				{
					echo "<script>alert('Please Retry Again');</script>";
				}
			}
			else{
				echo"<script>alert('Invalid Link');</script>";
			}
			}else{
			echo "<script>alert('You are already Registred');</script>";
		}
	}
	else
	{
		echo "<script>alert('Invalid Link...');</script>";
	}
?>
	<script>window.location = "index.php";</script>