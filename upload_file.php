<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
 <a class="back" href="../index.php"></a>
<?php 
 include("conn.php");// call the connect file .

$title = $authors=$Description=$Journal=$PubDate=$keywords=$article="";
$titleERR = $author1ERR=$tag1ERR="";
$isValid[0]=$isValid[1]=$isValid[2]=$isValid[3]=$isValid[4]=false;
if ($_SERVER["REQUEST_METHOD"]=="POST")
{
	if(empty($_POST["title"]))
	{$titleERR ="title is required";}
	else 
	{$title = test_input($_POST["title"]);$isValid[0]=true;}
	}
	if(empty($_POST["author1"]))
	{$author1ERR ="author1 is required";}
	else
	{$isValid[1]=true;}
	if(empty($_POST["tag1"]))
	{$tag1ERR ="tag1 is required";}
	else
	{$isValid[2]=true;}
	$authors=$_POST["author1"]." ".$_POST["author2"]." ".$_POST["author3"];
	$Description = test_input($_POST["description"]);
	$keywords =$_POST["tag1"]." ".$_POST["tag2"]." ".$_POST["tag3"];
	$PubDate = test_input($_POST["publishDate"]);
	$Journal=test_input($_POST["Journal"]);
	$article=test_input($_POST["Article"]);
	function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<?php
if(!($author1ERR==""&&$titleERR==""&&$tag1ERR==""))
{
echo "<br>";
echo "<h2>Title ERROR:</h2>".$titleERR;
echo "<br>";
echo "<br>";
echo "<h2>Author ERROR:</h2>".$author1ERR;
echo "<br>";
echo "<br>";
echo"<h2>Tag ERROR:</h2>". $tag1ERR;
}
$videoId =(int)(date('m').date('i').date('s').rand(1000,9999));
$videoId_1 =(int)(date('m').date('i').date('s').rand(1000,9999));
$final;
$allowedExts = array("jpg","jpeg");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

  
  if ($_FILES["file"]["error"] > 0)
    {
		echo "<br>";
		switch($_FILES["file"]["error"])
		{case 1:
		echo "<h4>Size exceeds upload max file size 5MB;</h4><br>";
		break;
		case 2:
		echo "<h4>Size exceeds upload max file size specified in HTML form;</h4><br>";
	
		break;
		case 3:
		echo "<h4>just part of the file has been uploaded;</h4<br>>";
		break;
		case 4:
		echo "<h4>no Image has been uploaded;</h4><br>";
		break;
    default: echo "<h4>Other ERROR:CODE is:</h4><br>" .$_FILES["file"]["error"];
		}
    }
  else
    {
		echo "<br><h2>Image submitted information</h2>" ;  
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
		$_FILES["file"]["name"]=$videoId.".jpg";
		$final=$videoId;
		$isValid[3]=true;
	}
		
  $allowedExts = array("mp4","ogg");
