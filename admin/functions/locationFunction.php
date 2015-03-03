<?php
	require_once("dbcon.php");
	
	if(isset($_REQUEST['del'])){
		extract($_REQUEST);
		
		$sql="delete from tbl_location where l_id=$del";
		$res=mysql_query($sql);
		if($res)
		{
			echo "<script>alert('Data deleted.');</script>";
		}
		else
		{
			echo "<script>alert('Try again.');</script>";
		}
	}

?>