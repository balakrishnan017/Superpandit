<?php
require_once("admin/functions/dbcon.php");
if(isset($_GET['b_id']) and $_GET['b_id'] != ""){

$sql_blog="select b_id,b_name,b_image,b_content from tbl_blog where b_id=".$_GET['b_id'];
$res_blog=mysql_query($sql_blog);
$data_blog=mysql_fetch_array($res_blog);
}else{
	header("location:blog.php");
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
  <div class="pandith-profile-bg fL">
  <div class="pandith-img"><a href="blog-details.php"><img src="images/blog-profile-img.jpg" /></a></div>
  </div>
  <div class="boomi-pooja-bg fL">
  <h5><?php echo $data_blog['b_name']; ?></h5>
 <img src="<?php echo $data_blog['b_image']; ?>" width="550" height="199" /><br />
 <br />
<p><?php echo $data_blog['b_content']; ?></p>
 
</div>
  <div class="cB"></div>
</div>
<div class="cB1"></div>
<?php include ('footer.php'); ?>
<div class="cB"></div>
</div>
</body>
</html>
