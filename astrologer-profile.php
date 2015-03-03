<?php
require_once("admin/functions/dbcon.php");
if(isset($_GET['p_id']) and $_GET['p_id'] != ""){
	$sql_pandit="select p_id,p_name,p_image,p_dob,p_city_name,p_address from tbl_pandit where p_id=".$_GET['p_id'];
	$res_pandit=mysql_query($sql_pandit);
	$data_pandit=mysql_fetch_array($res_pandit);
	$sql_service="select p.p_name from tbl_pooja p,tbl_pandit_pooja pp where p.p_id=pp.p_id and pp.pd_id=".$_GET['p_id'];	
	$res_service=mysql_query($sql_service);
	
}else{
	header("location:superpandit.php");
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Superpandit</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="main-wrap">
  <?php include ('header.php'); ?>
  <div class="main-body-content">
  <div class="pandith-profile-bg fL">
  <div class="pandith-img"><img src="<?php echo $data_pandit['p_image']; ?>" /></div>
  </div>
  <div class="pandit-pro-con fL">
  <h4><?php echo $data_pandit['p_name']; ?></h4>
  <div class="date-of-birth fL"><strong>Date of Birth : </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data_pandit['p_dob']; ?></div>
  <div class="date-of-birth fL"><strong>City :</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data_pandit['p_city_name']; ?></div>

  <div class="date-of-birth fL"><strong>Description:</strong> <?php echo $data_pandit['p_address']; ?></div>
  <div class="cB3"></div>
 <h6>services</h6>
 
 <div class="pro-div-bo">
 <ul>
 <?php while($data_service=mysql_fetch_array($res_service)){ ?>
 <li><?php echo $data_service['p_name']; ?></li>
 <?php } ?>
 
 </ul>
 </div>
 
 
 <a href="book-a-astrologer.php"><div class="book-pandit fR">To Book a Astrologer</div></a></div> 
  <div class="cB"></div>
</div>
<div class="cB1"></div>
<?php include ('footer.php'); ?>
<div class="cB"></div>
</div>
</body>
</html>
