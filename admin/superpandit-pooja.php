<?php 
require_once("admin/functions/dbcon.php");
/*
$sql_all_pandit="select DISTINCT tbp.p_id, tbp.p_name, tbp.p_image FROM tbl_pandit tbp, tbl_pandit_pooja tbpp WHERE tbp.p_id = tbpp.p_id";
$res_all_pandit=mysql_query($sql_all_pandit);*/

  if(isset($_GET['p_id'])){
    extract($_GET);
    $sql_all_pandit="select DISTINCT tbp.p_id, tbp.p_name, tbp.p_image FROM tbl_pandit tbp, tbl_pandit_pooja tbpp WHERE tbp.p_id = tbpp.p_id and tbpp.p_id=$p_id";
    $res_all_pandit=mysql_query($sql);
    $data=mysql_fetch_array($res_all_pandit);
    $count=mysql_num_rows($res_all_pandit);
    if($count==0){
      header("location: pooja_page.php");    
    }
  }else
  {
    header("location: pooja_page.php");
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
  <?php while($data_all_pandit=mysql_fetch_array($res_all_pandit)){ ?>
  <div class="ganesh-bg fL">
  <div class="ganesh-idol-bg fL">
  <div class="ganesh-idol-main"> <img src="<?php echo $data_all_pandit['p_image']; ?>" /></div>
  <a href="purohit.php?p_id=<?php echo $data_all_pandit['p_id']; ?>"></a>
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
