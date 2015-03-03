<?php 
	require_once("admin/functions/dbcon.php");
	
	$sql_all_blog="select b_id,b_name,b_image,b_content from tbl_blog order by b_date desc ";
	$res_all_blog=mysql_query($sql_all_blog);
	
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
					<div class="pandith-img"><img src="images/blog-profile-img.jpg" /></div>
				</div>
				<?php while($data_all_blog=mysql_fetch_array($res_all_blog)){ ?>
					<div class="boomi-pooja-bg fL">
						<h5>blog</h5>
						<div class="b-m-c fL"> 	
							<a href="blog-details.php?b_id=<?php echo $data_all_blog['b_id']; ?>"><img src="<?php echo $data_all_blog['b_image']; ?>" border="0" class="blog-img" /></a><b><?php echo $data_all_blog['b_name']; ?> :</b>
							<?php echo substr($data_all_blog['b_content'],0,200); ?>
							<br />
							<a href="blog-details.php?b_id=<?php echo $data_all_blog['b_id']; ?>"><div class="book-pandit fL blog-mr">Find Out More</div></a>
						</div>
						<div class="blog-under fL"></div>
					</div>
				<?php } ?>
				<div class="cB"></div>
			</div>
			<div class="cB1"></div>
			<?php include ('footer.php'); ?>
			<div class="cB"></div>
		</div>
	</body>
</html>
