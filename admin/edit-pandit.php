<?php
	session_start();
	
	if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
	{
		header("location: Index.php");
	}
	
	
	require_once("functions/dbcon.php");
	function file_extension($filename)
	{
		$path_info = pathinfo($filename);
		return $path_info['extension'];
	}
	if(isset($_POST['add'])){
		extract($_POST);
		$p_id=mysql_real_escape_string($p_id);
		$p_name=mysql_real_escape_string($p_name);
		$dob=mysql_real_escape_string($dob);
		$p_email_id=mysql_real_escape_string($p_email_id);
		$p_mob=mysql_real_escape_string($p_mob);
		$p_expr=mysql_real_escape_string($p_expr);
		$p_address=mysql_real_escape_string($p_address);
		$p_city_name=mysql_real_escape_string($p_city_name);
		$p_pincode=mysql_real_escape_string($p_pincode);
		$lang=mysql_real_escape_string(implode(",",$lang));
		//$pooja_id=implode(",",$pooja_id);
		$p_spec=mysql_real_escape_string($p_spec);
		$p_avail=mysql_real_escape_string($p_avail);
		if($isAstrologer=='on'){
			$isAstrologer='checked';
		}else
		{
			$isAstrologer='';
		}
		
		if($p_name != "")
		{
			
			$sql1="select * from tbl_pandit where p_id = $p_id";
			$res1=mysql_query($sql1);
			
			$data=mysql_fetch_array($res1);
			$p_image=$_FILES['p_image']['name'];
			if($p_image!="")
			{
				unlink('../'.$data['p_image']);
				$p_image='images/pandit_image/'.$p_image;
				move_uploaded_file($_FILES['p_image']['tmp_name'],'../'.$p_image);
			}
			else
			{
				
				$p_image=$data['p_image'];
				
			}
			
			$p_thumbImage=$_FILES['p_thumbImage']['name'];
			if($p_thumbImage!="")
			{
				unlink('../'.$data['p_thumbImage']);
				$p_thumbImage='images/pandit_image/thumb/'.$p_thumbImage;
				move_uploaded_file($_FILES['p_thumbImage']['tmp_name'],'../'.$p_thumbImage);
			}
			else
			{
				
				$p_thumbImage=$data['p_thumbImage'];
				
			}
			
			$sql="update tbl_pandit set p_name='$p_name',p_dob='$dob',p_email='$p_email_id',p_mob='$p_mob',p_image='$p_image',p_thumbImage='$p_thumbImage',p_expr='$p_expr',p_address='$p_address',p_city_name='$p_city_name',p_pincode='$p_pincode',p_lang='$lang',p_spec='$p_spec',p_avail='$p_avail',isAstrologer='$isAstrologer' where p_id=$p_id";
			
			$res=mysql_query($sql);
			$sql="delete from tbl_pandit_pooja where pd_id=$p_id";
			$res=mysql_query($sql);
			if($res){
				$pooja_id[]=$_POST['pooja_id'];
				$count=count($pooja_id);
				if($count>1)
				{
					$count=$count-1;
					for($i=0;$i< $count;$i++)
					{
						$sql_pandit_pooja="insert into tbl_pandit_pooja values('',$p_id,".$pooja_id[$i].")";
						$res_pandit_pooja=mysql_query($sql_pandit_pooja);		
					}
					if($res_pandit_pooja)
					{
						echo "<script>alert('Data updated.');</script>";	
						header("location: view-pandit.php");	
					}
					else
					{
						echo "<script>alert('Please try again.');</script>";
					}
				}
				else
				{
					echo "<script>alert('Data updated.');</script>";	
					header("location: view-pandit.php");	
				}
			}
			else
			{
				echo "<script>alert('Please try again.');</script>";
			}
			
		}	
		else
		{
			echo "<script>alert('Please enter Pandit name.');</script>";
		}
		
	}
	
	
	
	//-------------------------------------------
	if(isset($_GET['p_id']))
	{
		extract($_GET);
		$sql="select * from tbl_pandit where p_id=$p_id";
		$res=mysql_query($sql);
		$data=mysql_fetch_array($res);
		$count=mysql_num_rows($res);
		if($count==0){
			header("location: view-pooja.php");		
		}
		$sql1="select p_id from tbl_pandit_pooja where pd_id=$p_id";
		//echo $sql1;
		$res1=mysql_query($sql1);
		$search_pooja=array();
		while($data_res1=mysql_fetch_assoc($res1)){
			array_push($search_pooja,$data_res1['p_id']);
		}
		//print_r($search_pooja);
		$cou=mysql_num_rows($res1);
	}else
	{
		header("location: view-pooja.php");
	}
	
	
	
	$load_city="select * from tbl_location";
	$res_city=mysql_query($load_city);
	
	$load_pooja="select * from tbl_pooja";
	$res_pooja=mysql_query($load_pooja);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Superpandit Pvt Ltd</title>
		<link href="css/mothere.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		<script>
			
			$(function() {
				$( "#dob" ).datepicker({
					changeMonth: true,
					changeYear: true,
					dateFormat: "dd-mm-yy"
				});	
			});
			
		</script>
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
								<td align="left" valign="top"><h2>Edit Pandit</h2></td>
							</tr>
						</table></td>
					</tr>
					
					<tr>
						<td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
								<td align="left" valign="top" class="login-bg"><form  method="post" enctype="multipart/form-data" ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
									
									<tr>
										<td width="48%" height="35" align="left" valign="middle" class="login-con">Name&nbsp;&nbsp; : </td>
										<td width="52%" height="35" align="left" valign="middle"><label>
											<input name="p_name" type="text" class="T-F"  id="p_name" maxlength="100" value="<?php echo $data['p_name']; ?>" onkeypress="return alphabetsOnly(event);"/>
											<input name="p_id" id="p_id" value="<?php echo $data['p_id']; ?>" type="hidden"/>
										</label></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Date of Birth&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><input name="dob" maxlength="12"  id="dob" type="text" class="T-F" value="<?php echo $data['p_dob']; ?>" /></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Email Id&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><input name="p_email_id" id="p_email_id" maxlength="50" type="email" class="T-F" value="<?php echo $data['p_email']; ?>" /></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Mobile Number&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><input name="p_mob" id="p_mob" type="text" class="T-F" value="<?php echo $data['p_mob']; ?>" onkeypress="return numbersOnly(event);"/></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Big Image&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><label>
											<input type="file" name="p_image" id="p_image" accept="image/jpeg" onchange="return imagesOnly();"/>
											<img src="<?php echo "../".$data['p_image']; ?>" width="59" height="67"/>( Size  340 x 340                )
										</label></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Small Image&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><label>
											<input type="file" name="p_thumbImage" id="p_thumbImage" accept="image/jpeg" onchange="return imagesOnly();"/>
											<img src="<?php echo "../".$data['p_thumbImage']; ?>" width="59" height="67"/> Size  201 x 193                )
										</label></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Experience&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><input name="p_expr" id="p_expr" maxlength="2" type="text" class="T-F" value="<?php echo $data['p_expr']; ?>" /></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="top" class="login-con">Description &amp; Address&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><label>
											<textarea name="p_address" id="p_address" class="T-F-B2" maxlength="500" ><?php echo $data['p_address']; ?></textarea>
										</label></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="top" class="login-con">City&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><label>
											<select name="p_city_name" class="T-F-L" id="p_city_name">
												<?php while($data_city=mysql_fetch_array($res_city)){ 
													if($data_city['l_city']==$data['p_city_name'])
													{?>
													<option value="<?php echo $data_city['l_city']; ?>" selected="selected"><?php echo $data_city['l_city']; ?></option>
													<?php
													}
													else{				
													?>
													<option value="<?php echo $data_city['l_city']; ?>"><?php echo $data_city['l_city']; ?></option>
												<?php } } ?>
											</select>
										</label></td>
									</tr>
									
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Pincode&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><input name="p_pincode" id="p_pincode" maxlength="10" type="text" class="T-F" value="<?php echo $data['p_pincode']; ?>" /></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Language Known&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><div style="margin:8px 0 5px 0px;"><label></label>
											<table width="100%" border="0" cellpadding="0" cellspacing="0" class="login-con">
												<tr>
													<td width="51%"><label>
														<?php $lang_arr=explode(',',$data['p_lang']);?>
														<input type="checkbox" name="lang[]" id="lang1" class="check-size" value="Hindi"
														<?php if(in_array('Hindi',$lang_arr)){?> checked="checked" <?php  }?>/>
													&nbsp;&nbsp;Hindi</label></td>
													<td width="49%"><label>
														<input type="checkbox" name="lang[]" id="lang1" class="check-size" value="Marathi"
														<?php if(in_array('Marathi',$lang_arr)){?> checked="checked" <?php  }?>/>
														
													&nbsp;&nbsp;Marathi</label></td>
												</tr>
												<tr>
													<td><label>
														<input type="checkbox" name="lang[]" id="lang1" class="check-size" value="Telugu"
														<?php if(in_array('Telugu',$lang_arr)){?> checked="checked" <?php  }?>/>
														
													&nbsp;&nbsp;Telugu</label></td>
													<td><label>
														<input type="checkbox" name="lang[]" id="lang1" class="check-size" value="Tamil"
														<?php if(in_array('Tamil',$lang_arr)){?> checked="checked" <?php  }?>/>
														
													&nbsp;&nbsp;Tamil</label></td>
												</tr>
											</table>
										</div></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Types of Puja&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle">
											<div style="margin:8px 0 5px 0px;">
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
											</div>
										</td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Specialization&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><input name="p_spec" id="p_spec" type="text" class="T-F" value="<?php echo $data['p_spec']; ?>" /></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Is Astrologer&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><input name="isAstrologer" id="isAstrologer" type="checkbox" class="check-size" <?php echo $data['isAstrologer']; ?> /></td>
									</tr>
									<tr>
										<td height="35" align="left" valign="middle" class="login-con">Availbility&nbsp;&nbsp;&nbsp;&nbsp; : </td>
										<td height="35" align="left" valign="middle"><label>
											<select name="p_avail" id="p_avail" class="T-F-L">
												<option  value="Full time" <?php if($data['p_avail']="Full time") echo"selected='selected'"; ?>  >Full time</option>
												<option  value="Part time" <?php if($data['p_avail']="Part time") echo "selected='selected'"; ?> >Part time</option>
											</select>
										</label></td>
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
		</body><script type="text/javascript">
		
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-17311249-38']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		
		<!-- Modified By Bala -->
		function validate() 
		{   
			//Name Validation
			if(document.getElementById('p_name').value=="")
			{
				alert("Please Enter the Name.");
				document.getElementById('p_name').focus();
				return false;
			}
			if(document.getElementById('p_name').value.length>100)
			{
				alert("Please check the Name. It should not exceed above 100 character.");
				document.getElementById('p_name').focus();
				return false;
			}
			
			//DOB Validation
			if(document.getElementById('dob').value=="")
			{
				alert("Please Enter the Date of Birth.");
				document.getElementById('dob').focus();
				return false;
			}
			
			//EmailId Validation
			if(document.getElementById('p_email_id').value=="")
			{
				alert("Please Enter the Email-id.");
				document.getElementById('p_email_id').focus();
				return false;
			}
			if(document.getElementById('p_email_id').value.length>50)
			{
				alert("Please check the Email-id. It should not exceed above 50 character.");
				document.getElementById('p_email_id').focus();
				return false;
			} 
			
			var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
			if(!(document.getElementById('p_email_id').value.match(mailformat)))  
			{  
				alert("Please Enter a valid Email id.")
				document.getElementById('p_email_id').focus();  
				return false;  
			}
			
			//Mobile Lenght Validation
			var phoneno = /^\d{10}$/;
			if(!document.getElementById('p_mob').value.match(phoneno))
			{
				alert("Please Enter a valid Mobile Number");
				document.getElementById('p_mob').focus();
				return false;
			}
			
			//JPEG Image Validation
			var fileName = document.getElementById('p_image').value;
			var ext = fileName.substring(fileName.lastIndexOf('.') + 1);    
			if(document.getElementById('p_image').value!="" && (ext != "JPEG" && ext != "jpeg" && ext != "jpg"))
			{
				alert("Please Upload an JPEG image."); 
				document.getElementById('p_image').focus();   
				return false;
			} 
			
			//Experience Validation 
			if(document.getElementById('p_expr').value=="")
			{
				alert("Please Enter the Experience.");
				document.getElementById('p_expr').focus();
				return false;
			}
			if(document.getElementById('p_expr').value.length>2)
			{
				alert("Please check the Experience. It should not exceed above 2 character.");
				document.getElementById('p_expr').focus();
				return false;
			}
			
			//Address Validation
			if(document.getElementById('p_address').value=="")
			{
				alert("Please Enter the Address.");
				document.getElementById('p_address').focus();
				return false;
			}
			if(document.getElementById('p_address').value.length>500)
			{
				alert("Please check the Address. It should not exceed above 500 character.");
				document.getElementById('p_address').focus();
				return false;
			}
			
			//Pincode Validation
			if(document.getElementById('p_pincode').value=="")
			{
				alert("Please Enter the Pincode.");
				document.getElementById('p_pincode').focus();
				return false;
			}
			if(document.getElementById('p_pincode').value.length!=6)
			{
				alert("Please check the Pincode. It should 6 character.");
				document.getElementById('p_pincode').focus();
				return false;
			}
			
			//Specialization Validation
			if(document.getElementById('p_spec').value=="")
			{
				alert("Please Enter the Specialization.");
				document.getElementById('p_spec').focus();
				return false;
			}
			if(document.getElementById('p_spec').value.length>25)
			{
				alert("Please check the Specialization. It should not exceed above 25 character.");
				document.getElementById('p_spec').focus();
				return false;
			}
			
			//Language Validation
			var chks = document.getElementsByName('lang[]');
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
				alert("Please Select a Language.");    
				return false;
			}  
			
			//Pooja Type Validation
			// var chks = document.getElementsByName('pooja_id[]');
			// var hasChecked = false;
			// for (var i = 0; i < chks.length; i++)
			// {
			// if (chks[i].checked)
			// {       
			// hasChecked = true;     
			// break;      
			// }
			// }
			// if (hasChecked == false)
			// {    
			// alert("Please Select a Pooja Type.");    
			// return false;
			// }
		}
		
		//Numbers Only Validation
		function numbersOnly(e)
		{
			var unicode=e.charCode? e.charCode : e.keyCode;
			if (unicode!=8)
			{ //if the key isn't the backspace key (which we should allow)
				if (unicode<48||unicode>57) //if not a number
				return false; //disable key press
			}
		}
		
		//Alphabets Only Validation
		function alphabetsOnly(e)
		{
			var unicode=e.charCode? e.charCode : e.keyCode;
			if (unicode!=8 && unicode!=32)
			{ //if the key isn't the backspace key (which we should allow)
				if (unicode<65||unicode>90 && unicode<97||unicode>122) //if not a number
				return false; //disable key press
			}
		}
		
		
		//Images Only Validation
		function imagesOnly()
		{
			var fileName = document.getElementById('p_image').value;
			var ext = fileName.substring(fileName.lastIndexOf('.') + 1);    
			if(ext != "JPEG" && ext != "jpeg" && ext != "jpg")
			{
				alert("Upload JPEG Images only");    
				return false;
			}
		}
		<!-- Modified By Bala -->
		
	</script>
</html>
