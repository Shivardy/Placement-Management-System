<?php
session_start();
if(!isset($_SESSION['id'])){
header("Location:login");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <style type="text/css">
      .demo { position: relative; }
      .demo i {
        position: absolute; bottom: 10px; right: 24px; top: auto; cursor: pointer;
      }
      </style>	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Placement Management System</title>
    <link href="../includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="../includes/stylestat.css" rel="stylesheet">

      <link rel="stylesheet" type="text/css" media="all" href="../includes/daterangepicker.css" />
      <script type="text/javascript" src="../includes/jquery.js"></script>
      <script type="text/javascript" src="../includes/bootstrap.min.js"></script>
      <script type="text/javascript" src="../includes/moment.min.js"></script>
      <script type="text/javascript" src="../includes/daterangepicker.js"></script>
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
	 <h1 align="center" class="panel-title">Statistics</h1></div>
		<div class="panel-content">

		
	<?php
 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
$query="SELECT companyname FROM company";
$run=$con->query($query);

echo '<div class="row">
<div class="col-sm-4">
<p class="lead" align="center">Students Registerd</p>
<form action="stats.php" method="post">
     <div class="form-group">
   
 <input type="text" name="datefilter"  placeholder="Select Date Range"class="form-control input-sm">
  </div>
  <div class="form-group">
  <select name="branch"><option>Select Branch</option><option value="cse">CSE</option>
<option value="ece">ECE</option>
<option value="mech">MECH</option>
<option value="it">IT</option>
<option value="civil">CIVIL</option>
   </select>
   <select name="gender"><option>Select Gender</option><option value="female">Female</option><option value="male">Male</option></select>
  </div>
     <div class="form-group">
 <input type="submit" name="regsub"class="form-control input-sm">
  </div>
</form>
</div>
<div class="col-sm-4">
<p class="lead" align="center">Jobs Applied</p>
<form action="stats.php" method="post">
   <div class="form-group">
   
 <input type="text" name="datefilter"  placeholder="Select Date Range"class="form-control input-sm">
  </div>
     <div class="form-group">';
     echo '<select  name="company"><option>Select Company</option>';
while($row=$run->fetch_assoc()){
print_r($row);
 echo"<option value=".$row['companyname'].">".$row['companyname']."</option>";
}
echo '</select>';
  echo '<select name="branch"><option>Select Branch</option><option value="cse">CSE</option>
<option value="ece">ECE</option>
<option value="mech">MECH</option>
<option value="it">IT</option>
<option value="civil">CIVIL</option>
   </select>
  </div>
       <div class="form-group">
 <input type="submit" name="jobsub"class="form-control input-sm">
  </div>
</form>
</div>
<div class="col-sm-4">
<p class="lead" align="center">Placed Students</p>
<form  action="stats.php" method="post">
   <div class="form-group">
   
 <input type="text" name="datefilter"  placeholder="Select Date Range"class="form-control input-sm">
  </div>
       <div class="form-group">';
     echo '<select name="company"><option>Select Company</option>';
     $query="SELECT companyname FROM company";
$run=$con->query($query);
while($row=$run->fetch_assoc()){

 echo"<option value=".$row['companyname'].">".$row['companyname']."</option>";
}
echo '</select>';
  echo '<select name="branch"><option>Select Branch</option><option value="cse">CSE</option>
<option value="ece">ECE</option>
<option value="mech">MECH</option>
<option value="it">IT</option>
<option value="civil">CIVIL</option>
   </select>
  </div>
       <div class="form-group">
 <input type="submit" name="placedsub"class="form-control input-sm">
  </div>
</form>
</div>

</div>';
if(isset($_POST['regsub'])){
  if($_POST['datefilter']!=""){
$a=$_POST['datefilter'];
$start= trim(substr($a,0,10));
$end= trim(substr($a,15,10));
if($_POST['gender']!="Select Gender" && $_POST['branch']!="Select Branch"){
 
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM students WHERE branch='$branch' AND(gender='$gender') AND (registeredtime BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
}
if($_POST['gender']!="Select Gender" && $_POST['branch']=="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM students WHERE gender='$gender' AND (registeredtime BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
}
if($_POST['gender']=="Select Gender" && $_POST['branch']!="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM students WHERE branch='$branch'  AND (registeredtime BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
}
if($_POST['gender']=="Select Gender" && $_POST['branch']=="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM students WHERE registeredtime BETWEEN '" . $start . "' AND  '" . $end . "'
ORDER by id DESC";
}
}
else{

if($_POST['gender']!="Select Gender" && $_POST['branch']!="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM students WHERE branch='$branch' AND(gender='$gender') 
ORDER by id DESC";
}
if($_POST['gender']!="Select Gender" && $_POST['branch']=="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM students WHERE gender='$gender' 
ORDER by id DESC";
}
if($_POST['gender']=="Select Gender" && $_POST['branch']!="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM students WHERE branch='$branch'  
ORDER by id DESC";
}
if($_POST['gender']=="Select Gender" && $_POST['branch']=="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="nothing to be selected :V";
}
  
}


$run=$con->query($query);
if($run->num_rows>0){
  echo "<h5>Total Results: <b><i>".$run->num_rows."</i></b></h5>";
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr class="info" >
                                                <th>Student Name</th>
                                                <th>Branch</th>
                                                <th>Registerd Date</th>
                                                <th>City</th>
                                                <th>Gender</th>
                                               
                                                <th>Status</th>
                                                <th>Message</th>
                                                <th>#</th>
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){
  echo "<tr><td>".$row['firstname']." ".$row['lastname']."</td><td>".$row['branch']."</td><td>".$row['registeredtime']."</td><td>".$row['city']."</td><td>".$row['gender']."</td>";

  echo "<td>".$row['placementstatus']."</td>";



  echo '<td><a href="http://localhost:12/placements/admin/messaging?sid='.$row['id'].'"><button class="btn btn-default btn-xs">Send msg</button></td>';
  
  
  if($row['accountstatus']=="activate"){
  echo '<td><a href="'.$_SERVER['PHP_SELF'].'?deactivateid='.$row['id'].'"><button class="btn btn-danger btn-xs">Deactivate</button></a></td>';
  }
  else {
  
  echo '<td><a href="'.$_SERVER['PHP_SELF'].'?activateid='.$row['id'].'"><button class="btn btn-success btn-xs">Activate</button></a></td>'; }
  echo "</tr>";

}
echo "</tbody></table> <hr></div>";
}
else
  echo'<h5 align="center"> No Results Found.</h5>';
}



if(isset($_POST['jobsub'])){
  if($_POST['datefilter']!=""){
$a=$_POST['datefilter'];
$start= trim(substr($a,0,10));
$end= trim(substr($a,15,10));
if($_POST['company']!="Select Company" && $_POST['branch']!="Select Branch"){
 
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM jobs WHERE branch='$branch' AND(company='$company') AND (applydate BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
echo $query;
}
if($_POST['company']!="Select Company" && $_POST['branch']=="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM jobs WHERE company='$company' AND (applydate BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']!="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM jobs WHERE branch='$branch'  AND (applydate BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']=="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM jobs WHERE applydate BETWEEN '" . $start . "' AND  '" . $end . "'
ORDER by id DESC";
}
}
else{

if($_POST['company']!="Select Company" && $_POST['branch']!="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM jobs WHERE branch='$branch' AND(company='$company') 
ORDER by id DESC";
}
if($_POST['company']!="Select Company" && $_POST['branch']=="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM jobs WHERE company='$company' 
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']!="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM jobs WHERE branch='$branch'  
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']=="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="nothing to be selected :V";
}
  
}


$run=$con->query($query);
if($run->num_rows>0){
  echo "<h5>Total Results: <b><i>".$run->num_rows."</i></b></h5>";
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr class="info" >
                                                <th>Student Name</th>
                                                <th>Roll no</th>
                                                <th>Branch</th>
                                                <th>Aplied Date</th>
                                                <th>Company</th>
                                                
                                               
                                                <th>Status</th>
                                                <th>Message</th>
                                                
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){
  $rollno=$row['student'];
  $query='SELECT firstname,lastname FROM students where rollno="'.$rollno.'"';
  $run1=$con->query($query);
$row1=$run1->fetch_assoc();

  echo "<tr><td>".$row1['firstname']." ".$row1['lastname']."</td><td>".$row['student']."</th><td>".$row['branch']."</td><td>".$row['applydate']."</td><td>".$row['company']."</td>";
if($row['placed']=="yes")
  echo "<td>Placed on ".$row['placeddate']."</td>";
else
  echo "<td>Not yet placed</td>";




  echo '<td><a href="http://localhost:12/placements/admin/messaging?sid='.$row['id'].'"><button class="btn btn-default btn-xs">Send msg</button></td>';
  
  

  echo "</tr>";

}
echo "</tbody></table> <hr></div>";
}
else
  echo'<h5 align="center"> No Results Found.</h5>';

}

if(isset($_POST['placedsub'])){
  if($_POST['datefilter']!=""){
$a=$_POST['datefilter'];
$start= trim(substr($a,0,10));
$end= trim(substr($a,15,10));
if($_POST['company']!="Select Company" && $_POST['branch']!="Select Branch"){
 
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM placedstudents WHERE branch='$branch' AND(company='$company') AND (placeddate BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";

}
if($_POST['company']!="Select Company" && $_POST['branch']=="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM placedstudents WHERE company='$company' AND (placeddate BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']!="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM placedstudents WHERE branch='$branch'  AND (placeddate BETWEEN '" . $start . "' AND  '" . $end . "')
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']=="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM placedstudents WHERE placeddate BETWEEN '" . $start . "' AND  '" . $end . "'
ORDER by id DESC";
}
}
else{

if($_POST['company']!="Select Company" && $_POST['branch']!="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM placedstudents WHERE branch='$branch' AND(company='$company') 
ORDER by id DESC";
}
if($_POST['company']!="Select Company" && $_POST['branch']=="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM placedstudents WHERE company='$company' 
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']!="Select Branch"){
  $company=$_POST['company'];
  $branch=$_POST['branch'];
 $query="SELECT * FROM placedstudents WHERE branch='$branch'  
ORDER by id DESC";
}
if($_POST['company']=="Select Company" && $_POST['branch']=="Select Branch"){
  $gender=$_POST['gender'];
  $branch=$_POST['branch'];
 $query="nothing to be selected :V";
}
  
}


$run=$con->query($query);
if($run->num_rows>0){
  echo "<h5>Total Results: <b><i>".$run->num_rows."</i></b></h5>";
echo' <div class="table-responsive">
 <table class="table table-hover">
   <thead>
                                            <tr class="info" >
                                                <th>Student Name</th>
                                                
                                                <th>Branch</th>
                                                <th>Placed Date</th>
                                                <th>Company</th>
                                                
                                               
                                                <th>Salary</th>
                                                <th>Message</th>
                                                
                                            </tr>
                                            </thead></div></div>
                                            <tbody style="font-style: normal;">';
while($row=$run->fetch_assoc()){


  echo "<tr><td>".$row['student']."</td><td>".$row['branch']."</td><td>".$row['placeddate']."</td><td>".$row['company']."</td><td>".$row['salary']." Lakhs</td>";





  echo '<td><a href="http://localhost:12/placements/admin/messaging?sid='.$row['id'].'"><button class="btn btn-default btn-xs">Send msg</button></td>';
  
  

  echo "</tr>";

}
echo "</tbody></table> <hr></div>";
}
else
  echo'<h5 align="center"> No Results Found.</h5>';

}

		?>
		</div>
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
<script type="text/javascript">
$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {}
 $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,

      locale: {
          cancelLabel: 'Clear'
      },
	         startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
  }, cb);
 cb(start, end);
  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to  ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>



  </body>
</html>
