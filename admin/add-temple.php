<?php
session_start();

if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
{
	header("location: Index.php");
} 


require_once("functions/dbcon.php");

$load_city="select * from tbl_location";
$res_city=mysql_query($load_city);

$load_pooja="select * from tbl_pooja";
$res_pooja=mysql_query($load_pooja);


if(isset($_POST['add'])){
	extract($_POST);
	$t_name=trim(mysql_real_escape_string($t_name));
	$city_id=trim(mysql_real_escape_string($city_id));
	$address=trim(mysql_real_escape_string($address));
	
function file_extension($filename)
  {
    $path_info = pathinfo($filename);
    return $path_info['extension'];
  }
  
  if( $t_name != "" and $address != "")
  {
    $sql="select * from tbl_temple where t_name like '$t_name'";
    $res=mysql_query($sql);
    $count=mysql_num_rows($res);    
    if($count == 0)
    {
      $t_image=$_FILES['t_image']['name'];
      if($t_image!="")
      {
        $t_image='images/temple_image/'.$t_name.'.'.file_extension($t_image);  
             
      }
      else
      {
        $t_image="";
      }
      move_uploaded_file($_FILES['t_image']['tmp_name'],'../'.$t_image);
      $sql="insert into tbl_temple values('','$t_name','$city_id','$address','$t_image')";
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
    <td align="left" valign="top"><h2>Add Temple</h2></td>
  </tr>
</table></td>
      </tr>
      
      <tr>
        <td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" class="login-bg">
			<form enctype="multipart/form-data" method="post" ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              
              <tr>
                <td width="48%" height="35" align="left" valign="middle" class="login-con">Name&nbsp;&nbsp; : </td>
                <td width="52%" height="35" align="left" valign="middle"><label>
                  <input name="t_name" id="t_name" type="text" class="T-F" />
                </label></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="top" class="login-con">City&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <select name="city_id" class="T-F-L" id="city_id">
				  <?php while($data_city=mysql_fetch_array($res_city)){ ?>
                    <option value="<?php echo $data_city['l_city']; ?>"><?php echo $data_city['l_city']; ?></option>
					<?php } ?>
                  </select>
                </label></td>
              </tr>
              <tr>
                <td height="35" align="left" valign="top" class="login-con">Address&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <textarea name="address" id="address" class="T-F-B2"></textarea>
                </label></td>
              </tr>
              
              
              <tr>
                <td height="35" align="left" valign="middle" class="login-con">Types of Puja&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><div style="margin:8px 0 5px 0px;">
				<?php while($data_pooja=mysql_fetch_array($res_pooja)){ ?>
                    <label>
                  <input type="checkbox" name="pooja_id[]" id="<?php echo $data_pooja['p_id']; ?>" class="check-size" value="<?php echo $data_pooja['p_id']; ?>" />
  &nbsp;&nbsp;<?php echo $data_pooja['p_name']; ?></label>
 
  				<?php } ?>
                </div></td>
              </tr>
              
              <tr>
                <td height="35" align="left" valign="middle" class="login-con">Image&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><label>
                  <input type="file" name="t_image" id="t_image" accept="image/jpeg" onchange="return imagesOnly();"/>
                </label></td>
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

    //JPEG Image Validation
  var fileName = document.getElementById('t_image').value;
  var ext = fileName.substring(fileName.lastIndexOf('.') + 1);    
  if(document.getElementById('t_image').value=="" || (ext != "JPEG" && ext != "jpeg" && ext != "jpg"))
  {
    alert("Please Upload an JPEG image."); 
    document.getElementById('t_image').focus();   
    return false;
  }

    //Image Only Validation
  function imagesOnly()
  {
    var fileName = document.getElementById('t_image').value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);    
    if(ext != "JPEG" && ext != "jpeg" && ext != "jpg")
    {
      alert("Upload JPEG Images only");      
      return false;
    } 
  }
  }
  <!-- Modified By Bala -->

</script>
</html>
