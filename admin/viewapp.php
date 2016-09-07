
<?php
session_start();
if(!isset($_SESSION['id'])){
header("Location:login");
}

require('../fpdf181/fpdf.php');
 $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
if(isset($_GET['user'])){
$job=$_GET['job'];
$job=str_replace("%20"," ",$job);
$company=$_GET['company'];
$rollno=$_GET['user'];
$query='SELECT * FROM students WHERE rollno="'.$rollno.'"';
$run=$con->query($query);
$row=$run->fetch_assoc();
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$branch=$row['branch'];
$contactno=$row['contactno'];
$email=$row['email'];
$gender=$row['gender'];
$dob=$row['dob'];
$address=$row['address'];
$city=$row['city'];
$state=$row['state'];
$postalcode=$row['postalcode'];
$skills=$row['skills'];
$hobbies=$row['hobbies'];
$fathername=$row['fathername'];
$nationality=$row['nationality'];
$languages=$row['languages'];
$martialstatus=$row['martialstatus'];
$tenth=$row['10th'];
$inter=$row['inter'];
$engineering=$row['engineering'];
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','U',20);
$pdf->Cell(0,10,'Resume',0,1,'C');
$pdf->SetFont('Arial','I',12);
$pdf->Cell(0,10,'Job application for '.$job.' post at '.$company,0,1,'C');
$pdf->SetX(25);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Contact Details',0,1,'L');
$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Name : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$firstname.$lastname,0,1,'L');



$pdf->Image("../students/images/".$rollno.".jpg",145,35,45,50);

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Rollno : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$rollno,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Branch : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$branch,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Email : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$email,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Contactno : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$contactno,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Rollno : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$rollno,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'DOB : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$dob,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Address : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$address,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'City / State: ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$city.','.$state.' ('.$postalcode.')',0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'',0,1,'L');

$pdf->SetX(25);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'General Details',0,1,'L');
$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Father Name : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$fathername,0,1,'L');
$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Nationality : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$nationality,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Languages Known : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$languages,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Hobbies : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$hobbies,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'',0,1,'L');


$pdf->SetX(25);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Academics / Skills',0,1,'L');
$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'10th : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$tenth,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Intermediate : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$inter,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Engineernig : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,$engineering,0,1,'L');

$pdf->SetX(35);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Skills : ',0,0,'L');
$pdf->SetX(80);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,10, $skills, 0);

$path=$rollno."_".$job."_".$company.".pdf";
   $pdf->Output('D',$path); 
   echo "your file has been Downloaded";
}

?>