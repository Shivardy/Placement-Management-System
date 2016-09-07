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
  <h1 align="center"class="panel-title">Change Student Status</h1></div>
  <div class="panel-body">
<?php
	 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
		 $query='SELECT * FROM students where id="'.$_GET['id'].'"';
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);
$rollno=$row['rollno'];
if(isset($_POST['submit'])){
$email=$row['email'];
$branch=$row['branch'];
$student=$row['firstname'].$row['lastname'];
$salary=$_POST['salary'];
$company=$_POST['company'];
$query='SELECT company FROM jobs WHERE student="'.$rollno.'"';
$run=$con->query($query);
if($run->num_rows==0){
  $query="INSERT into jobs (student,company,applydate,placeddate,branch,placed) VALUES ('$rollno','$company',NOW(),NOW(),'$branch','yes')";
  $con->query($query);
}
$query="SELECT * FROM placedstudents WHERE email='".$email."'";
$run = $con->query($query);
$row1=mysqli_fetch_assoc($run);

$query="INSERT INTO placedstudents(student,company,salary,email,branch,placeddate) VALUES ('$student','$company','$salary','$email','$branch',NOW())";
$run = $con->query($query);
$query='UPDATE students SET placementstatus="placed" WHERE id="'.$_GET['id'].'"';
$run = $con->query($query);
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> The student status has been updated!  <a href="students.php">Go to Students !</a>
</div>';
$query='UPDATE jobs SET placed="yes",placeddate=NOW() WHERE student="'.$rollno.'" AND company="'.$company.'"';
$con->query($query);
}

?>
<div class="row">
<div class="col-sm-6">
<h3 class="heading">Update</h3>
<form action="#" method="post">
<div class="form-group">
<label>Company Name : </label>
<?php
$query="SELECT companyname FROM company";
$run=$con->query($query);
 echo '<select  name="company"><option>Select Company</option>';
 while($row=$run->fetch_assoc()){
print_r($row);
 echo"<option value=".$row['companyname'].">".$row['companyname']."</option>";
}
echo '</select>';
?>
</div>
<div class="form-group">
<label>Salary : </label>
<input type="text" name="salary" class="form-control" placeholder="Enter Salary in Lakhs">
</div>
<div class="form-group">

<input type="submit" name="submit" class="form-control btn btn-primary btn-sm" >

</div>

</form>
</div>
<div class="col-sm-6">
<h3 class="heading">Student Profile</h3>
<?php



echo '<p style="padding:10px;border-radius:3px;"class="bg-info"><b>Name : </b> '.$row['firstname'].' '.$row['lastname'].'<br>';
echo '<b>Rollno : </b> '.$row['rollno'].'<br>';
echo '<b>Gender : </b> '.$row['gender'].'<br>';
echo '<b>Branch : </b> '.$row['branch'].'<br>';
echo '<b>Skills : </b> '.$row['skills'].'<br>';
echo '<b>Languages known : </b> '.$row['languages'].'<br>';
echo '<b>City : </b> '.$row['city'].'<br></p>';

?></div></div>
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
