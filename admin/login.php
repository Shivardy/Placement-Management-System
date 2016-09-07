<?php
session_start();
if(isset($_SESSION['id'])){
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
                <li><a href="../students/login">Login</a></li>
                <li><a href="../students/register">Register</a></li>            
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
	  <div class="col-md-12" >
	<div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Admin Login</h1></div>
  <div class="panel-body">
    <?php
	
	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
	  if(isset($_POST['submit'])){
         if(isset($_POST['remember'])){
    setcookie ("aemail",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));  
                setcookie ("apassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));  
           }
           else  
           {  
                if(isset($_COOKIE["aemail"]))   
                {  
                     setcookie ("aemail","");  
                }  
                if(isset($_COOKIE["apassword"]))   
                {  
                     setcookie ("apassword","");  
                }  
           }
	  $email=$_POST['email'];
	  $password=$_POST['password'];

	 

	 $query="SELECT * FROM admin WHERE email='".$email."'";
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);

if($password==$row['password']){
session_start();
$_SESSION['id']=$row['id'];
header("Location:dashboard");
}
else{
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Oh snap!</strong> Recheck your credentials and try submitting again.
</div>';
}
	  }
	  ?>
      <form action="#" method="post">
       
        <label>Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus value="<?php if(isset($_COOKIE["aemail"])) { echo $_COOKIE["aemail"]; } ?>">
        <label >Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required value="<?php if(isset($_COOKIE["apassword"])) { echo $_COOKIE["apassword"]; } ?>">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-sm btn-primary btn-block" name="submit" type="submit">Sign in</button>
      </form>
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