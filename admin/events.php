<?php
session_start();
if(!isset($_SESSION['id'])){
header("Location:login");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  		<script>
		function myFunction() {
		var sort=document.getElementById('mySelect').value;
	var url= window.location.href;

	 if(url.indexOf("sort")==-1&&url.indexOf("entry")!=-1 ||url.indexOf("search")!=-1 ){
 window.location.href = window.location.href + "&sort=" + sort ;
	}
	else if(url.indexOf("sort")==-1){
 window.location.href = window.location.href + "?sort=" + sort ;
	}
	else if(url.indexOf("entry")!=-1){
	window.location.href = window.location.href + "&sort=" + sort ;
	}
	else{
	 window.location.href ="http://localhost:12/placements/admin/events" + "?sort=" + sort ;
	}

	}
				function myFunction1() {
		var entry=document.getElementById('entry').value;
	var url=window.location.href;

  if(url.indexOf("sort")!=-1 ||url.indexOf("search")!=-1 )
   window.location.href = window.location.href + "&entry=" + entry ;
   	else if(url.indexOf("entry")==-1)
 window.location.href = window.location.href + "?entry=" + entry ;
 else
  window.location.href = window.location.href + "&entry=" + entry ;
	}
		</script>
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
	<div class="panel panel-primary">
	<div class="panel-heading">
	 <h1 align="center"class="panel-title">Manage Events</h1></div>
		<div class="panel-content"><br>
           <a href="http://localhost:12/placements/admin/create_events" class="btn btn-success">Create Event</a><br/>
		
	<?php

 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
		if(isset($_GET['eid'])){
	$query='DELETE FROM events  WHERE id="'.$_GET['eid'].'"';
$con->query($query);
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> The Event has been deleted.
</div>';
	}

	if(isset($_GET['search'])){
	
  $query = "SELECT count(id) FROM `events` WHERE CONCAT(`eventname`,`month`,`day`,`location`,`timing`) LIKE '%".$_GET['search']."%'";
$run = $con->query($query);
$row=mysqli_fetch_array($run);

	$rows=$row[0];
	$pagerows=8;
		if(isset($_GET['entry'])){
$pagerows=$_GET['entry'];	
}
	
	$last=ceil($rows/$pagerows);
if($last<1){
$last=1;
}
$pagenum=1;
if(isset($_GET['pageno'])){
$pagenum=preg_replace('#[^0-9]#', '', $_GET['pageno']);;
}
if($pagenum<1){
$pagenum=1;
}else if($pagenum>$last){
$pagenum=$last;
}
$limit='LIMIT '.($pagenum-1)*$pagerows.','.$pagerows;
$sort="id";
	if(isset($_GET['sort'])){
$sort=$_GET['sort'];	
}


		  $query = "SELECT * FROM `events` WHERE CONCAT(`eventname`,`month`,`day`,`location`,`timing`) LIKE '%".$_GET['search']."%' ORDER BY $sort $limit";
$run = $con->query($query);
$pagination='';

	if($last!=1){
	if($pagenum>1){
	$previous=$pagenum-1;
	$pagination=$pagination.'<a href="'.$_SERVER['REQUEST_URI'].'&pageno='.$previous.'">Previous</a>&nbsp; &nbsp';
	for($i=$pagenum-4;$i<$pagenum;$i++){
	if($i>0){
	$pagination=$pagination.'<a href="'.$_SERVER['REQUEST_URI'].'&pageno='.$i.'"><button class="btn btn-primary">'.$i.'</button></a>&nbsp;';
	}
	}
	}
	$pagination=$pagination.' '.$pagenum.' &nbsp;';
	for($i=$pagenum+1;$i<=$last;$i++){
	$pagination=$pagination.'<a href="'.$_SERVER['REQUEST_URI'].'&pageno='.$i.'"><button class="btn btn-primary">'.$i.'</button></a>&nbsp;';
	if($i>=$pagenum+4){
	break;
	}
	}
	if($pagenum != $last){
	$next=$pagenum+1;
	$pagination=$pagination.'&nbsp; &nbsp; <a href="'.$_SERVER['REQUEST_URI'].'&pageno='.$next.'">Next</a>';
	}
	}

	echo '<div class="row"><br>
	<div class="col-sm-4">
	<select onchange="myFunction1()" id="entry">
	<option>Show Entries</option>
	<option value="10">10</option><option value="50">50</option><option value="100">100</option></select>
</div>
<div class="col-sm-3">
	 	  	 <select id="mySelect" onchange="myFunction()" name="sort"><option><b>Sort By</b></option><option value="month">Date</option><option value="timing">Timing</option><option value="location">Location</option><option value="eventname">Event Name</option></select></div>
	<div class="col-sm-5">
	<form class="form-inline pull-right" method="get" action="'.$_SERVER['PHP_SELF'].'"><div class="form-group"><label>Search </label><input type="text" class="form-control input-sm" name="search"><input class="btn btn-default btn-sm" type="submit"></div></form></div>
	</div>';

if( $run->num_rows>0){
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                             <tr  class="default" >
                                                <th>Date</th>
                                                <th>Timing</th>
                                               
                                                <th>Location </th>
                                                <th>Event Name</th>
												<th>Edit </th>
												<th>Delete</th>
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){


	echo "<tr><td>".$row['month']." ".$row['day']."</td><td>".$row['timing']."</td><td>".$row['location']."</td><td>".$row['eventname']."</td>";
	echo '<td><a href="http://localhost:12/placements/admin/create_events?eid='.$row['id'].'"><button class="btn btn-primary btn-xs">Edit Event</button></td>';
	echo '<td><a href="'.$_SERVER['PHP_SELF'].'?eid='.$row['id'].'"><button class="btn btn-danger btn-xs">Delete news</button></a></td>';

	echo "</tr>";
}
echo "</tbody></table> <hr></div>";
}

		echo "page <b>$pagenum</b> of <b>$last</b>";
	echo' <div  class="pull-right">'.$pagination.'	</div>';
	
	echo "<br><br></div>";
}
else{
		 $query="SELECT COUNT(id) FROM events";
$run = $con->query($query);
$row=mysqli_fetch_array($run);
	$rows=$row[0];
	$pagerows=8;
		if(isset($_GET['entry'])){
$pagerows=$_GET['entry'];	

}
	
	$last=ceil($rows/$pagerows);
if($last<1){
$last=1;
}
$pagenum=1;
if(isset($_GET['pn'])){
$pagenum=preg_replace('#[^0-9]#', '', $_GET['pn']);;
}
if($pagenum<1){
$pagenum=1;
}else if($pagenum>$last){
$pagenum=$last;
}
$limit='LIMIT '.($pagenum-1)*$pagerows.','.$pagerows;
$sort="id";
	if(isset($_GET['sort'])){
$sort=$_GET['sort'];	

}


		$query="SELECT * FROM events ORDER BY $sort $limit ";
$run = $con->query($query);
$pagination='';

	if($last!=1){
	if($pagenum>1){
	$previous=$pagenum-1;
	
	
	
	$pagination=$pagination.'<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'">Previous</a>&nbsp; &nbsp';
	for($i=$pagenum-4;$i<$pagenum;$i++){
	if($i>0){
	$pagination=$pagination.'<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'"><button class="btn btn-primary">'.$i.'</button></a>&nbsp;';
	}
	}
	}
	$pagination=$pagination.' '.$pagenum.' &nbsp;';
	for($i=$pagenum+1;$i<=$last;$i++){
	$pagination=$pagination.'<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'"><button class="btn btn-primary">'.$i.'</button></a>&nbsp;';
	if($i>=$pagenum+4){
	break;
	}
	}
	if($pagenum != $last){
	$next=$pagenum+1;
	$pagination=$pagination.'&nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'">Next</a>';
	}
	}

	echo '<div class="row"><br>
	<div class="col-sm-4">
	<select onchange="myFunction1()" id="entry">
	<option>Show Entries</option>
	<option value="10">10</option><option value="50">50</option><option value="100">100</option></select>
</div>
<div class="col-sm-3">
	 <select id="mySelect" onchange="myFunction()" name="sort"><option><b>Sort By</b></option><option value="month">Date</option><option value="timing">Timing</option><option value="location">Location</option><option value="eventname">Event Name</option></select></div>
	<div class="col-sm-5">
	<form class="form-inline pull-right" method="get" action="'.$_SERVER['PHP_SELF'].'"><div class="form-group"><label>Search </label><input type="text" class="form-control input-sm" name="search"><input class="btn btn-default btn-sm" type="submit"></div></form></div>
	</div>';

if( $run->num_rows>0){
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr  class="default" >
                                                <th>Date</th>
                                                <th>Timing</th>
                                               
                                                <th>Location </th>
                                                <th>Event Name</th>
												<th>Edit </th>
												<th>Delete</th>
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){

	echo "<tr><td>".$row['month']." ".$row['day']."</td><td>".$row['timing']."</td><td>".$row['location']."</td><td>".$row['eventname']."</td>";
	echo '<td><a href="http://localhost:12/placements/admin/create_events?eid='.$row['id'].'"><button class="btn btn-primary btn-xs">Edit Event</button></td>';
	echo '<td><a href="'.$_SERVER['PHP_SELF'].'?eid='.$row['id'].'"><button class="btn btn-danger btn-xs">Delete news</button></a></td>';

	echo "</tr>";
}
echo "</tbody></table> <hr></div>";
}

		echo "page <b>$pagenum</b> of <b>$last</b>";
	echo' <div  class="pull-right">'.$pagination.'	</div>';
	
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
