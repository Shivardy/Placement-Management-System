<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location:login");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  		<script>
		function myFunction() {
		var sort=document.getElementById('mySelect').value;
	var url= window.location.href;

	 if(url.indexOf("sort")==-1&&url.indexOf("entry")!=-1 ||url.indexOf("search")!=-1 ){
 window.location.href = window.location.href + "&sort=" + sort ;
	}
	else if(url.indexOf("sort")==-1){
 window.location.href = window.location.href + "?sort=" + sort ;
	}
	else if(url.indexOf("entry")!=-1){
	window.location.href = window.location.href + "&sort=" + sort ;
	}
	else{
	 window.location.href ="http://localhost:12/placements/company/students" + "?sort=" + sort ;
	}

	}
				function myFunction1() {
		var entry=document.getElementById('entry').value;
	var url=window.location.href;

  if(url.indexOf("sort")!=-1 ||url.indexOf("search")!=-1 )
   window.location.href = window.location.href + "&entry=" + entry ;
   	else if(url.indexOf("entry")==-1)
 window.location.href = window.location.href + "?entry=" + entry ;
 else
  window.location.href = window.location.href + "&entry=" + entry ;
	}
		</script>
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
	<div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Dashboard</h1></div>
  <div class="panel-body">
<div class="list-group">
  <a href="dashboard" class="list-group-item ">Home</a>
  <a href="profile" class="list-group-item">Update Profile</a>
  <a href="companies" class="list-group-item">Companies</a>
      <a href="staff" class="list-group-item">Staff</a>
       <a href="feedback" class="list-group-item">Contact Admin</a>
  <a href="messages" class="list-group-item">View Messages</a>

</div>
 </div>
  </div>
</div>
	  <div class="col-sm-9" >
	<div class="panel panel-primary">
	<div class="panel-heading">
	 <h1 align="center"class="panel-title">Feedback</h1></div>
		<div class="panel-body">

		
	<?php

	
 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);

if(isset($_POST['submit'])){

$query='SELECT * FROM students where rollno="'.$_SESSION['user'].'"';
$run = $con->query($query);
$row=$run->fetch_assoc();
$from=$row['firstname'].$row['lastname'];
$email=$row['email'];
$subject=$_POST['subject'];
$message=$_POST['msg'];
$tomain="admin";
$toid=$row['rollno'];
$fmain="student";
$fid=$_SESSION['user'];
$query="INSERT INTO messages(fromm,subject,message,time,tomain,toid,fmain,fid) VALUES ('$from','$subject', '$message', NOW(),'$tomain','$toid','$fmain','$fid')";
$run=$con->query($query);
if($run)
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> The message has been sent to '.$tomain.'  <a href="dashboard.php">Go to Dashboard !</a>
</div>';



}


	
	
	
	
	?>
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

</div>
    </div> <!-- /container -->
<div class="footer"style="bottom:0px;">
 <small">Copyright @ 2016 Online Placement | <a href="http://www.suramshivareddy.com">Shiva R'dy</a></small>
</div>


   <script src="../includes/jquery.js"></script>
   <script src="../includes/bootstrap.min.js"></script>
  </body>
</html>
