<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>conn</title>
</head>

<body>
<?php
function connectToDB(){
$con=mysqli_connect("localhost","root","","a1241284_cs487");
// Check connection
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  return null;
	}
else
	return $con;
}
        
//-------------------------------------------check----------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------
        /* -------------------------------------------------------------
         * Used for searching videos, returns results in array format
         * field is Author, Title, etc, and find is the keyword or phrase
         * returns NULL if connection failed or query failed
         */
        function search($field,$find){
            $con = connectToDB();
            $query = "";
            $result = NULL;
            if($con!=NULL){ 
		
                $query ="SELECT  A.ID, B.Fname, B.Lname, B.Email, A.Title, A.Authors, A.Article, A.Journal, A.PubDate, A.Description, A.Picture, A.Video FROM video A, user B WHERE A.UserID = B.UID AND UPPER($field) like '%{$find}%'" ;
                if(!($result = mysqli_query($con,$query))){
                    mysqli_close($con);

                    return NULL;
                }
                else{
						$rows = array();
					while($row = mysqli_fetch_row($result)){
						 $rows[] = $row;
						}
						mysqli_free_result($result);
						mysqli_close($con);
						return $rows;
             	   }
            }
            else{
                return NULL;
            }
            
        }
        
//---------------check------------------------------------------
         /* Needs first name, last name, email, and password
         * automatically detects .edu emails for uploader purposes
         * Used to add a new user will return 1 if an error occured
         * otherwise it will return 0
		 *Uploader : 2
		 *register viewer: 3
		 *admin 1
         */
        function newUser($FName,$LName,$Email,$Password,$Pos){
           $con = connectToDB();
            $query = "";
            //User has UID, Fname, Lname, Email, Password, UserType, Enable
            if($con!=NULL){
                if($Pos === false){ //adds a registered viewer
                    $query = "INSERT INTO user (UID, Fname, Lname, Email, Password, Type, Enable)
                        VALUES
                        ('Null','$FName','$LName','$Email','$Password','3','1')";
                }
                else{ //adds an uploader
                    $query = "INSERT INTO user (UID, Fname, Lname, Email, Password, Type, Enable)
                        VALUES
                        ('Null','$FName','$LName','$Email','$Password','2','1')";
                }
                if(!mysqli_query($con,$query)){
                    mysqli_close($con);
                    return 1;
                }
                else{
                    mysqli_close($con);
                    return 0;
                }
            }
            else{
                return 1;
            }
        }
        
        
        /* --------------------------------------------------------
         * Used for the admin to manually change the user type
         * of a specific user. Needs a UID and update type 
         * (refer to the table for available integer types),
         * and returns 0 with no errors, 1 otherwise
         */
        function changeUserType($UID,$Type){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){ 
                $query = "UPDATE User SET Type = '$Type' WHERE UID = '$UID'";
                if(!mysqli_query($query,$con)){
                    mysqli_close($con);
                    return 1;
                }
                else{
                    mysqli_close($con);
                    return 0;
                }
            }
            else{
                return 1;
            }
        }
        
        
        /* --------------------------check---------------------------------------
         * Needs fields as shown below to upload a video to the database.
         * Picture and video fields are the upload path to where they
         * will be uploaded via FTP into the server. Returns 0 on
         * success, 1 otherwise
         */
        function newVideo($final,$UID,$Title,$Authors,$Article,$Keywords,$Journal,$PubDate,$Description,$Picture,$Video){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){ 
	
              $query = "INSERT INTO video (ID, UserID, Title, Authors, Article, Keywords, Journal, PubDate, Description, Picture, Video, Enable)
                        VALUES
                        ('$final','$UID','$Title','$Authors','$Article','$Keywords','$Journal','$PubDate','$Description','$Picture','$Video','1')";
						
                if(!mysqli_query($con,$query))
				{
                    mysqli_close($con);
                    return 1;
                }
                else{
                    mysqli_close($con);
                    return 0;
                }
            }
            else{
                return 2;
            }
        }
        
        
        /*-------------------------------------------------------------
         * Disables a video from the database using 
         * a Video ID and an enable (0 for disable, 1 for enable).
         * Also disables any content pertaining to the Video.
         * Returns 0 with no errors, 1 otherwise
         */
        function enableVideo($VID,$enable){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){ 
                $query = "UPDATE Video SET Enable = '$enable' WHERE ID = '$VID'";
                if(!mysqli_query($query,$con)){
                    mysqli_close($con);
                    return 1;
                }
                else{
                    $query = "UPDATE Comments SET Enable = '$enable' WHERE VID = '$VID'";
                    if(!mysqli_query($query,$con)){
                        mysqli_close($con);
                        return 1;
                    }
                    else{
                        $query = "UPDATE Flags SET Enable = '$enable' WHERE FVID = '$VID'";
                        if(!mysqli_query($query,$con)){
                            mysqli_close($con);
                            return 1;
                        }
                        else{ 
                            mysqli_close($con);
                            return 0;
                        }
                    }
                }
            }
            else{
                return 1;
            }
        }
        
        
        
        /*---------------------------------------------------------
         * Disables a user from the database using 
         * a User ID and an enable (0 for disable, 1 for enable).
         * Also disables any content pertaining to the User.
         * Returns 0 with no errors, 1 otherwise
         */
        function enableUser($UID,$enable){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){ 
                $query = "UPDATE User SET Enable = '$enable' WHERE UID = '$UID'";
                if(!mysqli_query($query,$con)){
                    mysqli_close($con);
                    return 1;
                }
                else{
                    $query = "UPDATE Comments SET Enable = '$enable' WHERE UID = '$UID'";
                    if(!mysqli_query($query,$con)){
                        mysqli_close($con);
                        return 1;
                    }
                    else{
                        $query = "UPDATE Flags SET Enable = '$enable' WHERE FUID = '$UID' OR UID ='$UID'";
                        if(!mysqli_query($query,$con)){
                            mysqli_close($con);
                            return 1;
                        }
                        else{ 
                            $query = "UPDATE Video SET Enable = '$enable' WHERE UserID = '$UID'";
                            if(!mysqli_query($query,$con)){
                                mysqli_close($con);
                                return 1;
                            }
                            else{ 
                                mysqli_close($con);
                                return 0;
                            }
                        }
                    }
                }
            }
            else{
                return 1;
            }
        }
        
        
        
        /*---------------------------------------------------
         * Completely removes a flag from the database.
         * Needs a Flag ID to do so. Returns 0 with no errors, 1 otherwise
         */
        function deleteFlag($FID){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){ 
                $query = "DELETE FROM Flags WHERE ID = '$FID'";
                if(!mysqli_query($query,$con)){
                    mysqli_close($con);
                    return 1;
                }
                else{
                    mysqli_close($con);
                    return 0;
                }
            }
            else{
                return 1;
            }
        }
        
        
        
        /* 
         * 
         */
        function addFlag($UID,$FVID,$FCID,$FUID,$type){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){
                $query = "";
            }
        }
        
        
        /* ---------------------------------------------------------------
         * Completely remoces a comment from the database
         * needs a comment ID to do so. Returns 0 with no errors, 1 otherwise
         */
        function deleteComment($CID){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){ 
                $query = "DELETE FROM Comments WHERE ID = '$CID' OR CID = '$CID'";
                if(!mysqli_query($query,$con)){
                    mysqli_close($con);
                    return 1;
                }
                else{
                    mysqli_close($con);
                    return 0;
                }
            }
            else{
                return 1;
            }
        }
        
        
        
        /* ------------------------------check-----------------------------
         * IF CID is null pass in NULL (not a string)
         * Adds a new comment with the text the video ID, the User ID,
         * and a link to a comment ID if applicable. Position goes from 0 to infinite
         * ie if there are two comments then the first one will be position 0 and
         * the second one will be position 1.
         */
        function newComment($text,$VID,$UID,$CID,$Date){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){
                if($CID == NULL){
                    $query = "SELECT *
                        FROM Comments 
                        WHERE VID = '$VID'";
                    $CID = "Null";
                }
                else{
                    $query = "SELECT *
                        FROM Comments 
                        WHERE CID = '$CID'";
                }
                $result = mysqli_query($con,$query);
                if(!$result){
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return 1;
                }
                else{
                    $position = mysqli_num_rows($result);
                    mysqli_free_result($result);
                    $query = "INSERT INTO Comments (ID, Text, VID, UID, CID, Position, Enable, Date)
                        VALUES
                        ('Null','$text','$VID','$UID','$CID','$position','1','$Date')";
                    if(!mysqli_query($con,$query)){
                        mysqli_close($con);
                        return 1;
                    }
                    else{
                        mysqli_close($con);
                        return 0;
                    }
                }    
            }
            else{
                return 1;
            }
        }
        
        
         /*-----------------------------check-------------------------------------------
         * Checks if a rating is already been given by that user for
         * that video and updates... If not it adds a new rating.
         * Needs arguments user ID, video ID, and the rating.  Returns 0 if no
         * errors, 1 otherwise.
         */
        function beakerRating($UID,$VID,$Rating){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){
                $query = "SELECT *
                        FROM VideoRating 
                        WHERE UID = '$UID' AND VID = '$VID' AND UPPER(Type) = UPPER('Beaker')";
                $result = mysqli_query($con,$query);
                if(!$result){
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return 1;
                }
                else{
                    if(mysqli_num_rows($result)==0){
                        mysqli_free_result($result);
                        $query = "INSERT INTO VideoRating (ID, UID, VID, Rating, Type)
                            VALUES
                            ('Null','$UID','$VID','$Rating','Beaker')";
                        if(!mysqli_query($con,$query)){
                            mysqli_close($con);
                            return 1;
                        }
                        else{
                            mysqli_close($con);
                            return 0;
                        }   
                    }
                    else if(mysqli_num_rows($result)>0){
                        mysqli_free_result($result);
                        $query = "UPDATE VideoRating SET Rating = '$Rating' 
                            WHERE UID = '$UID' AND VID = '$VID' AND UPPER(Type) = UPPER('Beaker')";
                        if(!mysqli_query($con,$query)){
                            mysqli_close($con);
                            return 1;
                        }
                        else{
                            mysqli_close($con);
                            return 0;
                        }   
                    }
                }
            }
            else{
                return 1;
            }
        }
        
        
        /* ------------------------------check-------------------------------
         * Checks if a rating is already been given by that user for
         * that video and updates... If not it adds a new rating.
         * Needs arguments user ID, video ID, and the rating.  Returns 0 if no
         * errors, 1 otherwise.
         */
        function starRating($UID,$VID,$Rating){
            $con = connectToDB();
            $query = "";
            if($con!=NULL){
                $query = "SELECT *
                        FROM VideoRating 
                        WHERE UID = '$UID' AND VID = '$VID' AND UPPER(Type) = UPPER('Star')";
                $result = mysqli_query($con,$query);
                if(!$result){
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return 1;
                }
                else{
                    if(mysqli_num_rows($result)==0){
                        mysqli_free_result($result);
                        $query = "INSERT INTO VideoRating (ID, UID, VID, Rating, Type)
                            VALUES
                            ('Null','$UID','$VID','$Rating','Star')";
                        if(!mysqli_query($con,$query)){
                            mysqli_close($con);
                            return 1;
                        }
                        else{
                            mysqli_close($con);
                            return 0;
                        }   
                    }
                    else if(mysqli_num_rows($result)>0){
                        mysqli_free_result($result);
                        $query = "UPDATE VideoRating SET Rating = '$Rating' 
                            WHERE UID = '$UID' AND VID = '$VID' AND UPPER(Type) = UPPER('Star')";
                        if(!mysqli_query($con,$query)){
                            mysqli_close($con);
                            return 1;
                        }
                        else{
                            mysqli_close($con);
                            return 0;
                        }   
                    }
                }
            }
            else{
                return 1;
            }
        }
        
        
        /* ---------------------------------------------------------------------
         * Fetches the comments for a specific video. Position is the position
         * in relation to either the video or other comments.  This returns
         * an array of comments with Text, Comment ID that ir may relate to,
         * Position, Fname of the user, Lname of the user, and Email.
         */
        function fetchComments($VID){
            $con = connectToDB();
            $query = "";
            $result = NULL;
            if($con!=NULL){ 
                $query = "SELECT A.Text, A.CID, A.Position,B.Fname, B.Lname, B.Email, A.Date
                    FROM Comments A, User B 
                    WHERE A.UID = B.UID AND A.VID = '$VID'";
                $result = mysqli_query($con,$query);
                if(!$result){
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return -1;
                }
                else{
                    $rows = array();
                    while($row = mysqli_fetch_row($result)){
                        $rows[] = $row;
                    }
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return $rows;
                }
            }
            else{
                return -1;
            }
        }
        
        
        /* 
         * fetches flags for a specific video ID, user ID,
         * or comment ID.
         */
        function fetchFlags($VID,$UID,$CID){
            $con = connectToDB();
            $query = "";
            $result = NULL;
            if($con!=NULL){ 
                $query = "SELECT Rating
                    FROM VideoRating 
                    WHERE UPPER(Type) = UPPER('$Type') AND VID = '$VID'";
                $result = mysqli_query($query,$con);
                if(!$result){
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return -1;
                }
                else{
                    $rows = array();
                    while($row = mysqli_fetch_row($result)){
                        $rows[] = $row;
                    }
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return $rows;
                }
            }
            else{
                return -1;
            }
        }
        
        
        /* -------------------------------check------------------------
         * Counts the amount of ratings for the specific video,
         * and calculates the rating at the time its loaded.
         * Needs a VideoID and the rating type. Returns a double for the rating,
         * and a -1 if an error occurs
         */
        function fetchRatings($VID,$Type){
            $con = connectToDB();
            $query = "";
            $result = NULL;
            if($con!=NULL){ 
                $query = "SELECT Rating
                    FROM VideoRating 
                    WHERE UPPER(Type) = UPPER('$Type') AND VID = '$VID'";
                $result = mysqli_query($con,$query);
                if(!$result){
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return -1;
                }
                else{
                    $sum = 0;
                    $rowcount = mysqli_num_rows($result);
                    while($row = mysqli_fetch_row($result)){
                        $temp = (int)$row[0];
                        $sum += $temp;
                    }
					if($rowcount!=0)
                    $end = (double)$sum/$rowcount;
					else
					$end = 0;
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return $end;
                }
            }
            else{
                return -1;
            }
        }
        
        
        /* ----------------------check----------------------------------------------
         * Takes an email and password, and passes them into the database
         * if a result is found it returns the userID with no error, and -1 if 
         * it did not find a result of the correct password and email
         * combination
         */
        function logIn($email, $pass){
            $con = connectToDB();
            $query = "";
            $result = NULL;
            if($con!=NULL){
                $query = "SELECT * FROM user WHERE UPPER(Email) = UPPER('$email') AND Password = '$pass'";
                $result = mysqli_query($con,$query);
					 $row = mysqli_fetch_array($result);
					 
					 if($row!="")
					 {
						setcookie('Fname',$row['Fname'],time()+3600);
 						 setcookie('Lname',$row['Lname'],time()+3600);
 						setcookie('E_mail',$row['Email'],time()+3600);
 						 setcookie('role',$row['Type'],time()+3600);
 						  setcookie('userId',$row['UID'],time()+3600);
                    mysqli_free_result($result);
                    mysqli_close($con);
                    return 0;
                  
                }
                else{
                   mysqli_free_result($result);
                    mysqli_close($con);
                    return 1;
                }
            }
            else{
                return 1;
            }
        }
       
	   
	   /*-----------------------------check--------------------------------------------
	   *this method is used to find the video information and show below the playing video
	   */
	   function videoInf($VID)
	   {
		    $con = connectToDB();
            $query = "";
            $result = NULL;
            if($con!=NULL){
                $query = "SELECT * FROM video WHERE ID = '$VID'";
               if(!($result = mysqli_query($con,$query))){
                    mysqli_close($con);
                    return NULL;
                }
                else{
						$rows = array();
					while($row = mysqli_fetch_row($result)){
						 $rows[] = $row;
						}
						mysqli_free_result($result);
						mysqli_close($con);
						return $rows;
             	   }
					 
	   }
	   
	   }
?>
</body>
</html>