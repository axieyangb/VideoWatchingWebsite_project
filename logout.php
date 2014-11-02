<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log out</title>
  <script type="text/javascript" src="js/getCookie.js"></script> 

</head>

<body>
<br>
<br>
<h2 style="margin-left:15px">Logout sucessful!!!</h2>
<?php 	setcookie('E_mail',"",time()+1);
  setcookie('role',"",time()+1);
  setcookie('userId',"",time()+1);
  setcookie('Fname',"",time()+1);
  setcookie('Lname',"",time()+1);
  echo "<script>opener.document.execCommand('Refresh'); </script>";
 
  ;?>
</body>
</html>