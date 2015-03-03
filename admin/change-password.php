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
    <td align="left" valign="top"><h3>Change Password</h3></td>
  </tr>
</table></td>
      </tr>
      
      <tr>
        <td height="400" align="left" valign="middle"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="left" valign="top" class="login-bg"><form action="home.php" method="get"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="35" align="left" valign="top" class="login-con">New Password&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><input name="textfield5" id="n_pass" type="text" class="T-F" /></td>
              </tr>
              <tr>
                <td width="48%" height="35" align="left" valign="top" class="login-con">Confirm Password&nbsp;&nbsp;&nbsp;&nbsp; : </td>
                <td height="35" align="left" valign="middle"><input name="textfield5" id="c_pass" type="text" class="T-F" /></td>
              </tr>              
              <tr>
                <td height="35" align="left" valign="middle">&nbsp;</td>
                <td height="35" align="left" valign="middle"><label>
                  <input name="Login" type="submit" class="T-F-S" id="Login" value="Add" onclick="return validate();"/>
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
  //New Password Validation
  if(document.getElementById('n_pass').value=="")
  {
    alert("Please Enter the New Password.");
    document.getElementById('n_pass').focus();
    return false;
  }
  //Confirm Password Validation
  if(document.getElementById('c_pass').value=="" || document.getElementById('n_pass').value!=document.getElementById('c_pass').value  )
  {
    alert("Please Enter the New Password.");
    document.getElementById('c_pass').focus();
    return false;
  }
}
 <!-- Modified By Bala -->
</script>
</html>
