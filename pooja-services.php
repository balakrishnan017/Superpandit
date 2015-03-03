<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Superpandit Pvt Ltd</title>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <!-- Modified By Bala -->

  <?php
  require_once("admin/functions/dbcon.php"); 

  $sql_header="select p_name, p_image from tbl_pooja";
  $result_header=mysql_query($sql_header);
  ?>

  <!-- Modified By Bala -->

  <div id="main-wrap">
    <?php include ('header.php'); ?>
    <div class="main-body-content">              
      
      <div>
       <?php               
       $sql_header="select p_id, p_name, p_image from tbl_pooja";
       $result_header=mysql_query($sql_header);
       while($data_header=mysql_fetch_array($result_header)){ ?>
       <div class="ganesh-bg fL">
        <div class="ganesh-idol-bg fL">
        <div class="ganesh-idol-main"> <img src="<?php echo $data_header['p_image']; ?>" /></div>
        <a href="pooja_page.php?p_id=<?php echo $data_header['p_id']; ?>">
          <div class="ganesh-con fL"><?php echo $data_header['p_name']; ?></div></a>
        </div>
      </div>
      <?php } ?>
    </div>     
    
    <div class="cB"></div>
  </div>
  <div class="cB"></div>
  <?php include ('footer.php'); ?>
  <div class="cB"></div>
</div>
</body>
</html>