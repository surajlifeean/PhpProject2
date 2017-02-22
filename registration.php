<?php

include('func.php');
error_reporting(0);
//include('head.php');
set_time_limit(0);
$ser="http://site24.way2sms.com/";
$ckfile = tempnam ("/tmp", "CURLCOOKIE");
$login=$ser."Login1.action";
// * Reciving Username of Way2sms A/c from Html form //
$uid="8981527733";
// * Reciving Password of Way2sms A/c from Html form //
$pwd="iloveu";
$name=$_REQUEST['name'];
$class=$_REQUEST['class'];
$dob=$_REQUEST['dbay'];
$doreg=date('y/m/d');
$school=$_REQUEST['sch'];
$board=$_REQUEST['board'];
$location=$_REQUEST['location'];

// * To whome the message send to //
$to=$_REQUEST['un'];
// * Message to be sended //
$flag=0;
$msg=rand(2010,4999);
if(!$to)
{ $to=$uid; }
if(!$msg)
{ $msg=rword(5).rword(5).rword(5).rword(5).rword(5); }
$captcha=input($_REQUEST['captcha']);
flush();
if($uid && $pwd)
{
$ibal="0";
$sbal="0";
$lhtml="0";
$shtml="0";
$khtml="0";
$qhtml="0";
$fhtml="0";
$te="0";
echo '<div class="content">User: <span class="number"><b>'.$uid.'</b></span><br>';
flush();

$loginpost="gval=&username=".$uid."&password=".$pwd."&Login=Login";

$ch = curl_init();
$lhtml=post($login,$loginpost,$ch,$ckfile);
////curl_close($ch);

if(stristr($lhtml,'Location: '.$ser.'vem.action') || stristr($lhtml,'Location: '.$ser.'MainView.action') || stristr($lhtml,'Location: '.$ser.'ebrdg.action'))
{
preg_match("/~(.*?);/i",$lhtml,$id);
$id=$id['1'];
if(!$id)
{
show('<div class="w3-container w3-section w3-red">
<span onclick="this.parentElement.style.display="none"" class="w3-closebtn">&times;</span>
  <p>Check Your Username and Password Inorder to Send SMS</p>
</div> ','darkred');
goto end;
}
// * Login Sucess Message//
show('<div class="w3-container w3-section w3-blue">
<span onclick="this.parentElement.style.display="none"" class="w3-closebtn">&times;</span>
  <p>Login Sucess - Now Wait for SMS Send</p>
</div>','darkgreen');
goto bal;
}
elseif(stristr($lhtml,'Location: http://site2.way2sms.com/entry'))
{
// * Login Faild or SMS Send Error Message 3//
show('<div class="w3-container w3-section w3-red">
<span onclick="this.parentElement.style.display="none"" class="w3-closebtn">&times;</span>
  <p>Check Your Username and Password Inorder to Send SMS</p>
</div> ','darkred');
goto end;
}
else
{
// * Login Faild or SMS Send Error Message 2//
show('<div class="w3-container w3-section w3-red">
<span onclick="this.parentElement.style.display="none"" class="w3-closebtn">&times;</span>
  <p>Check Your Username and Password Inorder to Send SMS</p>
</div> ','darkred');
goto end;
}
bal:
///$ch = curl_init();
$msg=urlencode($msg);
$main=$ser."smstoss.action";
$ref=$ser."sendSMS?Token=".$id;
$conf=$ser."smscofirm.action?SentMessage=".$msg."&Token=".$id."&status=0";

$post="ssaction=ss&Token=".$id."&mobile=".$to."&message=".$msg."&Send=Send Sms&msgLen=".strlen($msg);
$mhtml=post($main,$post,$ch,$ckfile,$proxy,$ref);
if(stristr($mhtml,'smscofirm.action?SentMessage='))
// * Message Sended Sucessfull Message//
{ show('<div class="w3-container w3-section w3-green">
<span onclick="this.parentElement.style.display="none"" class="w3-closebtn">&times;</span>
  <p>SMS Sended Sucessfully..!!</p>
</div>'.$to.'.','darkgreen');
$flag++;
echo $flag;
}
else
// * Login Faild or SMS Send Error Message 1//
{ show('<div class="w3-container w3-section w3-red">
<span onclick="this.parentElement.style.display="none"" class="w3-closebtn">&times;</span>
  <p>Check Your Username and Password Inorder to Send SMS</p>
</div> ','darkred');}
curl_close($ch);

end:

echo "</div>";

flush();
if($flag==1)
{ 
 echo '<script type="text/javascript">
       window.location.replace("index.html");
            </script>';
       
$servername = "localhost";
$username = "root";
$password ='';

try {
    $conn = new PDO("mysql:host=$servername;dbname=testmybest", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully $to"; 
     $sql2 = "INSERT INTO userdetails(phn_no,name,class,dob,doreg)
    VALUES ('".$to."','".$name."',".$class.",'".$dob."','".$doreg."')";
      // use exec() because no results are returned
    $conn->exec($sql2);
 
     $sql = "INSERT INTO password(phn_no,password)
    VALUES ('".$to."','".$msg."')";
     $conn->exec($sql);
     $sql3 = "INSERT INTO schooldetails(school,board,location)
    VALUES ('".$school."','".$board."','".$location."')";
     $conn->exec($sql3);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
  
}
 else {   
    echo '<script type="text/javascript"> alert("oops! some error has occured please try after some time.");'
     . 'window.location.replace("index.html"); </script>';
}
}

?>