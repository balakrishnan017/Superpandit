<?php 
/*session_start();

if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
{
  header("location: index.php");
}*/
require_once("admin/functions/dbcon.php");

if(isset($_POST['signup']))  
{   
  extract($_POST);  
  $f_name=mysql_real_escape_string($f_name);
  $l_name=mysql_real_escape_string($l_name);
  $mobile=mysql_real_escape_string($mobile);  
  $email_id=mysql_real_escape_string($email_id);
  $address=mysql_real_escape_string($address);
  $pass=mysql_real_escape_string($pass);
  $c_pass=mysql_real_escape_string($c_pass);
  $code=rand(100000,999999);

  
  $count=mysql_query("select tu_id from tbl_temp_users where email_id='$email_id'");

  if(mysql_num_rows($count) < 1)
  {
    $sql_insert="insert into tbl_temp_users values('','$f_name','$l_name',$mobile,'$email_id','$address','$pass', $code)";
    $res_insert=mysql_query($sql_insert);
    //echo $sql_insert; 
// sending email

    $to=$email_id;
    $subject="Email verification";
    // $body='<html><body>Hi, <br> We need to make sure you are human. Please verify your email and get started using your Website account. <br>';
    // $body.= '<a href="http://cwebsitedesigning.com/clients/superpandit/verification.php?code='.$code.'&email_id='.$email_id.'"';
    // $body.='target="_blank">Click Here</a></body></html>';
	$email_id=base64_encode($email_id);
	$code=base64_encode($code);
$body="Hi,
  We need to make sure you are human. Please verify your email and get started using your Website account. Click the below link. http://cwebsitedesigning.com/clients/superpandit/verification.php?code1=$code&code2=$email_id ";
 

    $headers = "From: balakrishnan017@gmail.com";
    if(mail($to,$subject,$body,$headers)){
     echo "<script> alert('Verification Email has been sent to your Email-id. Please verify to log-in.'); </script>";
    }
  }
  else
  {
    echo "<script> alert('Email has already been taken.'); </script>"; 
    return false;
  }

}
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
      <div class="book-pan-bg">
        <h5>sign up</h5>
        <form  method="post">
          <div class="book-field-bg">First Name<input name="f_name" id="f_name" type="text" required class="book-field" onkeypress="return alphabetsOnly(event);" /></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Last Name<input name="l_name" id="l_name" type="text" required class="book-field" onkeypress="return alphabetsOnly(event);"/></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Mobile<input name="mobile" id="mobile" type="text" required class="book-field" onkeypress="return numbersOnly(event);"/></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Email ID<input name="email_id" id="email_id" type="email" required class="book-field" /></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Address<textarea name="address" id="address" type="text" required class="book-field"></textarea></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Password<input name="pass" id="pass" type="password" required class="book-field"/></div>
          <div class="cB2"></div> 
          <div class="book-field-bg">Confirm Password<input name="c_pass" id="c_pass" required type="password" class="book-field" /></div>
          <div class="cB2"></div>

          <input type="submit" name="signup" id="signup" value="Sign up"  class="btn" onclick="this.style.border='1px solid #7cb61d'; return validate();" onblur="this.style.border='1px solid #1585b7';"/>
          <div class="cB2"></div>

        </form>
      </div>
      <div class="cB"></div>
    </div>
    <div class="cB1"></div>
    <?php include ('footer.php'); ?>
    <div class="cB"></div>
  </div>
</body>
<script>

function validate() 
{    
  //Name Validation
  if(document.getElementById('f_name').value=="")
  {
    alert("Please Enter the First Name.");
    document.getElementById('f_name').focus();
    return false;
  }
  if(document.getElementById('f_name').value.length>20)
  {
    alert("Please check the First Name. It should not exceed above 100 character.");
    document.getElementById('f_name').focus();
    return false;
  }
  if(document.getElementById('l_name').value=="")
  {
    alert("Please Enter the Last Name.");
    document.getElementById('l_name').focus();
    return false;
  }
  if(document.getElementById('l_name').value.length>20)
  {
    alert("Please check the Last Name. It should not exceed above 100 character.");
    document.getElementById('l_name').focus();
    return false;
  }
  //Mobile Lenght Validation
  var phoneno = /^\d{10}$/;
  if(!document.getElementById('mobile').value.match(phoneno))
  {
    alert("Please Enter a valid Mobile Number");
    document.getElementById('mobile').focus();
    return false;
  }

  
  //EmailId Validation
  if(document.getElementById('email_id').value=="")
  {
    alert("Please Enter the Email-id.");
    document.getElementById('email_id').focus();
    return false;
  } 
  if(document.getElementById('email_id').value.length>50)
  {
    alert("Please check the Email-id. It should not exceed above 50 character.");
    document.getElementById('email_id').focus();
    return false;
  }
  
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
  if(!(document.getElementById('email_id').value.match(mailformat)))  
  {  
    alert("Please Enter a valid Email id.")
    document.getElementById('email_id').focus();  
    return false;  
  }
  //Address Validation
  if(document.getElementById('address').value=="")
  {
    alert("Please Enter the Address.");
    document.getElementById('address').focus();
    return false;
  }
  if(document.getElementById('address').value.length>500)
  {
    alert("Please check the Address. It should not exceed above 500 character.");
    document.getElementById('address').focus();
    return false;
  }
  //Password Validation
  if(document.getElementById('pass').value=="")
  {
    alert("Please Enter the Password.");
    document.getElementById('pass').focus();
    return false;
  }
  if(document.getElementById('pass').value.length<6 && document.getElementById('pass').value.length>10)
  {
    alert("Please check the Password. It should be 6-10 character long.");
    document.getElementById('pass').focus();
    return false;
  }
  //Confirm Password Validation
  if(document.getElementById('c_pass').value=="")
  {
    alert("Please Enter the Password.");
    document.getElementById('c_pass').focus();
    return false;
  }
  if(document.getElementById('c_pass').value != document.getElementById('pass').value)
  {
    alert("Mismatch of Password");
    document.getElementById('c_pass').focus();
    return false;
  }
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
</script>
</html>
