<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CommentList</title>
</head>

<body>
<?php 
include ("../conn.php");
?>
<?php 
$VID=$_GET["ID"];
$array = fetchComments($VID);

for($i=count($array)-1;$i>=0;$i--)
{
	echo "<div style=\"top:".(($array[$i][2]*50)+10)."px; left:10px;height:40px;width:550px;margin:1em;border:gray solid 1px;\"> ".$array[$i][4]." ".$array[$i][3]." &nbsp &nbsp (".$array[$i][6].") &nbsp comments:<br>".$array[$i][0]."</div>";
	echo "**********************************************************************";
}

?>
</body>
</html>