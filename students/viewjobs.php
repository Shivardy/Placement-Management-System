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
 

		<?php





    $query='SELECT * FROM company where id="'.$_GET['id'].'"';
$run = $con->query($query);


  $row=$run->fetch_assoc();
echo ' <div class="panel-heading">
   <h1 align="center"class="panel-title">View Jobs from '.$row['companyname'].'</h1></div>
    <div class="panel-content">';

echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr class="info" >
                                                <th>CSE</th>
                                                <th>ECE</th>
                                                <th>IT</th>
                                                <th>MECH</th>
                                                  <th>CIVIL </th>
                                              
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';


  if(isset($_GET['branch'])){
$branch=$_GET['branch'];
$student=$_SESSION['user'];
$company=$row['companyname'];
$query="INSERT INTO jobs (student,company,branch,applydate) VALUES('$student','$company','$branch',NOW())";
$run1 = $con->query($query);

}

$query1='SELECT branch FROM jobs WHERE student="'.$_SESSION['user'].'"';
$run2 = $con->query($query1);
$yourArray = array(); 
$index = 0;
while($row1 = $run2->fetch_assoc()){ // loop to store the data in an associative array.
     $yourArray[$index] = $row1;
     $index++;
}
$size=sizeof($yourArray);
$finalarr = array(); 
for($i=0;$i<$size;$i++){
$finalarr[$i]=$yourArray[$i]['branch'];
}

  echo '<tr>';
if(in_array("cse", $finalarr))
echo '<td>'.$row['cse'];
  else
  echo '<td>'.$row['cse'].'<a href="'.$_SERVER['REQUEST_URI'].'&branch=cse"><button class="btn btn-default btn-xs">Apply</button></a></td>';
if(in_array("ece", $finalarr))
  echo '<td>'.$row['ece'];
  else
  echo '<td>'.$row['ece'].'<a href="'.$_SERVER['REQUEST_URI'].'&branch=ece"><button class="btn btn-default btn-xs">Apply</button></a></td>';
if(in_array("it", $finalarr))
  echo '<td>'.$row['it'];
  else
  echo '<td>'.$row['it'].'<a href="'.$_SERVER['REQUEST_URI'].'&branch=it"><button class="btn btn-default btn-xs">Apply</button></a></td>';
if(in_array("mech", $finalarr))
  echo '<td>'.$row['mech'];
  else
  echo '<td>'.$row['mech'].'<a href="'.$_SERVER['REQUEST_URI'].'&branch=mech"><button class="btn btn-default btn-xs">Apply</button></a></td>';
if(in_array("civil", $finalarr))
  echo '<td>'.$row['civil'];
  else
  echo '<td>'.$row['civil'].'<a href="'.$_SERVER['REQUEST_URI'].'&branch=civil"><button class="btn btn-default btn-xs">Apply</button></a></td>';





  
  
  echo "<br><br></table></div>";

  
  

  
  
  
  
  ?>
	
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
