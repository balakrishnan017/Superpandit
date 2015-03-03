<?php
	session_start();
	
	if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
	{
		header("location: index.php");
	}
	
	//connecting to database
	require_once("functions/dbcon.php");
	if(isset($_POST['add']))
	{				
		//fetch data from POST back
		extract($_POST);
		$t_id=mysql_real_escape_string($t_id);
		$t_name=mysql_real_escape_string($t_name);
		$city_id=mysql_real_escape_string($city_id);
		$address=mysql_real_escape_string($address);
		$sql="select * from tbl_temple where t_name like '$t_name' and t_id != $t_id";
		$res=mysql_query($sql);
		$count=mysql_num_rows($res);
		if($count >=1)
		echo "<script>alert('Temple name already exists.');</script>";
		else
		{
			
			$sql="update tbl_temple set t_name='$t_name',city_name='$city_id' ,t_address='$address' where t_id=$t_id";		
			$res=mysql_query($sql);
			$sql="delete from tbl_temple_pooja where t_id=$t_id";
			$res=mysql_query($sql);
			if($res){
				$pooja_id[]=$_POST['pooja_id'];
				$count=count($pooja_id)-1;
				for($i=0;$i< $count;$i++)
				{
					$sql_temple_pooja="insert into tbl_temple_pooja values('',$t_id,".$pooja_id[$i].")";
					$res_temple_pooja=mysql_query($sql_temple_pooja);		
				}
				if($res_temple_pooja)
				{
					echo "<script>alert('Data updated.');</script>";	
					header("location: view-temple.php");	
				}
				else
				{
					echo "<script>alert('Please try again.');</script>";
				}
			}
			else
			{
				echo "<script>alert('Please try again.');</script>";
			}
		}
	}
	
	$load_city="select * from tbl_location";
	$res_city=mysql_query($load_city);
	
	$load_pooja="select * from tbl_pooja";
	$res_pooja=mysql_query($load_pooja);
	
	if(isset($_GET['t_id'])){
		extract($_GET);
		$sql="select * from tbl_temple where t_id=$t_id";
		$res=mysql_query($sql);
		$data=mysql_fetch_array($res);
		$count=mysql_num_rows($res);
		if($count==0){
			header("location: view-temple.php");		
		}
		$sql1="select p_id from tbl_temple_pooja where t_id=$t_id";
		$res1=mysql_query($sql1);
		$search_pooja=array();
		while($data_res1=mysql_fetch_assoc($res1)){
			array_push($search_pooja,$data_res1['p_id']);
		}
		$cou=mysql_num_rows($res1);
		
	}else
	{
		header("location: view-temple.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Superpandit Pvt Ltd</title>
		<link href="css/mothere.css" rel="stylesheet" type="text/css" />
		
		<style type="text/css">
			<!--
				.style1 {color: #268CC5}
			-->
		</style>
	</head>
	
	<body>
		<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" valign="top" class="bg-main"><table width="941" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="941" align="left" valign="top"><table width="941" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td width="941"><table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="100%" colspan="2" align="left" valign="top"><?php include 'header.php'; ?></td>
									</tr>
									
								</table></td>
							</tr>
							<tr>
								<td align="left" valign="top"><h2>Edit Temple</h2></td>
							</tr>
						</table></td>
					</tr>
					
					<tr>
						<td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td align="left" valign="top" class="login-bg">
									<form method="post" >
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											
											<tr>
												<td width="48%" height="35" align="left" valign="middle" class="login-con">Name&nbsp;&nbsp; : </td>
												<td width="52%" height="35" align="left" valign="middle"><label>
													<input name="t_name" type="text" class="T-F" id="t_name" value="<?php echo $data['t_name'];?>" />
													<input type="hidden" name="t_id" id="t_id" value="<?php echo $t_id; ?>"/>
												</label></td>
											</tr>
											<tr>
												<td height="35" align="left" valign="top" class="login-con">City&nbsp;&nbsp;&nbsp;&nbsp; : </td>
												<td height="35" align="left" valign="middle"><label>
													<select name="city_id" class="T-F-L" id="city_id">
														<?php while($data_city=mysql_fetch_array($res_city)){ 
															if($data['city_name']==$data_city['l_city']){
															?>
															<option value="<?php echo $data_city['l_city']; ?>" selected="selected"><?php echo $data_city['l_city']; ?></option>
															<?php
																}else{
															?>
															<option value="<?php echo $data_city['l_city']; ?>"><?php echo $data_city['l_city']; ?></option>
														<?php }} ?>
													</select>
												</label></td>
											</tr>
											<tr>
												<td height="35" align="left" valign="top" class="login-con">Address&nbsp;&nbsp;&nbsp;&nbsp; : </td>
												<td height="35" align="left" valign="middle"><label>
													<textarea name="address" id="address" class="T-F-B2" id="address"><?php echo $data['t_address']; ?></textarea>
												</label></td>
											</tr>
											
											
											<tr>
												<td height="35" align="left" valign="middle" class="login-con">Types of Puja&nbsp;&nbsp;&nbsp;&nbsp; : </td>
												<td height="35" align="left" valign="middle"><div style="margin:8px 0 5px 0px;">
													<?php 
														while($data_pooja=mysql_fetch_array($res_pooja))
														{
															
															if($cou>0)
															{
																if(in_array($data_pooja['p_id'],$search_pooja))
																{
																?>
																<label>
																	<input type="checkbox" name="pooja_id[]" id="<?php echo $data_pooja['p_id']; ?>" checked="checked" class="check-size" value="<?php echo $data_pooja['p_id']; ?>" />
																&nbsp;&nbsp;<?php echo $data_pooja['p_name']; ?></label>
																<?php	
																}
																else{
																?>
																<label>
																	<input type="checkbox" name="pooja_id[]" id="<?php echo $data_pooja['p_id']; ?>" class="check-size" value="<?php echo $data_pooja['p_id']; ?>" />
																&nbsp;&nbsp;<?php echo $data_pooja['p_name']; ?></label>
																<?php }
															} 
															else 
															{ ?>
															<label>
																<input type="checkbox" name="pooja_id[]" id="<?php echo $data_pooja['p_id']; ?>" class="check-size" value="<?php echo $data_pooja['p_id']; ?>" />
															&nbsp;&nbsp;<?php echo $data_pooja['p_name']; ?></label>
															<?php 
															}
														} ?>
												</div></td>
											</tr>
											
											
											<tr>
												<td height="35" align="left" valign="middle">&nbsp;</td>
												<td height="35" align="left" valign="middle"><label>
													<input name="add" type="submit" class="T-F-S" id="add" value="Save" onclick="return validate();"/>
												</label></td>
											</tr>
										</table>
									</form></td>
							</tr>
						</table></td>
					</tr>
					<tr>
						<td align="left" valign="top"><?php include 'footter.html'; ?></td>
					</tr>
				</table></td>
			</tr>
		</table>
	</body>
	<script src="js/add_temple.js"></script>
	<script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-17311249-38']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
		<!-- Modified By Bala -->
		/* Validation */
		function validate()
		{
			//Temple Name Validation
			if(document.getElementById('t_name').value=="")
			{
				alert("Please Enter the Temple Name.");
				document.getElementById('t_name').focus();
				return false;
			}
			if(document.getElementById('t_name').value.length>200)
			{
				alert("Please check the Temple Name. It should not exceed above 200 character.");
				document.getElementById('t_name').focus();
				return false;
			}    
			
			//Temple Address Validation
			if(document.getElementById('address').value=="")
			{
				alert("Please Enter the Temple Address.");
				document.getElementById('address').focus();
				return false;
			}
			if(document.getElementById('address').value.length>500)
			{
				alert("Please check the Temple Address. It should not exceed above 500 character.");
				document.getElementById('address').focus();
				return false;
			}
			
			//Pooja Type Validation
			var chks = document.getElementsByName('pooja_id[]');
			var hasChecked = false;
			for (var i = 0; i < chks.length; i++)
			{
				if (chks[i].checked)
				{       
					hasChecked = true;     
					break;      
				}
			}
			if (hasChecked == false)
			{    
				alert("Please Select a Pooja Type.");    
				return false;
			}
		}
		<!-- Modified By Bala -->
		
	</script>
</html>
