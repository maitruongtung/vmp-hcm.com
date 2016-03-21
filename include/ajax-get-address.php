<?php
include_once('../connect/connect.php');

if(isset($_REQUEST['act']))
{
	if($_REQUEST['act'] == 'loadDistrictAjax')
	{
		$id = intval($_REQUEST['id']);
		$sql_district = "select * from district where cityId='".$id."' ORDER BY districtName";
		$sql_district = mysql_query($sql_district);
		$district_html = "<option value=''>Chọn</option>";
		while($district = mysql_fetch_assoc($sql_district))
		{
			$district_html .= <<<eof
			<option value="{$district['districtId']}">{$district['districtName']}</option>
eof;
		}
		echo $district_html; exit;
	}

	if($_REQUEST['act'] == 'loadTownAjax')
	{
		$id = intval($_REQUEST['id']);
		$sql_town = "select * from town where districtId='".$id."' ORDER BY townName";
		$sql_town = mysql_query($sql_town);
		$town_html = "<option value=''>Chọn</option>";
		while($town = mysql_fetch_assoc($sql_town))
		{
			$town_html .= <<<eof
			<option value="{$town['townId']}">{$town['townName']}</option>
eof;
		}

		echo $town_html; exit;
	}

	if($_REQUEST['act'] == 'loadStreetAjax')
	{
		$id = intval($_REQUEST['id']);
		$sql_street = "select * from street where townId='".$id."' ORDER BY streetName";
		$sql_street = mysql_query($sql_street);
		$street_html = "<option value=''>Chọn</option>";
		while($street = mysql_fetch_assoc($sql_street))
		{
			$street_html .= <<<eof
			<option value="{$street['streetId']}">{$street['streetName']}</option>
eof;
		}

		echo $street_html; exit;
	}
}
?>