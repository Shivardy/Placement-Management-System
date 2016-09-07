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
  <h1 align="center"class="panel-title">General Stats</h1></div>
  <div class="panel-body">
<div class="row">
<div class="col-sm-4">

<div class="panel panel-info">
  <div class="panel-heading" ><br><p style="font-size:50px;"class="text-right">11</p>
  <h6 class="text-right" >Student count</h6></div>
 <a href="students" style="text-decoration: none;"> <div class="panel-footer">
  <span> View Students </span><span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
  </div>
</div></a>
</div>
<div class="col-sm-8">
<?php 
	  	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
		 $query="SELECT * FROM students ORDER BY id DESC LIMIT 5";
$run = $con->query($query);


echo'<div class="panel panel-info"><div class="panel-heading" align="center">Recently Registerd Students</div>
 <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>

                                                <th>Student Name</th>
                                                <th>Branch</th>
                                            </tr>
                                            </thead>
                                            <tbody>';


while($row=$run->fetch_assoc()){
	echo "<tr><td>".$row['firstname']." ".$row['lastname']."</td><td>".$row['branch']."</td><tr>";
	
}
echo "</tbody></table> </div></div>";


?>
</div>
</div><hr>
<div class="row">
<div class="col-sm-4">

<div class="panel panel-success">
  <div class="panel-heading" ><br><p style="font-size:50px;"class="text-right">11</p>
  <h6 class="text-right" >Companies count</h6></div>
 <a href="companies" style="text-decoration: none;"> <div class="panel-footer">
  <span> View Companies </span><span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
  </div>
</div></a>
</div>
<div class="col-sm-8">
<?php 
	  	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
		 $query="SELECT * FROM company ORDER BY id DESC LIMIT 5";
$run = $con->query($query);


echo'<div class="panel panel-success"><div class="panel-heading" align="center">Recently Registerd Companies</div>
 <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>

                                                <th>Company Name</th>
                                                <th>Url</th>
                                            </tr>
                                            </thead>
                                            <tbody>';


while($row=$run->fetch_assoc()){
	echo "<tr><td>".$row['companyname']."</td><td>".$row['website']."</td><tr>";
	
}
echo "</tbody></table> </div></div>";


?>
</div>
</div>
</div>
<hr>
<div class="row">
<div class="col-sm-4">

<div class="panel panel-warning">
  <div class="panel-heading" ><br><p style="font-size:50px;"class="text-right">11</p>
  <h6 class="text-right" >Staff count</h6></div>
<a href="staff" style="text-decoration: none;">  <div class="panel-footer">
  <span> View Staff </span><span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
  </div>
</div></a>
</div>
<div class="col-sm-8">
<?php 
	  	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
		 $query="SELECT * FROM staff ORDER BY id DESC LIMIT 5";
$run = $con->query($query);


echo'<div class="panel panel-warning"><div class="panel-heading" align="center">Recently Registerd Faculty</div>
 <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>

                                                <th>Faculty Name</th>
                                                <th>Department</th>
                                            </tr>
                                            </thead>
                                            <tbody>';


while($row=$run->fetch_assoc()){
	echo "<tr><td>".$row['firstname']." ".$row['lastname']."</td><td>".$row['branch']."</td><tr>";
	
}
echo "</tbody></table> </div></div>";


?>
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
