<?php
	session_start();

	if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
	{
		header("location: index.php");
	}
	
	require_once("functions/dbcon.php");
	
	$sql="select * from tbl_book_pandit";
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	$rowno=1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Superpandit Pvt Ltd</title>
<link href="css/mothere.css" rel="stylesheet" type="text/css" />
<link href="css/aruna.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #268CC5}
-->
</style>
<script type="text/javascript">
function deletet(del)
{
	var a=confirm("Do You want to delete.If Yes. the categories & products of this brand will be deleted automaticaly.");
	if(a)
	{
		var xmlhttp;    
		if (del=="")
		 {
		  	document.getElementById("txtHint").innerHTML="";
		  	return;
		 }
		if (window.XMLHttpRequest)
		 {// code for IE7+, Firefox, Chrome, Opera, Safari
		  	xmlhttp=new XMLHttpRequest();
		 }
		else
		 {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		 }
			xmlhttp.onreadystatechange=function()
		 {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			
			window.location="booking-pandit.php";
			}
		  }
		xmlhttp.open("GET","functions/bookingFunction.php?del="+del,true);
		xmlhttp.send();
	}
}
</script>
</head>

<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top" class="bg-main"><table width="941" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="941" align="left" valign="top"><?php include 'header.php'; ?></td>
      </tr>
      <tr>
        <td align="left" valign="top"><h2>View Booking</h2></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="300" align="center" valign="top"><table width="700" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" valign="top"><a href="#">View all</a></td>
          </tr>
          <tr>
            <td align="right" valign="top"><img src="images/spacer.gif" width="1" height="5" /></td>
          </tr>
          <tr>
            <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="1">
              <tr>
                <td width="91" align="left" valign="top" class="table-h">SR No</td>
                <td width="177" align="left" valign="top" class="table-h">Name </td>
                <td width="171" align="left" valign="top" class="table-h">Mobile </td>
                <td width="177" align="left" valign="top" class="table-h">Pandit </td>
                <td width="177" align="left" valign="top" class="table-h">Date </td>
                <td width="126" align="left" valign="top" class="table-h">View</td>
                <td width="129" align="left" valign="top" class="table-h">Delete</td>
              </tr>
			  <?php 
			  if($count>0){
			  	while($data=mysql_fetch_array($res)){
			   ?>
              <tr>
                <td align="left" valign="top" class="table-t"><?php echo $rowno++; ?></td>
                <td align="left" valign="top" class="table-t"><?php echo $data['bk_name']; ?></td>
                <td align="left" valign="top" class="table-t"><?php echo $data['bk_mobile']; ?></td>
                <td align="left" valign="top" class="table-t"><?php echo $data['bk_pname']; ?></td>
                <td align="left" valign="top" class="table-t"><?php echo $data['bk_date']; ?></td> 
                <td align="left" valign="top" class="table-t"><a href="view-booking-pandit.php?bk_id=<?php echo $data['bk_id'] ?>"><img src="images/edit.png" alt="edit" width="20" height="20" border="0" /></a></td>
                <td align="left" valign="top" class="table-t"><a href="javascript:deletet(<?php echo $data['bk_id'] ?>);"><img src="images/delete.png" alt="delete" width="20" height="20" border="0" /></a></td>
              </tr>
              <?php }
			  }else
			  {
			  ?>
			  <tr><td colspan="5" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#333333;">There is no data to display</td></tr>
			  <?php
			  }
			  ?>
              
              
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          
        </table></td>
      </tr>
      <tr>
        <td height="20" align="left" valign="top">&nbsp;</td>
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
</html>