$temp = explode(".", $_FILES["video"]["name"]);
$extension = end($temp);
  if ($_FILES["video"]["error"] > 0)
     {
		 echo "<br>";
		 switch($_FILES["video"]["error"])
		{case 1:
		echo "<h4>Size exceeds upload max file size 5MB;</h4><br>";
		break;
		case 2:
		echo "<h4>Size exceeds upload max file size specified in HTML form;</h4><br>";
		break;
		case 3:
		echo "<h4>just part of the file has been uploaded;</h4<br>>";
		break;
		case 4:
		echo "<h4>no file has been uploaded;</h4><br>";
		break;
    default: echo "<h4>Other ERROR:CODE is:</h4><br>" .$_FILES["file"]["error"];
		}
    }
  else
    {
	echo "<br><h2>Video submitted information</h2>" ;
    echo "Upload: " . $_FILES["video"]["name"] . "<br>";
    echo "Type: " . $_FILES["video"]["type"] . "<br>";
    echo "Size: " . ($_FILES["video"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["video"]["tmp_name"] . "<br>";
	 
	$_FILES["video"]["name"]=$videoId.".mp4";

	  $isValid[4]=true;

    }
	echo "1".$isValid[0];
	echo "2".$isValid[1];
	echo "3". $isValid[2];
	echo "4".$isValid[3];
	echo "5".$isValid[4];
	
 if($isValid[0]&&$isValid[1]&&$isValid[2]&&$isValid[3]&&$isValid[4])
 {

	      if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
		  $_FILES["file"]["name"]=$videoId_1;
 			$final=$videoId1;
      }
        
      
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      
	    if (file_exists("upload/" . $_FILES["video"]["name"]))
      {
	     $_FILES["video"]["name"]=$videoId1.".mp4";
      }
      
      move_uploaded_file($_FILES["video"]["tmp_name"],
      "upload/" . $_FILES["video"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["video"]["name"];
      
   }
  else
  echo "<br><h2> no video or image has been upload</h2>";
 
?> 



<?php
 if($isValid[0]&&$isValid[1]&&$isValid[2]&&$isValid[3]&&$isValid[4])
 {
 $name ="upload/".$_FILES["file"]["name"];
 $store =$name;
/*构造函数-生成缩略图+水印,参数说明:
$srcFile-图片文件名,
$dstFile-另存文件名,
$markwords-水印文字,
$markimage-水印图片,
$dstW-图片保存宽度,
$dstH-图片保存高度,
$rate-图片保存品质*/

function makethumb($srcFile,$dstFile,$dstW,$dstH,$rate=100,$markwords=null,$markimage=null)
{
$data = GetImageSize($srcFile);
switch($data[2])
{
case 1:
$im=@ImageCreateFromGIF($srcFile);
break;
case 2:
$im=@ImageCreateFromJPEG($srcFile);
break;
case 3:
$im=@ImageCreateFromPNG($srcFile);
break;
}
if(!$im) return False;
$srcW=ImageSX($im);
$srcH=ImageSY($im);
$dstX=0;
$dstY=0;
if ($srcW*$dstH>$srcH*$dstW)
{
$fdstH = round($srcH*$dstW/$srcW);
$dstY = floor(($dstH-$fdstH)/2);
$fdstW = $dstW;
}
else
{
$fdstW = round($srcW*$dstH/$srcH);
$dstX = floor(($dstW-$fdstW)/2);
$fdstH = $dstH;
}
$ni=ImageCreateTrueColor($dstW,$dstH);
$dstX=($dstX<0)?0:$dstX;
$dstY=($dstX<0)?0:$dstY;
$dstX=($dstX>($dstW/2))?floor($dstW/2):$dstX;
$dstY=($dstY>($dstH/2))?floor($dstH/s):$dstY;
$white = ImageColorAllocate($ni,255,255,255);
$black = ImageColorAllocate($ni,0,0,0);
imagefilledrectangle($ni,0,0,$dstW,$dstH,$white);// 填充背景色
ImageCopyResized($ni,$im,$dstX,$dstY,0,0,$fdstW,$fdstH,$srcW,$srcH);
if($markwords!=null)
{
$markwords=iconv("gb2312","UTF-8",$markwords);
//转换文字编码
ImageTTFText($ni,20,30,450,560,$black,”simhei.ttf”,$markwords); //写入文字水印
//参数依次为，文字大小|偏转度|横坐标|纵坐标|文字颜色|文字类型|文字内容
}
elseif($markimage!=null)
{
$wimage_data = GetImageSize($markimage);
switch($wimage_data[2])
{
case 1:
$wimage=@ImageCreateFromGIF($markimage);
break;
case 2:
$wimage=@ImageCreateFromJPEG($markimage);
break;
case 3:
$wimage=@ImageCreateFromPNG($markimage);
break;
}
imagecopy($ni,$wimage,500,560,0,0,88,31); //写入图片水印,水印图片大小默认为88*31
imagedestroy($wimage);
}
ImageJpeg($ni,$dstFile,$rate);
ImageJpeg($ni,$srcFile,$rate);
imagedestroy($im);
imagedestroy($ni);
}
 if ($_FILES["file"]["error"] == 0)
 {
makethumb("$name","$store","100","100");
echo"<br>";
echo "<h1>picture has been successful changed to the size of 100*100</h1>";
 }
 }
?>‍

<?php
  if($isValid[0]&&$isValid[1]&&$isValid[2]&&$isValid[3]&&$isValid[4])
	 { 
	 $userId =$_COOKIE['userId'];
	 $Picture="";
	 $Video="";
	$to_upload=newVideo($final,$userId,$title,$authors,$article,$keywords,$Journal,$PubDate,$Description,$Picture,$Video);
	if ($to_upload==0)
	  {
	  echo "<h2>Congratulations! Upload Success!</h2>";
	  }
	else
	echo "<h2> Upload failure!</h2>";
 }
	 ?>
</body>
</html>