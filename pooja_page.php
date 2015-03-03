<!-- POOJA PAGE -->

<!-- Open database connection -->
<?php
require_once("admin/functions/dbcon.php");
if(isset($_GET['p_id']) and $_GET['p_id'] != ""){
  $sql_pooja="select p_id,p_name,p_content, p_image, p_price from tbl_pooja where p_id=".$_GET['p_id'];
  $res_pooja=mysql_query($sql_pooja);
  $data_pooja=mysql_fetch_array($res_pooja);
  $sql_service="select p.p_name from tbl_pooja p,tbl_pandit_pooja pp where p.p_id=pp.p_id and pp.pd_id=".$_GET['p_id']; 
  $res_service=mysql_query($sql_service); 
} else {
  header("location:superpandit.php");
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
        <div class="pandith-img"><img src="<?php echo $data_pooja['p_image']; ?>" /></div>
      </div>
      <div class="boomi-pooja-bg fL">
        <h5><?php echo $data_pooja['p_name']; ?></h5>  
        <p><?php echo $data_pooja['p_content']; ?></p>        
        <p><strong>Price : <span style="color:#ee2823;">Rs <?php echo $data_pooja['p_price']; ?></span></strong>
          <a href="superpandit.php"><div class="book-pandit fL">To Book a Pooja</div></a>
        </p>  
      </div>
      <div class="cB"></div>
    </div>
    <div class="cB1"></div>
    <?php include ('footer.php'); ?>
    <div class="cB"></div>
  </div>
</body>
</html>
