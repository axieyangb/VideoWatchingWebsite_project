<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php
include("conn.php");// call the connect file .
$E_mail = $password="";
$E_mailERR = $passwordERR="";
$isValid[0]=$isValid[1]=false;
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(empty($_POST["E_mail"]))
	{$E_mailERR ="Email is required";}
	else
	{$E_mail = test_input($_POST["E_mail"]);$isValid[0]=true;}
	
	}
	
	if(empty($_POST["password"]))
	{$passwordERR ="Password is required";}
	else
	{$password = test_input($_POST["password"]);$isValid[1]=true;}
	
	
	
	function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if(!($E_mailERR==""&&$passwordERR==""))
{
echo $E_mailERR;
echo "<br>";
echo $passwordERR;
header("Refresh:2;url=login.php");
}
?>


<?php

if($isValid[0]&&$isValid[1])
{
	$to_login = logIn($E_mail, $password);
	echo $to_login;
	if($to_login==1)
		{echo "The E_mail Address or password is invalid!<br>please try again!";}
	else
		{ echo "WELCOME BACK ! ";}
}
?>
</body>
</html>