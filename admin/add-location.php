<?php 
	session_start();

	if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
	{
		header("location: Index.php");
	}

	//connecting to database
	require_once("functions/dbcon.php");
	if(isset($_REQUEST['add']))
	{
		//fetch data from POST back
		extract($_REQUEST);
		$city1=mysql_real_escape_string($city);
		if($city1 != "")
		{
			$sql="select * from tbl_location where l_city like '$city1'";
			$res=mysql_query($sql);
			$count=mysql_num_rows($res);
			if($count >=1)
				echo "<script>alert('City already exists.');</script>";
			else
			{
				$sql="insert into tbl_location values('','$city1')";
				$res=mysql_query($sql);
				if($res){
					echo "<script>alert('Data inserted.');</script>";
				}else{
					echo "<script>alert('Please try again.');</script>";
				}
			}
		}
		else
		{
			echo "<script>alert('Please enter city name.');</script>";
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
.style2 {
	font-size: 12px;
	color: #FF0000;
}
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
        <td width="100%" colspan="2" align="left" valign="top"><?php include 'header.php'; ?></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"><h2>Add Location</h2></td>
  </tr>
</table></td>
      </tr>
      
      <tr>
        <td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" class="login-bg">
			<form method="post"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="35" align="left" valign="middle" class="login-con">City Name&nbsp; : </td>
                <td height="35" align="left" valign="middle"><input name="city" id="city" type="text" class="T-F" onkeypress="return alphabetsOnly(event);"/></td>
              </tr>
			  <tr>
                <td height="35" align="left" valign="middle"></td>
                <td height="35" align="left" valign="middle"><div class="style2" id="warning"></div></td>
              </tr>
              <tr>
                <td width="48%" height="35" align="left" valign="middle">&nbsp;</td>
                <td width="52%" height="35" align="left" valign="middle"><label>
                  <input name="add" type="submit" class="T-F-S" id="add" value="Add" onclick="return validate();" />
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
</body>
<script src="../js/jquery.js"></script>
<script src="js/add_location.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17311249-38']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

<!-- Modified By Bala -->
/* Validation */
function validate() {    
  //Name Validation
  if(document.getElementById('city').value=="")
  {
    alert("Please Enter the City Name.");
    document.getElementById('city').focus();
    return false;
  }
  if(document.getElementById('city').value.length>50)
  {
    alert("Please check the City Name. It should not exceed above 50 character.");
    document.getElementById('city').focus();
    return false;
  }
}

//Alphabets Only Validation
function alphabetsOnly(e)
{
  var unicode=e.charCode? e.charCode : e.keyCode;
  if (unicode!=8 && unicode!=32)
  { //if the key isn't the backspace key (which we should allow)
    if (unicode<65||unicode>90 && unicode<97||unicode>122) //if not a number
    return false; //disable key press
  }
}
<!-- Modified By Bala -->

</script>
</html>
