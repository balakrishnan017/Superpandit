<?php
	require_once("dbcon.php");
	
	if(isset($_REQUEST['del'])){
		extract($_REQUEST);
		$sql="select b_image from tbl_blog where b_id=$del";
		$res=mysql_query($sql);
		$data=mysql_fetch_array($res);
		unlink("../../".$data['b_image']);
		$sql="delete from tbl_blog where b_id=$del";
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