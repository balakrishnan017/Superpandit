<?php
	session_start();

	if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
	{
		header("location: index.php");
	}

	//connecting to database
	require_once("functions/dbcon.php");
	if(isset($_POST['b_id']))
	{
		function file_extension($filename)
		{
			$path_info = pathinfo($filename);
			return $path_info['extension'];
		}
						
		//fetch data from POST back
		extract($_POST);
		$b_id=mysql_real_escape_string($b_id);
		$name=mysql_real_escape_string($name);
		$b_content=mysql_real_escape_string($blog_content);
		if($name != "")
		{
			$sql="select * from tbl_blog where b_name like '$name' and b_id != $b_id";
			$sql1="select * from tbl_blog where b_id = $b_id";
			$res=mysql_query($sql);
			$res1=mysql_query($sql1);
			$count=mysql_num_rows($res);
			if($count >=1)
				echo "<script>alert('Blog name already exists.');</script>";
			else
			{
				$data=mysql_fetch_array($res1);
				$blog_img=$_FILES['blog_img']['name'];
				if($blog_img!="")
				{
					unlink('../'.$data['b_image']);
					$blog_img='images/blog-services/'.$name.'.'.file_extension($blog_img);
					move_uploaded_file($_FILES['blog_img']['tmp_name'],'../'.$blog_img);
				}
				else
				{
					
					$blog_img=$data['b_image'];
					
				}
				$sql="update tbl_blog set b_name='$name', b_image='$blog_img', b_content='$b_content' where b_id=$b_id";
				
				$res=mysql_query($sql);
				if($res){
					echo "<script>alert('Data updated.');</script>";
					header("location: view-blog.php");	
				}else{
					echo "<script>alert('Please try again.');</script>";
				}
			}
		}
		else
		{
			echo "<script>alert('Please enter blog name.');</script>";
		}
	}
	if(isset($_GET['b_id'])){
		extract($_GET);
		$sql="select * from tbl_blog where b_id=$b_id";
		$res=mysql_query($sql);
		$data=mysql_fetch_array($res);
		$count=mysql_num_rows($res);
		if($count==0){
			header("location: view-blog.php");		
		}
	}else
	{
		header("location: view-blog.php");
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
    <td align="left" valign="top"><h2>Add Blog</h2></td>
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
                  <input name="name" id="name" type="text" value="<?php echo $data['b_name']; ?>" class="T-F" /><input type="hidden" name="b_id" id="b_id" value="<?php echo $data['b_id']; ?>"/>
                </label></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="middle" class="login-con">Image&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <input type="file" name="blog_img" id="blog_img" accept="image/jpeg" onchange="return imagesOnly();"/>
				  <br/>
				  <img src="<?php echo "../".$data['b_image']; ?>" width="163" height="81" />
                </label></td>
              </tr>
              
              <tr>
                <td height="35" align="left" valign="top" class="login-con">Content&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <textarea name="blog_content" id="blog_content" class="T-F-B2" id="blog_content"><?php echo $data['b_content']; ?></textarea>
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
		var blog_img = document.getElementById("blog_img");
		var blog_content = $("#blog_content").val();
		var formdata = false;
	
		if(name == '')
		{
			$("#warning").text("*Please enter blog name.");
			$("#name").focus();
			return false;
		}
		else if(blog_content == '')
		{
			$("#warning").text("*Please enter blog content.");
			$("#blog_content").focus();
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
    //blog Name Validation 
    if(document.getElementById('name').value=="")
    {
      alert("Please Enter the blog Name.");
      document.getElementById('name').focus();
      return false;
    }
    if(document.getElementById('name').value.length>50)
    {
      alert("Please check the blog Name. It should not exceed above 50 character.");
      document.getElementById('name').focus();
      return false;
    }
    //JPEG Image Validation
    var fileName = document.getElementById('blog_img').value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);    
    if(document.getElementById('blog_img').value!="" && (ext != "JPEG" && ext != "jpeg" && ext != "jpg"))
    {
      alert("Please Upload an JPEG image."); 
      document.getElementById('blog_img').focus();   
      return false;
    } 

  //Content Validation 
    if(document.getElementById('blog_content').value=="")
    {
      alert("Please Enter the blog Content.");
      document.getElementById('blog_content').focus();
      return false;
    }

  }

//Image Only Validation
  function imagesOnly()
  {
    var fileName = document.getElementById('blog_img').value;
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
