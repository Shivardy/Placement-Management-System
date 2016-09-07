<?php
session_start();
if(isset($_SESSION['user'])){
header("Location:dashboard");
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
          <ul class="nav navbar-nav">
            <li><a href="../">Home</a></li>
            <li><a href="../about">About</a></li>
            <li><a href="../news">News</a></li>
            <li><a href="../events">Events</a></li>
            <li><a href="../resources">Resources</a></li>
            <li><a href="../faq">FAQ</a></li>
            <li><a href="../contact">Contact</a></li>
         
          </ul>
                  <ul class="nav navbar-nav navbar-right">
           <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Students <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="login">Login</a></li>
                <li><a href="register">Register</a></li>            
              </ul>
            </li>
			 <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Staff <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../staff/login">Login</a></li>
                <li><a href="../staff/register">Register</a></li>            
              </ul>
            </li>
			 <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Company <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../company/login">Login</a></li>
                <li><a href="../company/register">Register</a></li>            
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

  

	  <div class="row">
	  <div class="col-md-9" >
	<div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Student Register</h1></div>
  <div class="panel-body">
  	  <?php
	
	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
	  if(isset($_POST['submit'])){
$fname=$_POST['fname'];
$lname=$_POST['lname'];
if($_POST['branch']!="Select Branch")
$branch=$_POST['branch'];
else
$branch="";
$rollno=$_POST['rollno'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$cemail=$_POST['cemail'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
if(strcmp($email,$cemail)==1){
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Your email and conform email are not matching.
</div>';
}
if(strcmp($password,$cpassword)!=0){
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Your password and conform password are not matching.
</div>';
}
if(strlen($phone)!=10){
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Your contact number must be exactly 10 numbers.
</div>';
}
if(strlen($rollno)!=10){
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Your rollno must be exactly 10 characters.
</div>';
}
if($email==$cemail && $password==$cpassword && strlen($phone)==10 && strlen($rollno)==10){
$query="SELECT * FROM students WHERE rollno='".$rollno."'";
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);
if(sizeof($row)==0){
$password=sha1($password);
$query="INSERT INTO students(firstname,lastname,rollno,branch,contactno,email,password,registeredtime) VALUES ('$fname','$lname','$rollno','$branch','$phone','$email','$password',NOW())";
$run=$con->query($query);
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Your Registration has been Success   <a href="login" class="alert-link">Click here to login.</a>
</div>';
}
else {
echo '<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> This Email has been already registerd.
</div>';}
}

	  }
	  
	  ?>
      <form action="register" method="post">
         <label>Firstname</label>
        <input type="text" name="fname" class="form-control" placeholder="Enter Firstname" required autofocus>
		   <label>Lastname</label>
        <input type="text" name="lname" class="form-control" placeholder="Enter Lastname" required autofocus><br>
		   <label>Rollno</label>
        <input type="text" name="rollno" class="form-control" placeholder="Enter Rollno" required autofocus>
		   <label>Branch</label>
        <select name="branch" class="form-control"><option>Select Branch</option>
        <option value="cse">Computer Science</option>
        <option value="it">Information Technology</option>
        <option value="ece">Electronics and Communication</option>
        <option value="mech">Mechanical</option>
        <option value="civil">Civil</option>
        </select>
			 <label >Contact number</label>
        <input type="number" name="phone" class="form-control" placeholder="Enter Contact number" required><br>
        <label>Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Email address" required autofocus>
		 <label>Conform Email address</label>
        <input type="email" name="cemail" class="form-control" placeholder="Enter Email address" required autofocus><br>
	
        <label >Password</label>
        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
  <label >Conform Password</label>
        <input type="password" name="cpassword" class="form-control" placeholder="Enter Password" required><br>
        <button class="btn btn-sm btn-primary btn-block" name="submit" type="submit">Sign up</button>
      </form>

	  
 </div>
  </div>
</div>
	  <div class="col-md-3">
	  <div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Student Login</h1></div>
  <div class="panel-body">

  <h3 class="lead"align="center"><label>Login into your account</label></h3>

<a href="login"><button class="btn btn-sm btn-primary btn-block">Login</button></a>
  </div>
  </div>

</div>
</div>
    </div> <!-- /container -->
<div class="footer">
 <small">Copyright @ 2016 Online Placement | <a href="http://www.suramshivareddy.com">Shiva R'dy</a></small>
</div>
    <script src="../includes/jquery.js"></script>
   <script src="../includes/bootstrap.min.js"></script>
  </body>
</html>