<?php
session_start();
if(isset($_SESSION['user'])){
header("Location:students/dashboard");
}

if(isset($_SESSION['website'])){
header("Location:company/profile");
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
    <link href="includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="includes/style.css" rel="stylesheet">
  </head>
  <body>
 <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../placements/">Placement Management</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="../placements/">Home</a></li>
            <li><a href="about">About</a></li>
            <li><a href="news">News</a></li>
            <li><a href="events">Events</a></li>
            <li><a href="resources">Resources</a></li>
            <li><a href="faq">FAQ</a></li>
            <li><a href="contact">Contact</a></li>
         
          </ul>
          <ul class="nav navbar-nav navbar-right">
           <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Students <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="students/login">Login</a></li>
                <li><a href="students/register">Register</a></li>            
              </ul>
            </li>
			 <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Staff <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="staff/login">Login</a></li>
                <li><a href="staff/register">Register</a></li>            
              </ul>
            </li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
<br>
<br>
<br>

  
      <div class="jumbotron">
        <h1 align="center">Kickstart your career!</h1>
        <p style="font-size:19px;">Looking for a job? You are at the right place. Register now, it's free and upload your resume. Sit back, relax and wait for the notification from the companies. You will be placed in few hours. What are you waiting for?</p>
      
        <p align="center">
          <a class="btn btn-md btn-primary" href="students/register">Register Now!!</a>
        </p>
      </div>
	  <div class="row">
	  <div class="col-md-4">
<div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Student Login</h1></div>
  <div class="panel-body">
  <?php
	
	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
	  if(isset($_POST['submit'])){
	  $email=$_POST['email'];
	  $password=$_POST['password'];
	 $password=sha1($password);
	 $query="SELECT password,rollno FROM students WHERE email='".$email."'";
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);
if($password==$row['password']){
session_start();
$_SESSION['user']=$row['rollno'];
header("Location:students/dashboard");
}
else{
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Oh snap!</strong> Recheck your credentials and try submitting again.
</div>';
}
	  }
	  ?>
      <form action="index" method="post">
       
        <label>Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label >Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-sm btn-primary btn-block" name="submit" type="submit">Sign in</button>
      </form>
  </div>
</div>
	   <div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Recently Placed Students</h1></div>
  <div class="panel-body">
 <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Salary</th>
                                </tr>
                                </thead>
                                <tbody>
<?php
         $query="SELECT * FROM placedstudents ORDER BY id DESC LIMIT 5";
$run=$con->query($query);

while($row=$run->fetch_assoc()){
                       
       echo  "<tr>";
       echo '<td>'.$row['student'].'</td>';
        echo '<td>'.$row['company'].'</td>';
         echo '<td>'.$row['salary'].' lakhs</td>';

     echo "</tr>";}

   

     ?>                           
              

                                
                                </tbody>
                            </table><!--//table-->
                        </div><!--//table-responsive-->
  </div>
  </div>
	  </div>
	   <div class="col-md-4">
	   <div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Events</h1></div>
  <div class="panel-body">
  <?php
echo '<ul class="list-group">';

$query="SELECT * FROM events ORDER BY id DESC LIMIT 5 ";
$run=$con->query($query);

while($row=$run->fetch_assoc()){
  
echo ' <li class="list-group-item list-group-item-info">';
echo' <p class="date-label">';
echo ' <span class="month">'.$row['month'].'</span><br>';
echo '<span class="date-number">'.$row['day'].'</span>
                       </p>';
echo " <h5 >".$row['eventname']."</h5>";
echo '<p  style="float:right;"><i class="glyphicon glyphicon-map-marker"></i>'.$row['location'].'</p>';
                      echo '<p class="time" ><i class="glyphicon glyphicon-time"></i>'.$row['timing'].'</p>';

 echo "</li>"; 

}

echo "</ul>";
?>
  </div>
   <div class="panel-footer"><a href="events"><button class="btn btn-md btn-block btn-primary">View More</button></a></div>
	  </div>


</div>
	   <div class="col-md-4">
	   <div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">News</h1></div>
  <div class="panel-body">
  <?php
  echo '<ul class="list-group">';
  $query="SELECT * FROM news ORDER BY id DESC LIMIT 3";
$run=$con->query($query);

while($row=$run->fetch_assoc()){
  
     echo ' <li class="list-group-item list-group-item-info">
    <i style="float:left;font-size:40px;"class="glyphicon glyphicon-bullhorn"></i>';
echo '<h4 class="ntitle">'.$row['title'].'</h4>';
echo ' <p>'.substr($row['content'],0,100).'&#8230;</p>';                     
 echo " </li>";

}
  echo "</ul>";
  ?>
  </div>
     <div class="panel-footer"><a href="news"><button class="btn btn-md btn-block btn-primary">View More</button></a></div>
	  </div>


</div>
</div>
    </div> <!-- /container -->
<div class="footer">
 <small">Copyright @ 2016 Online Placement | <a href="http://www.suramshivareddy.com">Shiva R'dy</a></small>
</div>


  
    <script src="includes/jquery.js"></script>
   <script src="includes/bootstrap.min.js"></script>
  </body>
</html>