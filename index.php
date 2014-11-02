<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search your Video</title>
<link id="main_stylesheet" rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" src="js/getCookie.js"></script> 
<script type="text/javascript" src="js/openWindows.js"></script> 

</head>
<body>
<!--this is the main container, all the context is in this container-->
<div class="container" >
	<div class="header" align="center">
  	<!--set the title of the webiste-->
 		 <h1 class="header">Searching your videos</h1>       	
    </div>
    
    <!--declare a content block -->
	<div class="content" >
          	<!--a reminder of the login status-->
			<div align="center" id="tag">Welcome back!!!!! &nbsp&nbsp 
			<script>document.write( getCookie("E_mail"));</script>
  			  : <script>document.write( getCookie("role"));</script></span> </div>
              
    		<!--instantiate a login button-->
			<div class="button_login" id="not_login">
            <!--the button type is submit ,the labels of the button are 'Login' and 'New'-->
			<button class="submit" onClick="login()">Login</button>
            <button class="submit"  onClick="register()">New</button>
            </div>
            <br>
			
            <!--set a link to jump to the  upload page-->
          <span id="upload" class="link" > <a class="Upload" href="upload.php">
            <p>Upload your File</p> </a></span>
            <!--instantiate a logout button-->
			<div class="button_login1" id="has_login">
			<button class="submit"  onClick="logout()">Logout
			</button>

			</div>
            
             <!--check the status of the log ,if has login the not_login button will be hidden ,if not the has_login button will be hidden-->
			<script>
			if(a!=null)
            	{document.getElementById("not_login").style.display="none";
				 if(getCookie("role")!=2)
					 {
					document.getElementById("upload").style.display="none";
					 }
				}
            else
				 {
					 document.getElementById("upload").style.display="none";
					 document.getElementById("has_login").style.display="none";
					 document.getElementById("tag").style.display="none";
					
				 }
            </script>
            
			<br>
            <!--set a search box  and a search button-->
			<div class="searchbox" align="center">
 <br>
   <iframe src="SearchBox.php" name="iframe_search" frameborder="0" width="100%" height="400px" align="center"></iframe>         
            
	</div>  
</div>
 <!--set a search box  and a search button-->
    <div class="footer" >Copy right 2013-2014.
    </div>
    <div><a href="http://localhost/phpmyadmin/index.php?db=&table=&server=1&target=&token=9e2f38a0f2c80d71d1fb2dc727e96197#PMAURL-0:index.php?db=&table=&server=1&target=&token=9e2f38a0f2c80d71d1fb2dc727e96197"><p> <br>Admin login</p></a></div>
</body>
</html>