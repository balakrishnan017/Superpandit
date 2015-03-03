<?php
//session_start();
require_once("admin/functions/dbcon.php");

/*if(isset($_SESSION))
{
  $email_id=$_SESSION['sess_username'];
  $uid=$_SESSION['sess_user_id'];
*/
//User id need to be taken from session id
  $sql_user="select f_name, mobile, email_id, address from tbl_users where u_id=1";
  $res_user=mysql_query($sql_user);
  $data_user=mysql_fetch_array($res_user);

  $sql_pandit="select p_name from tbl_pandit where p_id=".$_GET['p_id'];
  $res_pandit=mysql_query($sql_pandit);
  $data_pandit=mysql_fetch_array($res_pandit);

  
  $sql_pooja="select tp.p_name, tp.p_id from tbl_pooja tp where tp.p_id in (select tpp.p_id from tbl_pandit_pooja tpp where tpp.pd_id=".$_GET['p_id'].")";
  $res_pooja=mysql_query($sql_pooja);
  $data_pooja="";
   $pooja_name="";

  if(isset($_POST['add']))
  {
    
    extract($_POST);
    $name=mysql_real_escape_string($name);
    $email=mysql_real_escape_string($email);
    $mobile=mysql_real_escape_string($mobile);
    $address=mysql_real_escape_string($address);
    //Pooja Id in array
    $escaped_values = array_map('mysql_real_escape_string', array_values($pooja_id));
    $values  = implode(", ", $escaped_values);   

    $p_name=mysql_real_escape_string($p_name);
    $occasion=mysql_real_escape_string($occasion);
    $dob=mysql_real_escape_string($dob);
    $comments=mysql_real_escape_string($comments);      
  
  //Mail to the user
    $sql_insert="insert into tbl_book_pandit values('','$name','$email','$mobile','$address','$values','$p_name','$occasion','$dob','$comments')";

    $res_insert=mysql_query($sql_insert);
        
    $email_admin="balakrishnan017@gmail.com"; 

    $to=$email.",".$email_admin;
    $subject="Email verification";   
    //$email=base64_encode($email);
    //$code=base64_encode($code);
    $body="Hi,
    The pooja details are as follows:
    Name: $name
    Mobile Number: $mobile
    Address: $address
    Type of Pooja: pooja_id
    Occasion: $occasion
    Date of Pooja: $d
    Comments: $comments ";

    $headers = "From: balakrishnan017@gmail.com";
    if(mail($to,$subject,$body,$headers))
    {
     echo "<script> alert('Pooja details has been sent to your email-id.'); </script>";

   }

   else
   {
    echo "<script> alert('Email has already been sent.'); </script>"; 
    return false;
  }
  
  if($res_insert)
    {     
      echo "<script> alert('Data Inserted'); </script>"; 
      header("location: index.php");
    }

}
 //}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Superpandit Pvt Ltd</title>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/mothere.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>

  $(function() {
    $( "#dob" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd-mm-yy",
      minDate=0
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
  <div id="main-wrap">
    <?php include ('header.php'); ?>
    <div class="main-body-content">
      <form enctype="multipart/form-data" method="post">
        <div class="book-pan-bg">
          <h5>book a pandit</h5>
          <div class="book-field-bg">Name<input name="name" id="name" type="text" class="book-field" maxlength="100" value="<?php echo $data_user['f_name']; ?>" readonly/></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Email ID<input name="email" id="email" type="email" class="book-field" maxlength="100" value="<?php echo $data_user['email_id']; ?>" readonly/></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Phone Number<input name="mobile" id="mobile" type="text" onkeypress="return numbersOnly(event);" class="book-field" maxlength="10" value="<?php echo $data_user['mobile']; ?>"/></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Address<input name="address" id="address" type="text" maxlength="500" class="book-field" value="<?php echo $data_user['address']; ?>" /></div>
          <div class="cB2"></div>
          <div class="book-field-bg">Type<div style="margin:8px 0 5px 0px;"><label></label>
            <?php while($data_pooja=mysql_fetch_array($res_pooja)){ ?>
            <label>
              <input type="checkbox" name="pooja_id[]" id="pooja_id[]" class="check-size" value="<?php echo $data_pooja['p_name']; ?>" />
              &nbsp;&nbsp;<?php echo $data_pooja['p_name']; ?></label>

              <?php } ?>
            </div></div>
            <div class="cB2"></div>
            <div class="book-field-bg">Pandit Name<input name="p_name" id="p_name" type="text" class="book-field" maxlength="100" value="<?php echo $data_pandit['p_name']; ?>" readonly/></div>
          <div class="cB2"></div>
            <div class="book-field-bg">Occasion<input name="occasion" id="occasion" class="book-field maxlength="100" " /></div>
            <div class="cB2"></div>
            <div class="book-field-bg">Pooja Date & Time<input name="dob" id="dob" type="text" class="book-field" /></div>
            <div class="cB2"></div>
            <div class="book-field-bg">Comments<input name="comments" id="comments" type="text" class="book-field maxlength="500" " /></div>
            <div class="cB2"></div>
            <input type="submit"  value="add" name="add" class="btn" onclick="this.style.border='1px solid #7cb61d';return validate();" onblur="this.style.border='1px solid #1585b7';"/>
            <div class="cB2"></div>


          </div>
          <div class="cB"></div>
        </form>
      </div>
      <div class="cB1"></div>
      <?php include ('footer.php'); ?>
      <div class="cB"></div>
    </div>
  </body>
  <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17311249-38']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();


  function validate() 
  {
    //Mobile Lenght Validation
    var phoneno = /^\d{10}$/;
    if(!document.getElementById('mobile').value.match(phoneno))
    {
      alert("Please Enter a valid Mobile Number");
      document.getElementById('mobile').focus();
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

      //Occasion Validation
      if(document.getElementById('occasion').value=="")
      {
        alert("Please Enter the Occasion.");
        document.getElementById('occasion').focus();
        return false;
      }
      if(document.getElementById('occasion').value.length>100)
      {
        alert("Please check the Occasion. It should not exceed above 100 character.");
        document.getElementById('occasion').focus();
        return false;
      }

      //DOP Validation
      if(document.getElementById('dob').value=="")
      {
        alert("Please Enter the Date of Pooja.");
        document.getElementById('dob').focus();
        return false;
      }

      //Comments Validation
      if(document.getElementById('comments').value=="")
      {
        alert("Please Enter the Comments.");
        document.getElementById('comments').focus();
        return false;
      }
      if(document.getElementById('comments').value.length>100)
      {
        alert("Please check the Comments. It should not exceed above 100 character.");
        document.getElementById('comments').focus();
        return false;
      }

    }

    function numbersOnly(e)
    {
      var unicode=e.charCode? e.charCode : e.keyCode;
      if (unicode!=8)
      { //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57) //if not a number
        return false; //disable key press
    }
  }

  </script>
  </html>