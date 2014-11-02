<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload</title>
<script type="text/javascript" src="js/getCookie.js"></script> 
<script type="text/javascript" src="js/date.js"></script>
<link id="main_stylesheet" rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
<div id="upload" style="margin-left:1em;margin-top:0.5em">
<div style="font-style:oblique;font-size:40px">Welcome&nbsp&nbsp
<script>document.write(getCookie("role"));</script>:&nbsp&nbsp&nbsp&nbsp
<script>document.write(getCookie("E_mail"));</script>
</div>
<form action="upload_file.php" method="post"
enctype="multipart/form-data">
<h3>Upload your Video</h3>
<label for="title">Name of your video:</label><br>
<input type="text" name="title" id ="Title"><br><br>
Authors' names:<br>
first author:&nbsp&nbsp&nbsp&nbsp <input type="text" name="author1" id ="title"><br>
second author:<input type="text" name="author2" id ="title"><br>
third author:&nbsp&nbsp&nbsp <input type="text" name="author3" id ="title"><br><br>
<label for="description">Abstruct:</label><br>
<textarea name="description" rows="10" cols="60">
please add some basic description .
</textarea><br><br>
Keywords of this video<br>
<input type="text" name="tag1" id ="tag1">
<input type="text" name="tag2" id ="tag2">
<input type="text" name="tag3" id ="tag3">
<input type="text" name="tag4" id ="tag4">
<input type="text" name="tag5" id ="tag5">
<br><br>
Publish date<br>
<input type="text" name="publishDate" value="yyyy-mm-dd"/>
<br><br>
Paper Article:<input type="text" name="Article" value=""/>
<br><br>
Journal Name:<input type="text" name="Journal" value=""/>
<br><br>
<label for="file">Video picture:</label>
<input type="file" name="file" id="file">only .jpg,.jpeg is allowed<br><br>
<label for="file">Video:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </label>
<input type="file" name="video" id="video">only .ogg,.mp4 is allowed<br><br>
<input type="submit" class="submit" name="submit" value="Submit">
</form>
</div>
<div id="error">
<h2>You Have no right to upload the file</h2>
</div>
<script>
if(getCookie("role")==2&&getCookie("role")!=null)
{document.getElementById("error").style.display="none";}
else
 {document.getElementById("upload").style.display="none";}</script>
</body>
</html>