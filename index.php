<?php 
	require_once("admin/functions/dbcon.php");
	
	$sql_all_blog="select b_id,b_name,b_image,b_content from tbl_blog order by b_date desc LIMIT 2";
	$res_all_blog=mysql_query($sql_all_blog);
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Superpandit</title>
		<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	
	<body>
		<div id="main-wrap">
			<?php include ('header.php'); ?>
			<div class="banner"><iframe width="100%" height="378px" src="banner.html" scrolling="no" marginheight="0" marginwidth="0"></iframe> </div>
			
			<div class="search-bg123">
				<div class="search-bg fL">
					<div class="search-bg1">
						<?php include ('side-tab.html'); ?> 
						
					</div>
				</div>
				<div class="cB"></div>
			</div>
            
            
            
			<div class="main-body-content">
				
				<div class="easy-bg fL"><img src="images/easy.jpg" border="0" class="easy-img" />
					<h2>Superpandit</h2>
					<ul class="super">
						<li>Book Superpandit</li>
						<li>Standard Puja Service</li>
						<li>Feel Blessed</li>
					</ul></div>
					
					<div class="easy-bg fL easy-mr"><img src="images/reliable.jpg" border="0" class="easy-img" />
						<h2>Temple Booking</h2>
						<ul class="super">
							<li>Select Temple</li>
							<li>Select Type of Puja</li>
							<li>Perform Rituals</li>
						</ul></div>
						
						<div class="easy-bg fL"><img src="images/knowledge-centre.jpg" border="0" class="easy-img" />
							<h2>Knowledge Centre</h2>
							<ul class="super">
								<li>Scientific Reasoning</li>
								<li>Cultural Heritage</li>
								<li>Sanskrit Empowerment</li>
							</ul></div>
							
							<div class="diagram-bg fL">
								<div class="diagram fL">
									<h2 style="margin:0 0 -10px 0px;">Why is Superpandit</h2>
									<br />
								Superpandit is a Pujari who is well qualified and degree holder in Acharya/Shastri in Sanskrit/Veda's/Astrology etc. We at <a href="#"><strong>www.superpandit.com</strong></a> select the reliable, qualified and knowledgable pujari for all your puja needs. After booking puja on the website Superpandit (Pujari) will come to your place with the complete puja requirements and perform the puja on the given schedule. We have standard fees for all types of puja we offer. Our pujari will not accept any kind of fees/material/Samagri from your place. With superpandit you can also book puja/aarti at the temples near you. So be happy be blessed.</div>
								<div class="youtube-video fL"><iframe width="388" height="227" src="//www.youtube.com/embed/Q8lmVblMCrU" frameborder="0" allowfullscreen></iframe></div>
							</div>
							
							<div class="blog-bg fL">
								<div class="blog-con-bg fL">
									<h2><a href="blog.php">blog</a></h2>
									
									<div class="blo-bg">
										<?php while($data_all_blog=mysql_fetch_array($res_all_blog)){ ?>
											<p style="color:#000;"><?php echo $data_all_blog['b_name']; ?></p>
											<a href="blog-details.php?b_id=<?php echo $data_all_blog['b_id']; ?>"><img src="<?php echo $data_all_blog['b_image']; ?>" border="0" class="blog-img" /></a>
											<?php echo substr($data_all_blog['b_content'],0,150); ?>
											<div class="know"><a href="blog-details.php?b_id=<?php echo $data_all_blog['b_id']; ?>"><strong>Knowmore</strong></a></div>
											<div class="blog-underline fL"><img src="images/underline.jpg" width="6" height="311" /></div>
											<?php
											} ?>
									</div>										
									
								</div>
								<div class="blog-underline fL"><img src="images/underline.jpg" width="6" height="311" /></div>
								
								<div class="twitt-bg fL">
									<a class="twitter-timeline" href="https://twitter.com/asuperpandit" data-widget-id="560371446543708160">Tweets by @asuperpandit</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
								</div>
							</div>
							<div class="cB"></div>
			</div>
			<?php include ('footer.php'); ?>
			<div class="cB"></div>
		</div>
	</body>
</html>
