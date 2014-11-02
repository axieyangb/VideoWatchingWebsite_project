<!doctype html>
<html>
<head>
<title>Watching Video</title>

  <!-- Chang URLs to wherever Video.js files will be hosted -->
  <link href="video-js.css" rel="stylesheet" type="text/css">
  <!-- video.js must be in the <head> for older IEs to work. -->
  <script src="js/video.js"></script>

  <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->
  <script>
    videojs.options.flash.swf = "css/video-js.swf";
  </script>



</head>



<body>
<div align="center" style="font-size:17px">
<?php 
include("../conn.php");
 $VID= $_GET["ID"];
  $arr = videoInf($VID);
   echo "<div align=\"center\"><h2>".ucwords($arr[0][2])."</h2></div>";
?>
</div>

<div align="center" >
  <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="640" height="500"
      poster="../oceans-clip.png"
      data-setup="{}">
    <source src="../upload/<?php echo $_GET["ID"];?>.mp4" type='video/mp4' />
    <track kind="captions" src="css/demo.captions.vtt" srclang="en" label="English"></track><!-- Tracks need an ending tag thanks to IE9 -->
  </video>
</div>
  <?php 
  if(isset($_COOKIE["userId"])){
   echo  "  <div style=\" position:absolute;left:550px\" ><form name=\"rating\" method=\"post\" action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?ID=".$_GET["ID"]."\"  >
   Video Quality<Select name=\"quality\">
        <Option VALUE=\"0\">Please Select</option>
        <Option VALUE=\"1\">one</option>
        <Option VALUE=\"2\">two</option>
        <Option VALUE=\"3\">three</option>
        <Option VALUE=\"4\">four</option>
		<Option VALUE=\"5\">five</option></Select>
Video Contant <Select name=\"content\" >
        <Option VALUE=\"0\">Please Select</option>
		 <Option VALUE=\"1\">one</option>
        <Option VALUE=\"2\">two</option>
        <Option VALUE=\"3\">three</option>
        <Option VALUE=\"4\">four</option>
		<Option VALUE=\"5\">five</option> </Select>
		<input type=\"submit\" name=\"Send\" value=\"Send\" />
		</form>
       <br></div>";
  }
		echo "<br>";
		
		//display the rating score  and display the video description
  echo "<br><span style=\"font-style:oblique;margin-left:750px;\"> Content:".number_format("".(double)fetchRatings($_GET["ID"],"Star")."",1)." &nbsp point; &nbsp&nbsp Quality:".number_format("".(double)fetchRatings($_GET["ID"],"Beaker")."",1)." &nbsp point<br></span>
  
  <span style=\"margin-left:347px;\">Video Description</span><br>
  <div  style=\"border:gray solid 1px; width:47.9%; height:100%;margin-left:347px; margin-top:1em\">".$arr[0][8]."</div>";
 
 echo "<br><span style=\"margin-left:347px;\">Comment</span><br>";
  //display the comments list
  echo "<div style=\"border:gray solid 1px; height:300px; width:47.9%; margin-left:347px; margin-top:1em\">  <iframe src=\"comment	List.php?ID=".$_GET["ID"]."\" name=\"iframe_search\" frameborder=\"0\" width=\"100%\" height=\"100%\" scrolling=\"auto\"></iframe> </div>";
  
  
  
  
  
  
  
  
  
  
  if(isset($_COOKIE["Fname"]))
  {
  echo "<div align=\"center\" class=\"comment\"> 
Dear ".$_COOKIE["Fname"]." ".$_COOKIE["Lname"]."
<form action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?ID=".$_GET["ID"]."\" method=\"post\" name=\"myform\" onsubmit=\"return CheckPost();\">
  Content：<br><textarea name=\"commentText\"  cols=\"60\" rows=\"9\"></textarea><br/> 
 
  <input type=\"submit\" name=\"submit\" value=\"Comment\"/></form>
  </div>";
  }

  ?>


<?php 
// ----ACCEPT THE rating--
$VID = $arr[0][0];
if(isset($_COOKIE["userId"]))
{
	$UID=$_COOKIE["userId"];

 if(isset($_POST['content'])&&$_POST['content']!=0)
 { $Rating_1 = (int)($_POST['content']);
	$to_rateStar=starRating($UID,$VID,$Rating_1);
if(isset($_POST['quality'])&&$_POST['quality']!=0)
{
	$Rating_2 = (int)($_POST['quality']);
	$to_ratebeaker=beakerRating($UID,$VID,$Rating_2);
 }
 if($to_rateStar==0||$to_ratebeaker==0)
	{echo "<script>alert(\"Rating success\")</script>";}
		}
 }
 
// ----ACCEPT THE COMMENTS---
 $CID=null;
 if(isset($_COOKIE["userId"]))
{
	$UID=$_COOKIE["userId"];

 if(isset($_POST['commentText'])&&$_POST['commentText']!="")
 {
	 $text=$_POST['commentText'];
	 $Date=date("y-m-d h:i:s",time());
	  if (newComment($text,$VID,$UID,$CID,$Date)==0){echo "<script>alert(\"Comment Success\")</script>";}
	  else {echo "<script>alert(\"Comment failure\")</script>";}
 }
}
?>

  
</body>
</html>