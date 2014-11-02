<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link id="main_stylesheet" rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>

<!--establish a login form -->
<form action="vertify.php" class="login" method="post">
    E_mail Address:<input type="text" name="E_mail" value=""><span class="error"></span><br>
    <br>
    Password:<input type="password" name="password" value=""><span class="error">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
    <input type="submit" class="submit" value="Submit" >
</form>
<br>
</body>
</html>