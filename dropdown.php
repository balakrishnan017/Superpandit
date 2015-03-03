

    <link href="drop-down/all.css" rel="stylesheet" type="text/css" media="all" />
    <!--[if IE 7]><link href="drop-down/ie7.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->
    <!--[if IE 6]><link href="drop-down/ie6.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->

    
    <script  src="drop-down/dropdown.js" type="text/javascript"></script>
	<script src="drop-down/site.js" type="text/javascript"></script>
    
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #ffffff;
}
-->
</style><div id="wrapper">

<!-- Modified By Bala -->

<?php
require_once("admin/functions/dbcon.php");

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

$sql_header="select p_name, p_id from tbl_pooja order by p_id";
$result_header=mysql_query($sql_header);


?>

<!-- Modified By Bala -->
      <ul id="nav">
        <li><a href="superpandit.php"><img src="drop-down/imags/superpandit.png" alt="home" name="h1" width="118" height="57" border="0" id="h1" onmouseover="h1.src='drop-down/imags/superpandit-h.png'" onmouseout="h1.src='drop-down/imags/superpandit.png'" /></a></li> 
        
        <li><a href="astrologer.php"><img src="drop-down/imags/astrologer.png" alt="media center" name="m1" width="118" height="57" border="0" id="m1" onmouseover="src='drop-down/imags/astrologer-h.png'" onmouseout="src='drop-down/imags/astrologer.png'" /></a></li>
        
        <li><a href="pooja-services.php"><img src="drop-down/imags/puja-service.png" alt="about us" name="a1" width="118" height="57" border="0" id="a1" onmouseover="src='drop-down/imags/puja-service-h.png'" onmouseout="src='drop-down/imags/puja-service.png'" /></a>
         <!--  <ul>  -->
 <!-- <li><a href="boomi-pooja.php">Bhoomi Pooja</a></li>
 <li><a href="#">Ganesh Pooja</a></li>
 <li><a href="#">Sathyanarayan Pooja</a></li> -->

            <ul class="dropdown-menu">
              <li><a href="pooja-services.php">Pooja Services</a></li>
              <?php while($data_header=mysql_fetch_array($result_header)){ ?>
                  <li><a href="pooja_page.php?p_id=<?php echo $data_header['p_id']; ?>"><?php echo $data_header['p_name']; ?></a></li>             
              <?php } ?>
 
        </ul></li>
        <li><a href="temple-services.php"><img src="drop-down/imags/temple-service.png" alt="investor disk" name="i1" width="141" height="57" border="0" id="i1" onmouseover="src='drop-down/imags/temple-service-h.png'" onmouseout="src='drop-down/imags/temple-service.png'" /></a>
        <ul class="dropdown-menu">
              <li><a href="temple-services.php">Temple Services</a></li>
              <?php 
              $sql_header="select t_name, t_id from tbl_temple order by t_id";
              $result_header=mysql_query($sql_header);
              while($data_header=mysql_fetch_array($result_header)){ ?>
                  <li><a href="temple_page.php?t_id=<?php echo $data_header['t_id']; ?>"><?php echo $data_header['t_name']; ?></a></li>             
              <?php } ?>
 
        </ul>
        </li>
        <li><a href="products.php"><img src="drop-down/imags/products.png" alt="media center" name="m1" width="118" height="57" border="0" id="m1" onmouseover="src='drop-down/imags/products-h.png'" onmouseout="src='drop-down/imags/products.png'" /></a>
        
        <ul> 
 <li><a href="ganesh-idol.php">Ganesh Idol</a></li>
 <li><a href="#">Pooja Kit</a></li>
 
        </ul>
        
        
        </li>
		
		<li><a href="contact-us.php"><img src="drop-down/imags/contact.png" alt="media center" name="m1" width="118" height="57" border="0" id="m1" onmouseover="src='drop-down/imags/contact-h.png'" onmouseout="src='drop-down/imags/contact.png'" /></a></li>
  </ul>
</div>