<?php
session_start();
if(!isset($_SESSION['user'])){
header("Location:login");
}
    $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
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
  <a href="profile" class="list-group-item">Update Profile</a>
  <a href="companies" class="list-group-item">Companies</a>
      <a href="staff" class="list-group-item">Staff</a>
       <a href="feedback" class="list-group-item">Contact Admin</a>
  <a href="messages" class="list-group-item">View Messages</a>
</div>
 </div>
  </div>
</div>
	  <div class="col-sm-5" >
	<div  class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Latest News</h1></div>
  <div class="panel-body">
   <?php

    $query="SELECT * FROM news ORDER BY id DESC LIMIT 4 ";
$run=$con->query($query);
echo '  <ul class="list-group">';
while($row=$run->fetch_assoc()){
echo '       <li class="newstitle list-group-item list-group-item-info">
    <i class="glyphicon glyphicon-bullhorn"></i>
';
echo ' <h3 > '.$row['title'].'  </h3>';
                       
    echo '
 <p>'.$row['content'].'</p>';
        echo '<p style="font-family:italic;">'.$row['time'].'</p>  ';

  echo '</li>';
   }   
echo '</ul>';

    ?>  <a href="../news"><button type="button" class="btn btn-primary btn-md btn-block">View More</button></a>  
 
 </div>
  </div>
</div>
	  <div class="col-sm-4" >
	<div id="studentdashboard" class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Upcoming Events</h1></div>
  <div class="panel-body">
<?php

    $query="SELECT * FROM events ORDER BY id DESC LIMIT 5";
$run=$con->query($query);
echo '  <ul class="list-group">';
while($row=$run->fetch_assoc()){
echo '<li class="list-group-item list-group-item-info">
';
echo '  <p class="date-label eventdate">
                            <span class="month">'.$row['month'].'</span><br>
                            <span class="date-number">'.$row['day'].'</span>
                        </p>';
                       
    echo '<h3 >'.$row['eventname'].'</h3>
';
                                    echo '       <p><i class="glyphicon glyphicon-map-marker"></i>'.$row['location'].'<i class="eventp glyphicon glyphicon-time"></i>'.$row['timing'].'</p>';

  echo '</li>';
   }   
echo '</ul>';    ?>
<a href="../events"><button type="button" class="btn btn-primary btn-md btn-block">View More</button></a>   
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
