<?php
session_start();
if(!isset($_SESSION['id'])){
header("Location:login");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Placement Management System</title>
    <link href="../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/style.css" rel="stylesheet">
  </head>
  <body>
 <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../">Placement Management</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
       
                  <ul class="nav navbar-nav navbar-right">
   

                <li><a class="navbar-brand"  href="logout">Logout</a></li>            
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<br>
<br>
<br>

  

	  <div class="row">
	  <div class="col-sm-3" >
	<div id="studentdashboard" class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Dashboard</h1></div>
  <div class="panel-body">
<div class="list-group">
  <a href="dashboard" class="list-group-item ">Home</a>
  <a href="students" class="list-group-item">View Students</a>
  <a href="companies" class="list-group-item">View Companies / Jobs</a>
   <a href="viewapplications" class="list-group-item">View Job Applications</a>
  <a href="staff" class="list-group-item">View Staff</a>
  <a href="messages" class="list-group-item">View Messages</a>
  <a href="news" class="list-group-item">Manage News</a>
  <a href="events" class="list-group-item">Manage Events</a>
 
  <a href="queries" class="list-group-item">Queries Received</a>
  <a href="stats" class="list-group-item">Statistics</a>
</div>
 </div>
  </div>
</div>
	  <div class="col-sm-9" >
	<div id="studentdashboard" class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Send a Message</h1></div>
  <div class="panel-body">
<?php
	 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);

if(isset($_POST['submit'])){
if(isset($_GET['sid'])){
$query='SELECT * FROM students where id="'.$_GET['sid'].'"';
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);
$to=$row['firstname'].$row['lastname'];
$toid=$row['rollno'];
$tomain="student";

}
if(isset($_GET['stid'])){
$query='SELECT * FROM staff where id="'.$_GET['stid'].'"';
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);
$to=$row['firstname'].$row['lastname'];
$toid=$row['idnumber'];
$tomain="staff";
$email=$row['email'];
}
if(isset($_GET['fmain'])&&isset($_GET['toid'])){
$toid=$_GET['toid'];

if($_GET['fmain']=="student")
  $tomain="student";
if($_GET['fmain']=="company")
  $tomain="company";
if($_GET['fmain']=="staff")
  $tomain="staff";
}
if(isset($_GET['cid'])){
$query='SELECT * FROM company where id="'.$_GET['cid'].'"';
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);
$to=$row['companyname'];
$toid=$row['website'];
$tomain="company";
$email=$row['email'];
}

$subject=$_POST['subject'];
$message=$_POST['msg'];
$from='admin';


$query="INSERT INTO messages(fromm,subject,message,time,tomain,toid) VALUES ('$from','$subject', '$message',NOW(),'$tomain','$toid')";
$run=$con->query($query);
if($run)
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> The message has been sent .  <a href="dashboard.php">Go to Dashboard !</a>
</div>';



}
?>

<h3 class="heading">Send Message</h3>
<form action="#" method="post">
<div class="form-group">
<label>Subject: </label>
<input type="text" name="subject" class="form-control" placeholder="Enter Subject">
</div>
<div class="form-group">
<label>Message : </label>
<textarea  rows="5" name="msg" class="form-control" placeholder="Enter message"></textarea>
</div>
<div class="form-group">

<input type="submit" name="submit" class="form-control btn btn-primary btn-sm" >

</div>

</form>

</div>


 </div>
  </div>
</div>

</div>
    </div> <!-- /container -->
<div class="footer"style="bottom:0px;">
 <small">Copyright @ 2016 Online Placement | <a href="http://www.suramshivareddy.com">Shiva R'dy</a></small>
</div>


   <script src="../includes/jquery.js"></script>
   <script src="../includes/bootstrap.min.js"></script>
  </body>
</html>
