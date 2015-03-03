<?php 
require_once("admin/functions/dbcon.php");

$sql_all_pandit="select tbp.p_id, tbp.p_name, tbp.p_image FROM tbl_pandit tbp WHERE tbp.p_id in (SELECT DISTINCT pd_id FROM tbl_pandit_pooja)";
$res_all_pandit=mysql_query($sql_all_pandit);


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
  <?php while($data_all_pandit=mysql_fetch_array($res_all_pandit)){ ?>
  <div class="ganesh-bg fL">
  <div class="ganesh-idol-bg fL">
  <div class="ganesh-idol-main"> <img src="<?php echo $data_all_pandit['p_image']; ?>" /></div>
  <a href="purohit.php?p_id=<?php echo $data_all_pandit['p_id']; ?>">
  <div class="ganesh-con fL"><?php echo $data_all_pandit['p_name']; ?></div></a>
  </div>
  </div>
  <?php } ?>

  
  <div class="cB"></div>
</div>
<div class="cB"></div>
<?php include ('footer.php'); ?>
<div class="cB"></div>
</div>
</body>
</html>
