<?php
echo "5";
return;


$mysqli = mysqli_connect("students", "un", "pwd", "un");
$username = mysqli_real_escape_string($mysqli, $_GET['User']);
$res = mysqli_query($mysqli, "SELECT PasswordHash,FailedLogins,PasswordSetDate FROM Users WHERE Username = '".$username."';");
$ip = $_SERVER['REMOTE_ADDR'];
$crawlCheck = mysqli_query($mysqli, "SELECT Attempts,Remaining FROM LoginAttempts WHERE IP = '".$ip."';");
if(mysqli_num_rows($crawlCheck) > 0)
   {                             //BEGIN CHECK FOR EXISTING LOCKOUT
   $attemptInfo = mysqli_fetch_assoc($crawlCheck);
   $attempts = $attemptInfo['Attempts'];
   $timer = date_create($attemptInfo['Remaining']);
   $now = date_create();
   $waitTime = date_diff($timer, $now);
   if($waitTime->format("%R") != "+")
      {
      echo "2&".$timer->format("Y-m-d H:i:s")."&".date("Y-m-d H:i:s",time());
      return;
      }
   }                             //END LOCKOUT CHECK
if(strlen($username) > 16)
   {                             //BEGIN BASIC DATA VALIDATION
//error_log("3\n", 3, "/home/hopper/z1665668/public_html/csci467/GISA_CM/Resources/Error_Logs/Login.log");
   echo "-1";
   }
else if(strpos($username," ") !== false)
   {
//error_log("4\n", 3, "/home/hopper/z1665668/public_html/csci467/GISA_CM/Resources/Error_Logs/Login.log");
   echo "-2";
   }                             //END BASIC DATA VALIDATION
else if(mysqli_num_rows($res) == 0)
   {                             //BEGIN USERNAME NOT IN SYSTEM HANDLING
//error_log("5\n", 3, "/home/hopper/z1665668/public_html/csci467/GISA_CM/Resources/Error_Logs/Login.log");
   if(mysqli_num_rows($crawlCheck) == 0)
      {
//error_log("6\n", 3, "/home/hopper/z1665668/public_html/csci467/GISA_CM/Resources/Error_Logs/Login.log");
      mysqli_query($mysqli, "INSERT INTO LoginAttempts VALUES ('".$ip."',1,NULL);");
      echo "1";
      }
   else
      {
      $attempts += 1;
//error_log("".$attempts."\n\n", 3, "/home/hopper/z1665668/public_html/csci467/GISA_CM/Resources/Error_Logs/Login.log");
      mysqli_query($mysqli, "UPDATE LoginAttempts SET Attempts = ".$attempts."  WHERE IP = '".$ip."';");
      switch($attempts)
         {
         case 1:
         case 2:
         case 3:
         case 4:
            echo "1";
            break;
         case 5:
            $remaining = date("Y-m-d H:i:s",time()+5*60);
            break;
         case 6:
            $remaining = date("Y-m-d H:i:s",time()+15*60);
            break;
         case 7:
            $remaining = date("Y-m-d H:i:s",time()+60*60);
            break;
         case 8:
            $remaining = date("Y-m-d H:i:s",time()+5*60*60);
            break;
         case 9:
            $remaining = date("Y-m-d H:i:s",time()+30*60*60);
            break;
         default:
            $remaining = "9999-12-31 23:59:59";
         }
      if(isset($remaining))
         {
         $current = date("Y-m-d H:i:s");
         mysqli_query($mysqli, "UPDATE LoginAttempts SET Remaining = '".$remaining."' WHERE IP = '".$ip."';");
         echo "2&".$remaining."&".$current;        
         }
      }
   }                             //END USERNAME NOT IN SYSTEM HANDLING
else
   {
   $row = mysqli_fetch_assoc($res);
   $passHash = $row['PasswordHash'];
   $salt = hash("sha256",$username);
   $testPassHash = hash("sha512",$_POST['Pass'].$salt);
   if($passHash != $testPassHash)
      {							//BEGIN WRONG PASSWORD HANDLING
      $echovalue = "3";
      switch($failures)
         {
         case 4:
            mysqli_query($mysqli, "UPDATE Users SET PasswordHash = NULL WHERE Username = '".$username."';");
            $echovalue = "4";
         case 0:
         case 1:
         case 2:
         case 3:
            mysqli_query($mysqli, "UPDATE Users SET FailedLogins = ".($failures + 1)." WHERE Username = '".$username."';");
            echo $echovalue;
            break;
         case 5:
            echo "4";
         }
      }							//END WRONG PASSWORD HANDLING
   else
      {
      if(date_diff($row['PasswordSetDate'],date("Y-m-d",time()+365*24*60*60))->format("%R") != "+")
         {						//BEGIN EXPIRED PASSWORD HANDLING
         $token = hash("sha512",$username.date('Y-m-d',time()));
         mysqli_query($mysqli, "UPDATE Users SET SessionToken = '".$token."',TokenTimeOut = '".date("Y-m-d H:i:s",time()+600)."' WHERE Username = '".$username."';");
         echo "5&".$token;
         }						//END EXPIRED PASSWORD HANDLING
      else
         {
         mysqli_query($mysqli, "DELETE FROM LoginAttempts WHERE IP = '".$_SERVER['REMOTE_ADDR']."';");
         mysqli_query($mysqli, "UPDATE Users SET FailedLogins = 0 WHERE Username = '".$username."';");
         $token = hash("sha512",$username.date('Y-m-d',time()));
         mysqli_query($mysqli, "UPDATE Users SET SessionToken = '".$token."',TokenTimeOut = '".date("Y-m-d H:i:s",time()+600)."' WHERE Username = '".$username."';");
         echo "0&".$token;
         }
      }
   }
?>