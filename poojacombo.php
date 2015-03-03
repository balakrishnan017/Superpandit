<!-- Load Pooja in Combo Box according to location Selected -->
<?php require_once("admin/functions/dbcon.php"); 
if(isset($_GET['city_name'])) {
	$city_name=$_GET['city_name'];
	$sql ="select po.p_name,po.p_id from tbl_pooja as po where po.p_id in( select pp.p_id
	from tbl_pandit_pooja as pp where pp.pd_id in (select p_id from tbl_pandit
	where p_city_name='$city_name'))"; 
	//echo $sql;
	$pooja_combo="<select name='p_id' class='listmenu-main'><option value='' Selected>Select Pooja</option>";
	$res=mysql_query($sql);
	while ($data=mysql_fetch_assoc($res)) {
		$pooja_combo.="<option value='".$data['p_id']."'>".$data['p_name']."</option>";
	}
	$pooja_combo.="</select>";
	echo $pooja_combo;
} ?>
