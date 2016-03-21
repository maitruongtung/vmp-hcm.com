<br />
<div class="info">
 <br />
    <font size="+2" color="#333333">Kết quả tìm được !</font>
    <br /> 

<?php
include('../connect/connect.php');
$tensach = $_REQUEST['tensach'];
$strSQL = "select * from sach where tensach LIKE '%$tensach%'";
//echo $strSQL;
$result = mysql_query($strSQL);

echo '<table border="1" cellpadding="0" cellspacing="0" width="658px">';

echo '<tr><th style="width:70px; height:60px;">Ma Sach</font></th><th style="width:300px;">Ten Sach</th><th style="width:90px;">Gia</th><th style="width:70px;">Hinh</th></tr>';

while($row = mysql_fetch_assoc($result))
{
	$m =$row['masach'];
	
	echo "<tr>";
	echo '<td style="width:70px;">';
	echo"<font size='+1' color='#666666'>";
	echo $row['masach'];
	echo"</font>";
	echo '</td><td style="width:300px;">';
	echo"<a href='?action=chitiet&masach=$m' >";
	echo"<font size='3' color='#003399'>";
	echo $row['tensach'];
	echo"</font>";
	echo"</a>";
	echo '</td><td style="width:90px;">';
	echo"<font size='+1' color='#666666'>";
	echo $row['gia'];
	echo" vnđ";
	echo"</font>";
	echo '</td><td style="width:70px;">';
	echo"<a href='?action=chitiet&masach=$m'>";
	echo "<img src='images/".$row['hinh']."' width='120px;' height='200px;'/>";
	echo"</a>";
	echo '</td>';
	echo '</tr>'; 
		
}
echo '</table>';

?>
 
    </div>