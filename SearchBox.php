<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link id="main_stylesheet" rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    <body>
    <div class="logo" align="center" >
    <img src="index/logo2.png"  width="150px" height="150px"/>
    </div>
        <div  class="INPUT">
        <form name="search" method="post" action="searchResult.php" class="font">
        Search for: <input type="text" name="find"/> in 
        <Select NAME="field" class="font" style="color:#336699;">
        <Option VALUE="Title" >Title</option>
        <Option VALUE="Authors" >Author</option>
        <Option VALUE="Keywords">Keyword</option>
        <Option VALUE="Journal">Journal</option>
        </Select>
        <input type="hidden" name="searching" value="yes" />
        <span class="submit"><input type="submit" class="font" name="search" value="Search" /></span>
        </form>
        </div>
        
		
		
        
    </body>
</html>    