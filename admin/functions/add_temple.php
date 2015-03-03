<?php
//connecting to database
require_once("dbcon.php");

//fetch data from POST back
extract($_POST);
$city1=mysql_real_escape_string($city1);
if($city1 != "")
{
	$sql="select * from tbl_location where l_city like '$city1'";
	$res=mysql_query($sql);
	$count=mysql_num_rows($res);
	if($count >=1)
		echo "exists";
	else
	{
		$sql="insert into tbl_location values('','$city1')";
		$res=mysql_query($sql);
		if($res){
			echo "success";
		}else{
			echo "wrong";
		}
	}
}
else
{
	echo "wrong";
}
?>