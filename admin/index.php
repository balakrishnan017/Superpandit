<?php

session_start();

//connecting to database 
require_once("functions/dbcon.php");
if(isset($_SESSION['sess_user_id']) and isset($_SESSION['sess_username']))
{
	header("location: home.php");
}
if(isset($_REQUEST['login'])){

	extract($_REQUEST);
	
	//fetching email and password from url string
	$username=mysql_real_escape_string($_REQUEST['username']);
	$password=mysql_real_escape_string($_REQUEST['password']);
	

	$sql="SELECT * FROM tbl_login WHERE u_username= '$username' AND u_password = '$password' ";
	
	$res=mysql_query($sql);
	$count=mysql_num_rows($res); 
	$data=mysql_fetch_array($res);
	if($count==1)
	{
		
		$_SESSION['sess_user_id'] = $data['u_id'];;
		$_SESSION['sess_username'] = $data['u_username'];
		
		echo "<script>alert('Logged in successfully.');</script>";
		header("location: home.php");
	}
	else
	{
		echo "<script>alert('Please check your username and password');</script>";
	}
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Superpandit Pvt Ltd</title>
<link href="css/mothere.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.style2 {color: #FF0033}
-->
</style>
</head>

<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" class="bg-main"><table width="941" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="941" align="left" valign="top"><table width="941" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="941"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="left" valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td width="72%" align="left" valign="top" class="logo-position"><img src="images/logo.png" /></td>
        <td width="28%" align="right" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table></td>
      </tr>
      
      <tr>
        <td height="400" align="left" valign="middle"><h2>login</h2><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" class="login-bg"><form method="post">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              
              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">User Name&nbsp;&nbsp; : </td>
                <td width="52%" height="35" align="left" valign="middle"><label>
                  <input name="username" id="username" type="text" class="T-F" />
                </label></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="middle" class="login-con">Password&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><input name="password" id="password" type="password" class="T-F" /></td>
              </tr>
			  <tr>
                <td height="35" align="left" valign="middle"> </td>
                <td height="35" align="left" valign="middle"><div class="style2" id="warning"></div></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="middle">&nbsp;</td>
                <td height="35" align="left" valign="middle"><label>
                  <input name="login" type="submit" class="T-F-S" id="login" value="Login" />
                </label></td>
              </tr>
            </table>
            </form></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top"><?php include 'footter.html'; ?></td>
      </tr>
    </table></td>
  </tr>
</table>
</body><script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17311249-38']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script src="../js/jquery.js"></script>
<script src="js/login.js"></script>
</html>
