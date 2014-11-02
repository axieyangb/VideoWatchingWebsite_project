<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php $pos = "700px";
include ("conn.php");
?>
<?php echo "<div style=\"border:gray solid 1px; width:".$pos."; height:100px\"></div>"
?>
<?php 

$VID="1211241337";
$array = fetchComments($VID);
print_r($array);
for($i=0;$i<count($array);$i++)
{
	
	echo $i;
	echo "<div style=\"position:fixed; top:".(($array[$i][2]*50)+10)."px; left:10px;height:40px;width:200px;margin:1em;border:gray solid 1px;\"> ".$array[$i][4]." ".$array[$i][3]." &nbsp &nbsp comments:<br>".$array[$i][0]."</div>";
}

?>
<body>
</body>
</html>