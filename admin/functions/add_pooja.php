<?php
/*session_start();

if(!isset($_SESSION['sess_user_id']) and !isset($_SESSION['sess_username']))
{
	header("location: Index.php");
}*/
//connecting to database
require_once("dbcon.php");
function file_extension($filename)
{
	$path_info = pathinfo($filename);
	return $path_info['extension'];
}
		
extract($_GET);

$name=mysql_real_escape_string($name);
$pooja_content=mysql_real_escape_string($pooja_content);
if( $name != "" and $pooja_content != "")
{
	$sql="select * from tbl_pooja where name like '$name'";
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	if($count == 0){
	
		$pooja_img=$_FILES['pooja_img']['name'];
		if($pooja_img!="")
		{
			$pooja_img='images/pooja-services/'.$name;
		}
		else
		{
			$pooja_img="";
		}
		move_uploaded_file($_FILES['pooja_img']['tmp_name'],'../'.$pooja_img);
		$sql="insert into tbl_pooja values('$name'.'$pooja_content','$pooja_img')";
		$res=mysql_query($sql);
		if($res){
			echo "success";
		}
		else
		{
			echo "error";
		}
	}
	else{
		echo "already exists.";
	}
}
else
{
	echo "error";
}

?>