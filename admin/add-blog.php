<?php
session_start();

if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
{
  header("location: Index.php");
}

if(isset($_POST['add']))
{
  require_once("functions/dbcon.php");
  extract($_POST);
  $name=mysql_real_escape_string($name);
  $blog_content=mysql_real_escape_string($blog_content);
  
  function file_extension($filename)
  {
    $path_info = pathinfo($filename);
    return $path_info['extension'];
  }
  
  if( $name != "" and $blog_content != "")
  {
    $sql="select * from tbl_blog where b_name like '$name'";
    $res=mysql_query($sql);
    $count=mysql_num_rows($res);
    if($count == 0)
    {
      $blog_img=$_FILES['blog_img']['name'];
      if($blog_img!="")
      {
        $blog_img='images/blog-services/'.$name.'.'.file_extension($blog_img);
      }
      else
      {
        $blog_img="";
      }
      move_uploaded_file($_FILES['blog_img']['tmp_name'],'../'.$blog_img);
      $sql="insert into tbl_blog values('','$name','$blog_img','$blog_content',NOW())";
      //echo $sql;
      $res=mysql_query($sql);
      if($res){
        echo "<script>alert('success');</script>";
      }
      else
      {
        echo "<script>alert('error');</script>";
      }
    }
    else
    {
      echo "<script>alert('already exists.');</script>";
    }
  }
  else
  {
    echo "error";
  }
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
    <td align="left" valign="top"><h2>Add Blog</h2></td>
  </tr>
</table></td>
      </tr>      
      <tr>
        <td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" class="login-bg"><form method="post" enctype="multipart/form-data"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              
              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Name&nbsp;&nbsp; : </td>
                <td width="52%" height="35" align="left" valign="middle"><label>
                  <input name="name" id="name" type="text" class="T-F" />
                </label></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="middle" class="login-con">image&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <input type="file" name="blog_img" id="blog_img" onchange="return imagesOnly();" />
                </label></td>
              </tr>
              
              <tr>
                <td height="35" align="left" valign="top" class="login-con">content&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <textarea name="blog_content" id="blog_content"  class="T-F-B2"></textarea>
                </label></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="middle">&nbsp;</td>
                <td height="35" align="left" valign="middle"><label>
                  <input name="add" id="add" type="submit" class="T-F-S" value="Add" onclick="return validate();"/>
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

  /* Validation */
  function validate()
  {
    //blog Name Validation 
    if(document.getElementById('name').value=="")
    {
      alert("Please Enter the Blog Name.");
      document.getElementById('name').focus();
      return false;
    }
    if(document.getElementById('name').value.length>50)
    {
      alert("Please check the Blog Name. It should not exceed above 50 character.");
      document.getElementById('name').focus();
      return false;
    }


    //JPEG Image Validation
    var fileName = document.getElementById('blog_img').value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);    
    if(document.getElementById('blog_img').value=="" || (ext != "JPEG" && ext != "jpeg" && ext != "jpg"))
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
