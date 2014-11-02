<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register New Account</title>
<link id="main_stylesheet" rel="stylesheet" href="css/style.css" type="text/css" />

</head>
<body>


<?php 
include("conn.php");// call the connect file .
//define variables and set to default values
$Fname =$Lname =  $password = $reconfirm= $email = $roles = "";
$nameERR = $passwordERR = $reconfirmERR =$rolesERR = $emailERR ="";
//some tags to record the variability  of the values
$isValid[0]=false;
$isValid[1]=false;
$isValid[2]=false;
$isValid[3]=false;
$isValid[4]=false;
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(empty($_POST["Fname"])||empty($_POST["Lname"]))
	{$nameERR ="last name and first name is required";}
	
		 else
		{
			$Fname = test_input($_POST["Fname"]);
			$Lname = test_input($_POST["Lname"]);
			$isValid[0]=true;
		}
	if(empty($_POST["password"]))
	{$passwordERR ="Password is required";}
	else
	{$password = test_input($_POST["password"]);$isValid[1]=true;}
	if(empty($_POST["reconfirm"]))
	{$reconfirmERR = "Password refirm is required";}
	else if($_POST["reconfirm"]!==$_POST["password"])
	{$reconfirmERR = "Password reconfirm should be the same";}
	else 
	{$reconfirm = test_input($_POST["reconfirm"]);$isValid[2]=true;}
	if(empty($_POST["email"]))
	{$emailERR="email is required";}
	else	
	{$email = test_input($_POST["email"]);$isValid[3]=true;}
	if(empty($_POST["roles"]))
	{$rolesERR = "role chooice is required";}
	else
	{$roles = test_input($_POST["roles"]);$isValid[4]=true;}
		
}
//the function to encrypt the content and fliter some special symbols avoiding the illeagel registerion
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<h2> Register</h2>
<p class="error">* is required</p>
<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Last Name :<input type="text" name="Lname" value="<?php echo $Lname;?>"> <span style="color:red">*</span>
<br>
Fisrt Name :<input type="text" name="Fname" value="<?php echo $Fname;?>">
<span class="error">*<?php echo $nameERR?></span>
<br><br>
Password:<input type="password" name="password"><span class="error">*<?php echo $passwordERR?></span>
<br><br>
Reconfirm:<input type="password" name="reconfirm"><span class="error">*<?php 
if($reconfirm =="")
echo $reconfirmERR;
else if($reconfirm !=$password)
echo $reconfirmERR= "not the same";
?></span>
<br><br>
Email:<input type="email" name="email" value="<?php echo $email;?>"><span class="error">*<?php echo $emailERR?></span>
<br><br>
roles:<input type="radio" name="roles" <?php if (isset($roles) && $roles=="Uploader") echo "checked";?>value="Uploader">Uploader
<input type="radio" name="roles"<?php if (isset($roles) && $roles=="Register Viewer") echo "checked";?> value = "Register Viewer">Register Viewer<span class="error">*<?php echo $rolesERR?></span>
<br><br>
<input type="submit" class="submit" name="submit" value="submit">
</form>



<?php 

if($isValid[0]&&$isValid[1]&&$isValid[2]&&$isValid[3]&&$isValid[4])
{
echo "<h2> Your Input</h2>";
echo "<br>";
echo $Fname.",".$Lname;
echo "<br>";
echo $email;
echo "<br>";
echo $roles;
echo "<br>";
}
?>
<?php
	  if($isValid[0]&&$isValid[1]&&$isValid[2]&&$isValid[3]&&$isValid[4])
	 { 
		if($roles =="Uploader"&&substr($email,-4)!=".edu")
		{echo"<h2>ERROR</h2>";echo "<h3>an edu email is needed if you choose uploader</h3>";}
		else{
				if($roles=="Uploader")
					$role_1=true;
				else
					$role_1=false;
				 $to_DB = newUser($Fname,$Lname,$email,$password,$role_1);
				 if($to_DB==0)
				 echo "<h2>Succeed</h2>";
				 else
				 echo "<h2>Error</h2>";
			}	
	}		
?> 

</body>
</html>
</body>
</html>