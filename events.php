

<?php

   $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
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
	  <div class="col-md-8" >
	<div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Events</h1></div>
  <div class="panel-body">
  <?php
     $query="SELECT COUNT(id) FROM events";
$run = $con->query($query);
$row=mysqli_fetch_array($run);
  $rows=$row[0];
  $pagerows=5;

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
    $query="SELECT * FROM events ORDER BY id DESC $limit ";
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
echo '</ul>';
  echo "page <b>$pagenum</b> of <b>$last</b>";
  echo' <div  class="pull-right pager>'.$pagination.'  </div>';
    ?>   
 </div>

  </div>
  
</div>
	  <div class="col-md-4">
	  <div class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">News</h1></div>
  <div class="panel-body">
  <?php
  echo '<ul class="list-group">';
  $query="SELECT * FROM news ORDER BY id DESC LIMIT 4";
$run=$con->query($query);

while($row=$run->fetch_assoc()){
  
     echo ' <li class="list-group-item list-group-item-info">
    <i style="float:left;font-size:40px;"class="glyphicon glyphicon-bullhorn"></i>';
echo '<h4 class="ntitle">'.$row['title'].'</h4>';
echo ' <p>'.substr($row['content'],0,60).'&#8230;</p>';                     
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