<?php

session_start();

  if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
  {
    header("location: index.php");
  }
  
  require_once("functions/dbcon.php");

if(isset($_GET['bk_id'])){
		extract($_GET);
		$sql="select * from tbl_book_pandit where bk_id=$bk_id";
		$res=mysql_query($sql);
		$data=mysql_fetch_array($res);
		$count=mysql_num_rows($res);
		if($count==0){
			header("location: booking-pandit.php");		
		}
	}else
	{
		header("location: booking-pandit.php");
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
.style2 {color: #FF0000}
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
    <td align="left" valign="top"><h2>View Pandit Booking</h2></td>
  </tr>
</table></td>
      </tr>
      
      <tr>
        <td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" class="login-bg">
			<form enctype="multipart/form-data" method="post">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              
              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Name: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F"><?php echo $data['bk_name']; ?></label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Email: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_email']; ?> </label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Mobile: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_mobile']; ?> </label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Address: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_address']; ?> </label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Pooja: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_type']; ?> </label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Pandit's Name: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_pname']; ?> </label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Occasion: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_occasion']; ?> </label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Date: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_date']; ?> </label>
                </td>
              </tr>

              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Comments: </td>
                <td width="52%" height="35" align="left" valign="middle">
                  <label name="name" id="name" type="text" class="T-F" ><?php echo $data['bk_comments']; ?> </label>
                </td>
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
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17311249-38']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  </script>
