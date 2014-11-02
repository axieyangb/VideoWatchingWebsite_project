<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>searchResult</title>


</head>

<body>
<?php
include("conn.php");
		 $find ='';
        $field ='';
        $query1 = '';
        if(isset($_POST['search'])){
            $find = $_POST['find'];
            $field = $_POST['field'];
			 $find = strtoupper($find);
            $find = strip_tags($find);
            $find = trim($find);
           $query1= search($field,$find);
		   if($query1==null)
		   echo "Nothing has been found";
		   else
		   {
			displayList(count($query1),$query1);
          // print_r($query1);
			}
        //echo $query;
        }
		
		
		function displayList($count,$query1)
		{
			$string="";
			for($i=0;$i<$count;$i++)
			{
				$j=$i+1;
				echo "<li><a class=\"Link_".$j."\" href=\"video/playVideo.php?ID=".$query1[$i][0]."\" target=\"_blank\">Title: &nbsp".$query1[$i][4]."&nbsp&nbsp Authors:&nbsp".$query1[$i][5]."&nbsp&nbsp Publish Date: &nbsp ".$query1[$i][8]." </a></li>";
			}

		}
	?>	
</body>
</html>