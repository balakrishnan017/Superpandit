<?php
	session_start();

	if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
	{
		header("location: index.php");
	}

	//connecting to database
	require_once("functions/dbcon.php");
	if(isset($_POST['p_id']))
	{
		function file_extension($filename)
		{
			$path_info = pathinfo($filename);
			return $path_info['extension'];
		}
						
		//fetch data from POST back
		extract($_POST);
		$p_id=mysql_real_escape_string($p_id);
		$name=mysql_real_escape_string($name);
		$p_content=mysql_real_escape_string($pooja_content);
		if($name != "")
		{
			$sql="select * from tbl_pooja where p_name like '$name' and p_id != $p_id";
			$sql1="select * from tbl_pooja where p_id = $p_id";
			$res=mysql_query($sql);
			$res1=mysql_query($sql1);
			$count=mysql_num_rows($res);
			if($count >=1)
				echo "<script>alert('Pooja name already exists.');</script>";
			else
			{
				$data=mysql_fetch_array($res1);
				$pooja_img=$_FILES['pooja_img']['name'];
				if($pooja_img!="")
				{
					unlink('../'.$data['p_image']);
					$pooja_img='images/pooja-services/'.$name.'.'.file_extension($pooja_img);
					move_uploaded_file($_FILES['pooja_img']['tmp_name'],'../'.$pooja_img);
				}
				else
				{
					
					$pooja_img=$data['p_image'];
					
				}
				$sql="update tbl_pooja set p_name='$name', p_image='$pooja_img', p_content='$p_content', p_price=$pooja_price where p_id=$p_id";
				
				$res=mysql_query($sql);
				if($res){
					echo "<script>alert('Data updated.');</script>";
					header("location: view-pooja.php");	
				}else{
					echo "<script>alert('Please try again.');</script>";
				}
			}
		}
		else
		{
			echo "<script>alert('Please enter pooja name.');</script>";
		}
	}
	if(isset($_GET['p_id'])){
		extract($_GET);
		$sql="select * from tbl_pooja where p_id=$p_id";
		$res=mysql_query($sql);
		$data=mysql_fetch_array($res);
		$count=mysql_num_rows($res);
		if($count==0){
			header("location: view-pooja.php");		
		}
	}else
	{
		header("location: view-pooja.php");
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
.style2 {color: #FF0000}
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
    <td align="left" valign="top"><h2>Add Pooja</h2></td>
  </tr>
</table></td>
      </tr>
      
      <tr>
        <td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" class="login-bg">
			<form enctype="multipart/form-data" method="post">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              
              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Name&nbsp;&nbsp; : </td>
                <td width="52%" height="35" align="left" valign="middle"><label>
                  <input name="name" id="name" type="text" value="<?php echo $data['p_name']; ?>" class="T-F" /><input type="hidden" name="p_id" id="p_id" value="<?php echo $data['p_id']; ?>"/>
                </label></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="middle" class="login-con">Image&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <input type="file" name="pooja_img" id="pooja_img" accept="image/jpeg" onchange="return imagesOnly();"/>
				  <br/>
				  <img src="<?php echo "../".$data['p_image']; ?>" width="163" height="81" />
                </label></td>
              </tr>
              
              <tr>
                <td height="35" align="left" valign="top" class="login-con">Content&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <textarea name="pooja_content" id="pooja_content" class="T-F-B2" id="pooja_content"><?php echo $data['p_content']; ?></textarea>
                </label></td>
              </tr>
			  <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Price&nbsp;&nbsp; : </td>
                <td width="52%" height="35" align="left" valign="middle"><label>
                  <input name="pooja_price" id="pooja_price" type="text" value="<?php echo $data['p_price']; ?>" class="T-F" /><input type="hidden" name="p_id" id="p_id" value="<?php echo $data['p_id']; ?>"/>
                </label></td>
              </tr>
			  <tr>
                <td height="35" align="left" valign="middle"></td>
                <td height="35" align="left" valign="middle"><div class="style2" id="warning"></div></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="middle">&nbsp;</td>
                <td height="35" align="left" valign="middle"><label>
                  <input name="add" type="submit" class="T-F-S" id="add" value="Add" onclick="return validate();"/>
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
<script src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

	$( 'form' ).submit(function ( e ) {
		var name = $("#name").val();
		var pooja_img = document.getElementById("pooja_img");
		var pooja_content = $("#pooja_content").val();
		var formdata = false;
	
		if(name == '')
		{
			$("#warning").text("*Please enter pooja name.");
			$("#name").focus();
			return false;
		}
		else if(pooja_content == '')
		{
			$("#warning").text("*Please enter pooja content.");
			$("#pooja_content").focus();
			return false;
		}
	});
			
});

</script>
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
    //Pooja Name Validation 
    if(document.getElementById('name').value=="")
    {
      alert("Please Enter the Pooja Name.");
      document.getElementById('name').focus();
      return false;
    }
    if(document.getElementById('name').value.length>50)
    {
      alert("Please check the Pooja Name. It should not exceed above 50 character.");
      document.getElementById('name').focus();
      return false;
    }
    //JPEG Image Validation
    var fileName = document.getElementById('pooja_img').value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);    
    if(document.getElementById('pooja_img').value!="" && (ext != "JPEG" && ext != "jpeg" && ext != "jpg"))
    {
      alert("Please Upload an JPEG image."); 
      document.getElementById('pooja_img').focus();   
      return false;
    } 

  //Content Validation 
    if(document.getElementById('pooja_content').value=="")
    {
      alert("Please Enter the Pooja Content.");
      document.getElementById('pooja_content').focus();
      return false;
    }

  }

//Image Only Validation
  function imagesOnly()
  {
    var fileName = document.getElementById('pooja_img').value;
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
