<?php
session_start();
if(!isset($_SESSION['user'])){
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
	<div class="panel-heading">
	 <h1 align="center"class="panel-title">View Queries</h1></div>
		<div class="panel-content">

		
	<?php

	
 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
		if(isset($_GET['did'])){
	$query='DELETE FROM messages  WHERE id="'.$_GET['did'].'"';
$con->query($query);
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> The Message has been deleted.
</div>';
	}
	
	
	if(isset($_GET['search'])){

$toid=$_SESSION['user'];
		  $query = "SELECT * FROM `messages` WHERE CONCAT(`fromm`,`subject`,`time`,`message`) LIKE '%".$_GET['search']."%' AND toid='$toid' AND tomain='student'";
$run = $con->query($query);


	echo '<div class="row"><br>
	<div class="col-sm-4">
	
</div>
<div class="col-sm-3">
	 	  </div>
	<div class="col-sm-5">
	<form class="form-inline pull-right" method="get" action="'.$_SERVER['PHP_SELF'].'"><div class="form-group"><label>Search </label><input type="text" class="form-control input-sm" name="search"><input class="btn btn-default btn-sm" type="submit"></div></form></div>
	</div>';

if( $run->num_rows>0){
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                             <tr >
                                             <th> From</th>
                                                
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Sent time</th>
                                                <th>Respond</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){


  echo "<tr><td>".$row['fromm']."</td><td>".$row['subject']."</td><td>".$row['message']."</td><td>".$row['time']."</td>";
  if($row['fromm']=="admin")
  echo '<td><a href="http://localhost:12/placements/students/feedback"><button class="btn btn-default btn-xs">Reply</button></a></td>';
else
    echo '<td><a href="http://localhost:12/placements/students/messaging?toid='.$row['fid'].'&tomain='.$row['fmain'].'"><button class="btn btn-default btn-xs">Reply</button></a></td>';
  echo '<td><a href="'.$_SERVER['PHP_SELF'].'?did='.$row['id'].'"><button class="btn btn-danger btn-xs">Delete Msg</button></a></td>';

  echo "</tr>";
}
echo "</tbody></table> <hr></div>";
}


	
	echo "<br><br></div>";
}
else{
		
		$query='SELECT * FROM messages WHERE toid="'.$_SESSION['user'].'" AND tomain="student" ORDER BY id DESC';
$run = $con->query($query);

	echo '<div class="row"><br>
	<div class="col-sm-4">
	
</div>
<div class="col-sm-3">
	</div>
	<div class="col-sm-5">
	<form class="form-inline pull-right" method="get" action="'.$_SERVER['PHP_SELF'].'"><div class="form-group"><label>Search </label><input type="text" class="form-control input-sm" name="search"><input class="btn btn-default btn-sm" type="submit"></div></form></div>
	</div>';

if( $run->num_rows>0){
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr >
                                                <th> From</th>
                                                
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Sent time</th>
                                                <th>Respond</th>
                                                <th>Delete</th>
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){

	echo "<tr><td>".$row['fromm']."</td><td>".$row['subject']."</td><td>".$row['message']."</td><td>".$row['time']."</td>";
  if($row['fromm']=="admin")
  echo '<td><a href="http://localhost:12/placements/students/feedback"><button class="btn btn-default btn-xs">Reply</button></a></td>';
else
    echo '<td><a href="http://localhost:12/placements/students/messaging?toid='.$row['fid'].'&tomain='.$row['fmain'].'"><button class="btn btn-default btn-xs">Reply</button></a></td>';
	echo '<td><a href="'.$_SERVER['PHP_SELF'].'?did='.$row['id'].'"><button class="btn btn-danger btn-xs">Delete Msg</button></a></td>';

	echo "</tr>";
}
echo "</tbody></table> <hr></div>";
}

	
	echo "<br><br></div>";

	}
	

	
	
	
	
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
