<?php
	require_once("dbcon.php");
	
	if(isset($_REQUEST['del'])){
		extract($_REQUEST);
		$sql="select p_image from tbl_book_pandit where bk_id=$del";
		$res=mysql_query($sql);
		$data=mysql_fetch_array($res);		
		$sql="delete from tbl_book_pandit where bk_id=$del";
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