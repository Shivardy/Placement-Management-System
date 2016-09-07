<?php
session_start();
if(!isset($_SESSION['idno'])){
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
	 window.location.href ="http://localhost:12/placements/staff/students" + "?sort=" + sort ;
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
  <a href="students" class="list-group-item">Students</a>
  <a href="companies" class="list-group-item">Companies</a>
  <a href="feedback" class="list-group-item">Contact Admin</a>
  <a href="messages" class="list-group-item">View Messages</a>

</div>
 </div>
  </div>
</div>
	  <div class="col-sm-9" >
	<div class="panel panel-primary">
	<div class="panel-heading">
	 <h1 align="center"class="panel-title">View Students</h1></div>
		<div class="panel-content">

		
	<?php

	
 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);

	
	
	if(isset($_GET['search'])){
	
  $query = "SELECT count(id) FROM `students` WHERE CONCAT(`firstname`, `lastname`,`branch`,`city`,`gender`,`placementstatus`) LIKE '%".$_GET['search']."%'";
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


		  $query = "SELECT * FROM `students` WHERE CONCAT(`firstname`, `lastname`,`branch`,`city`,`gender`,`placementstatus`) LIKE '%".$_GET['search']."%' ORDER BY $sort $limit";
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
	 <select id="mySelect" onchange="myFunction()" name="sort"><option><b>Sort By</b></option><option value="firstname">Student name</option><option value="branch">Branch</option><option value="city">City</option><option value="gender">Gender</option><option value="placementstatus">Status</option></select></div>
	<div class="col-sm-5">
	<form class="form-inline pull-right" method="get" action="'.$_SERVER['PHP_SELF'].'"><div class="form-group"><label>Search </label><input type="text" class="form-control input-sm" name="search"><input class="btn btn-default btn-sm" type="submit"></div></form></div>
	</div>';

if( $run->num_rows>0){
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr class="info" >
                                                <th>Student Name</th>
                                                <th>Branch</th>
                                                <th>City</th>
                                                <th>Gender</th>
                                               <th>Status</th>
                                                <th>Message</th>
                                               
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){

	echo "<tr><td>".$row['firstname']." ".$row['lastname']."</td><td>".$row['branch']."</td><td>".$row['city']."</td><td>".$row['gender']."</td>";
	if($row['placementstatus']=="placed"){
	echo "<td>".$row['placementstatus']."</td>";
	}
	else {echo  '<td>'.$row['placementstatus'].'</td>'; }

	echo '<td><a href="http://localhost:12/placements/staff/messaging?sid='.$row['id'].'"><button class="btn btn-default btn-xs">Send msg</button></td>';
	

	echo "</tr>";
}
echo "</tbody></table> <hr></div>";
}

		echo "page <b>$pagenum</b> of <b>$last</b>";
	echo' <div  class="pull-right">'.$pagination.'	</div>';
	
	echo "<br><br></div>";
}
else{
		 $query="SELECT COUNT(id) FROM students ";
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


		$query="SELECT * FROM students ORDER BY $sort DESC $limit ";
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
	 <select id="mySelect" onchange="myFunction()" name="sort"><option><b>Sort By</b></option><option value="firstname">Student name</option><option value="branch">Branch</option><option value="city">City</option><option value="gender">Gender</option><option value="placementstatus">Status</option></select></div>
	<div class="col-sm-5">
	<form class="form-inline pull-right" method="get" action="'.$_SERVER['PHP_SELF'].'"><div class="form-group"><label>Search </label><input type="text" class="form-control input-sm" name="search"><input class="btn btn-default btn-sm" type="submit"></div></form></div>
	</div>';

if( $run->num_rows>0){
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr class="info" >
                                                <th>Student Name</th>
                                                <th>Branch</th>
                                                <th>City</th>
                                                <th>Gender</th>
                                               
                                                <th>Status</th>
                                                <th>Message</th>
                                               
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){

	echo "<tr><td>".$row['firstname']." ".$row['lastname']."</td><td>".$row['branch']."</td><td>".$row['city']."</td><td>".$row['gender']."</td>";
	if($row['placementstatus']=="placed"){
	echo "<td>".$row['placementstatus']."</td>";
	}
	else {echo  '<td>'.$row['placementstatus'].'</td>'; }

	echo '<td><a href="http://localhost:12/placements/staff/messaging?sid='.$row['id'].'"><button class="btn btn-default btn-xs">Send msg</button></td>';
	

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
