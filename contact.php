
?><!DOCTYPE html>
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
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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

  

	  <div class="row">
	  <div class="col-md-9" >
	<div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Contact</h1></div>
  <div class="panel-body">
  <?php
    	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
  if(isset($_POST['submit'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $message=$_POST['message'];
  if(strlen($phone)==10){
  $query="INSERT INTO contactform (name,email,phone,message,time) VALUES('$name','$email','$phone','$message',NOW())";
  $run=$con->query($query);
  if($run){
    echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Your Query has been posted. Thankyou.
</div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Please Recheck the form and Resubmit.
</div>';
  }
  }else{
  echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Your Contact number must be exactly 10 digits.
</div>';
  }
  }
  ?>
      <form action="#" method="post">
        <label >Name</label>
        <input type="text" name="name" autofocus class="form-control" placeholder="Enter your name" required>
        <br>
        <label>Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" required >
       <br> <label >Phone</label>
        <input type="number" name="phone" class="form-control" placeholder="Contact number" required>
     <br><label >Message</label>
         <textarea class="form-control" rows="6" required placeholder="Enter your message here..." name="message"></textarea>
        <br>
        <button class="btn btn-sm btn-primary btn-block" type="submit" name="submit">Send message</button>
      </form>
 </div>
  </div>
</div>
	  <div class="col-md-3">
	  <div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Postal Address</h1></div>
  <div class="panel-body">

  <h5>Divyanagar, Kachivani Singaram  
Near Narapally, at 16th KM on Warangal Highway 202.<br><br>
Ghatkesar Mandal, Ranga Reddy District- 500088. <br>
Andhra Pradesh, India.</h5>

  </div>
  </div>
  	  <div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">All Enquiries</h1></div>
  <div class="panel-body">
  <h5><i class="glyphicon glyphicon-envelope"></i> placements@nmrec.edu.in</h5>
  <h5><i class="glyphicon glyphicon-phone"></i> 9666025363</h5>
  </div>
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