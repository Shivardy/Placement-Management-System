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
  <h1 align="center"class="panel-title">Company/ job Entry</h1></div>
  <div class="panel-body">
<?php
	 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);


  if(isset($_POST['submit'])){
$cname=$_POST['cname'];
$curl=$_POST['curl'];
$cemail=$_POST['cemail'];
$cjob=$_POST['cjob'];
$cdesc=$_POST['cdesc'];
$cno=$_POST['cno'];
$query="INSERT INTO company(companyname,website,email,postedtime,jobtitle,jobdesc,noofjobs) VALUES ('$cname','$curl','cemail',NOW(),'$cjob','$cdesc','$cno')";
$run=$con->query($query);
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> The News has been created !  <a href="companies.php">Go to Companies !</a>
</div>';
}
echo'

<form action="#" method="post">
<div class="form-group">
<label>Company Name: </label>
<input type="text" name="cname" class="form-control" placeholder="Enter Company Name" required>
</div>
<div class="form-group">
<label>Company Website: </label>
<input type="url" name="curl" class="form-control" placeholder="Enter Url" required>
</div>
<div class="form-group">
<label>Company Email: </label>
<input type="email" name="cemail" class="form-control" placeholder="Enter Email" required>
</div>
<div class="form-group">
<label>Job Title: </label>
<input type="text" name="cjob" class="form-control" placeholder="Enter Title" required>
</div>
<div class="form-group">
<label>Job Description: </label>
<textarea  rows="5" name="cdesc" class="form-control" placeholder="Enter Description" required></textarea>
</div>
<div class="form-group">
<label>No of Jobs: </label>
<input type="number" name="cno" class="form-control" placeholder="Enter Jobs count" required>
</div>
<div class="form-group">

<input type="submit" name="submit" class="form-control btn btn-primary btn-sm" >

</div>

</form>';


?>
<a class="link"href="companies">Back to Companies/jobs</a>
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
