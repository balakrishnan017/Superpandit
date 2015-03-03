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
  
  <div class="search-prof">
  <div class="search-prof-main">
  <div class="search-prof-inn">
  <img src="images/pandit-profile.jpg"  class="search-prof-img"/><p class="search-prof-con">pandit vidya bushan pandey shastri</p>
  <p class="search-prof-con1">B.com Computers</p>
  <p class="search-prof-con2">10 years Experiance</p>
  </div>
  
   <div class="search-prof-inn">
  <p class="search-prof-con3"><img src="images/search-icon.jpg" width="17" height="19" />virar west, thane<br />
INR 100<br />
mon-sat-9:00am-12:30,</p>
  </div>
 <div class="cB"></div> 
 </div>
 
 <div class="search-prof-main">
  <div class="search-prof-inn">
  <img src="images/pandit-profile.jpg"  class="search-prof-img"/><p class="search-prof-con">pandit vidya bushan pandey shastri</p>
  <p class="search-prof-con1">B.com Computers</p>
  <p class="search-prof-con2">10 years Experiance</p>
  </div>
  
   <div class="search-prof-inn">
  <p class="search-prof-con3"><img src="images/search-icon.jpg" width="17" height="19" />virar west, thane<br />
INR 100<br />
mon-sat-9:00am-12:30,</p>
  </div>
 <div class="cB"></div> 
 </div>
 
 <div class="search-prof-main">
  <div class="search-prof-inn">
  <img src="images/pandit-profile.jpg"  class="search-prof-img"/><p class="search-prof-con">pandit vidya bushan pandey shastri</p>
  <p class="search-prof-con1">B.com Computers</p>
  <p class="search-prof-con2">10 years Experiance</p>
  </div>
  
   <div class="search-prof-inn">
  <p class="search-prof-con3"><img src="images/search-icon.jpg" width="17" height="19" />virar west, thane<br />
INR 100<br />
mon-sat-9:00am-12:30,</p>
  </div>
 <div class="cB"></div> 
 </div>
 
  </div>
 
  
  
  
    <div class="cB"></div>
</div>
<div class="cB1"></div>
<?php include ('footer.php'); ?>
<div class="cB"></div>
</div>
</body>
</html>
