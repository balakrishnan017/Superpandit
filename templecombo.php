<!-- Load Temple in Combo Box according to location Selected -->
<?php require_once("admin/functions/dbcon.php"); 
	if(isset($_GET['city_name'])) {
		$city_name=$_GET['city_name'];
		$sql ="SELECT t_name, t_id
		FROM tbl_temple
		WHERE city_name LIKE '$city_name'"; 
		//echo $sql;
		$temple_combo="<select name='t_id' id='t_id' class='listmenu-main'><option value='' Selected>Select Temple</option>";
		$res=mysql_query($sql);
		while ($data=mysql_fetch_assoc($res)) {
			$temple_combo.="<option value='".$data['t_id']."'>".$data['t_name']."</option>";
		}
		$temple_combo.="</select>";
		echo $temple_combo;
	} ?>
		