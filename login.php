
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testmybest";
$un=$_REQUEST['un'];
$pwd=$_REQUEST['pwd'];
session_start();
$_SESSION[phn_no]=$un;
$flag=0;
if($un=="" || $pwd=="")
    header("Location:index.html");
try {
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $stmt = $conn->prepare("SELECT phn_no, password FROM password"); 
     $stmt->execute();

     // set the resulting array to associative
     while($result = $stmt->fetch(PDO::FETCH_ASSOC))
     {
         if(($result['phn_no']==$un) && ($result['password']==$pwd))
         {
             header("Location:dashboard.php");
         }
        else {
            $flag=1;
             }
     }
     if($flag==1)
     {
         echo '<script type="text/javascript"> alert("wrong user id or password"); </script> ';
     echo "<script>setTimeout(\"location.href = 'index.html';\",1500);</script>";
     }
           
     
          
}
catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
?>  
