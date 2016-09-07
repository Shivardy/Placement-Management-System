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

if(isset($_GET['eid'])){
if(isset($_POST['update'])){
$month=$_POST['month'];
$day=$_POST['day'];
$eventname=$_POST['eventname'];
$location=$_POST['location'];
$timing=$_POST['timing'];
if($month!="Select Month"&&$day!="0"){
$query="UPDATE events SET month='$month',day='$day',eventname='$eventname',location='$location',timing='$timing' WHERE id='".$_GET['eid']."'";
$run=$con->query($query);
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> The Event has been Updated !  <a href="events.php">Go to Manage Events !</a>
</div>';}
else{
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Please Check the Date <a href="events.php">Go to Manage Events !</a>
</div>';
}
}
if(!isset($_POST['update'])){
$query="SELECT month,day,eventname,location,timing FROM events WHERE id='".$_GET['eid']."'";
$run=$con->query($query);
$row=$run->fetch_assoc();
echo'
<h3 class="heading">Create Events</h3>
<form action="#" method="post">
<div class="form-group">
<label>Date: </label>
      <select name="month">
                                    <option >Select Month</option>
                                    <option value="JAN">January</option>
                                    <option value="FEB">February</option>
                                    <option value="MAR">March</option>
                                    <option value="APR">April</option>
                                    <option value="MAY">May</option>
                                    <option value="JUN">June</option>
                                    <option value="JUL">July</option>
                                    <option value="AUG">August</option>
                                    <option value="SEP">September</option>
                                    <option value="OCT">October</option>
                                    <option value="NOV">November</option>
                                    <option value="DEC">December</option>
                                </select>

                                <!-- Day dropdown -->
                                <select name="day" >
                                    <option>select Day</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
</div>
<div class="form-group">
<label>Event Name: </label>
<input type="text" name="eventname" class="form-control" value="'.$row['eventname'].'">
</div>
<div class="form-group">
<label>Event Location: </label>
<input type="text" name="location" class="form-control" value="'.$row['location'].'">
</div>
<div class="form-group">
<label>Timing: </label>
<input type="text" name="timing" class="form-control" value="'.$row['timing'].'">
</div>
<div class="form-group">

<input type="submit" name="update" value="Update" class="form-control btn btn-primary btn-sm" >

</div>

</form>';

}}
else{
if(isset($_POST['submit'])){
$month=$_POST['month'];
$day=$_POST['day'];
$eventname=$_POST['eventname'];
$location=$_POST['location'];
$timing=$_POST['timing'];
$query="INSERT INTO events(eventname,month,day,location,timing,time) VALUES ('$eventname','$month','$day','$location','$timing',NOW())";
$run=$con->query($query);
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> The Event has been created !  <a href="events.php">Go to Manage Events !</a>
</div>';
}
echo'
<h3 class="heading">Create Events</h3>
<form action="#" method="post">
<div class="form-group">
<label>Date: </label>
      <select name="month">
                                    <option >Select Month</option>
                                    <option value="JAN">January</option>
                                    <option value="FEB">February</option>
                                    <option value="MAR">March</option>
                                    <option value="APR">April</option>
                                    <option value="MAY">May</option>
                                    <option value="JUN">June</option>
                                    <option value="JUL">July</option>
                                    <option value="AUG">August</option>
                                    <option value="SEP">September</option>
                                    <option value="OCT">October</option>
                                    <option value="NOV">November</option>
                                    <option value="DEC">December</option>
                                </select>

                                <!-- Day dropdown -->
                                <select name="day" >
                                    <option>select Day</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
</div>
<div class="form-group">
<label>Event Name: </label>
<input type="text" name="eventname" class="form-control" placeholder="Enter Event Name">
</div>
<div class="form-group">
<label>Event Location: </label>
<input type="text" name="location" class="form-control" placeholder="Enter Location">
</div>
<div class="form-group">
<label>Timing: </label>
<input type="text" name="timing" class="form-control" placeholder="Enter Timing">
</div>
<div class="form-group">

<input type="submit" name="submit" class="form-control btn btn-primary btn-sm" >

</div>

</form>';

}

?>
<a class="link"href="events">Back to Events</a>
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
