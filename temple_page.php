<!-- TEMPLE PAGE -->

<!-- Open database connection -->
<?php
require_once("admin/functions/dbcon.php");
if(isset($_GET['t_id']) and $_GET['t_id'] != ""){
  $sql_temple="select t_id,t_name, city_name, t_address, t_image from tbl_temple where t_id=".$_GET['t_id'];
  $res_temple=mysql_query($sql_temple);
  $data_temple=mysql_fetch_array($res_temple);
  $sql_service="select t.t_name from tbl_temple t,tbl_temple_pooja tp where t.t_id=tp.t_id and t.pd_id=".$_GET['t_id']; 
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
        <div class="pandith-img"><img src="<?php echo $data_temple['t_image']; ?>" /></div>
      </div>
      <div class="boomi-pooja-bg fL">
        <h5><?php echo $data_temple['t_name']; ?></h5>  
        <p><strong>City Name: <?php echo $data_temple['city_name']; ?></strong></p>        
        <p><strong>Address : <span style="color:#ee2823;"><?php echo $data_temple['t_address']; ?></span></strong>
          <a href="superpandit.php"><div class="book-pandit fL">To Book a Pandit</div></a>
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
