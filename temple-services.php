<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Superpandit Pvt Ltd</title>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div id="main-wrap">
    <?php include ('header.php'); 
    require_once("admin/functions/dbcon.php"); 
    ?>
    <div class="main-body-content">
      <div>
       <?php               
       $sql_header="select t_id, t_name, t_image from tbl_temple";
       $result_header=mysql_query($sql_header);
       while($data_header=mysql_fetch_array($result_header)){ ?>
       <div class="ganesh-bg fL">
    <div class="ganesh-idol-bg fL">
    <div class="ganesh-idol-main"> <img src="<?php echo $data_header['t_image']; ?>" /></div>
    <a href="temple_page.php?t_id=<?php echo $data_header['t_id']; ?>">
    <div class="ganesh-con fL"><?php echo $data_header['t_name']; ?></div></a>
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