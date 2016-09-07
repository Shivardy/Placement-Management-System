  <?php

session_start();
  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
$rollno=addslashes($_SESSION['user']);

$query='SELECT image FROM students WHERE rollno="'.$rollno.'"';
$run1=$con->query($query);

$row1=$run1->fetch_assoc();
header("Content-type: image/jpeg");
echo $row1['image'];


  ?>