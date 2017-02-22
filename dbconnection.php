<?php
session_start();
$phn_no=$_SESSION['phn_no'];
$servername = "localhost";
$username = "root";
$password = "";
$path="img/26115.jpg";

try {
    $conn = new PDO("mysql:host=$servername;dbname=testmybest", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // set the resulting array to associative
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
 $stmt = $conn->query("SELECT * FROM profilepic"); 
 $stmt1= $conn->query("SELECT * FROM userdetails where phn_no='".$phn_no."'");
 while ($row = $stmt->fetch()) {
      if(strcmp($phn_no,$row['phn_no'])==0)
      {
          $path=$row['img_path'].$row['img_name'];
      }             
 
}
while($row = $stmt1->fetch() ) {
   $name=$row['name'];
}
$firstname=(explode(" ", $name));
?>
