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
          <a class="navbar-brand" href="dashboard">Placement Management</a>
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
	<div id="studentdashboard" class="panel panel-primary">
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
	<div id="studentdashboard" class="panel panel-primary">
  <div class="panel-heading">
  <h1 align="center"class="panel-title">Update Profile</h1></div>
  <div class="panel-body">
  <?php
  	  $host="localhost";
$user="root";
$password="";
$db_name="placements";
$con=mysqli_connect($host,$user,$password,$db_name);
	 $query="SELECT * FROM students WHERE rollno='".$_SESSION['user']."'";
$run = $con->query($query);
$row=mysqli_fetch_assoc($run);

  ?>
      <div class="row"  > 
<div class="col-sm-6">
<h2  align="center" class="lead" style="color:#337AB7;"> General Details</h2><hr>
 <label>Rollno : <?php echo $row['rollno'];?></label>
 <label>Branch : <?php echo $row['branch'];?></label>
 <?php
if(isset($_POST['isubmit'])){
$name= $_FILES["myfile"]["name"];
$type= $_FILES["myfile"]["type"];
$size= $_FILES["myfile"]["size"];
$temp= $_FILES["myfile"]["tmp_name"];
$error= $_FILES["myfile"]["error"];
if($error>0)
  echo "Error uploading file Try Again";
else{
  if($type=="image/jpeg"||$type=="image/png"){
move_uploaded_file($temp, 'images/'.$_SESSION['user'].'.jpg');
 
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> Image has been uploaded
</div>';

}
else{

echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> please upload jpeg or png image
</div>';
}
}
}


 if(isset($_POST['submit'])){
$firstname=$_POST['fname'];
$lastname=$_POST['lname'];
$email=$_POST['email'];
$gender=$_POST['gende'];
echo $gender;
$dob=$_POST['dob'];
$contactno=$_POST['phone'];
$address=$_POST['address'];
$city=$_POST['city'];
$state=$_POST['state'];
$postalcode=$_POST['postalcode'];
if(strlen($postalcode)!=5 ){
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Your Postalcode must be exactly 5 digits;
</div>';
}
if(strlen($contactno)!=10 ){
echo '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Your Contactno must be exactly 10 digits;
</div>';
}
if(strlen($contactno)==10 && strlen($postalcode)==5 ){

$query="UPDATE students SET firstname='$firstname', lastname='$lastname', contactno='$contactno',email='$email',gender='$gender', dob='$dob', address='$address', city='$city', state='$state',postalcode='$postalcode' WHERE rollno='".$row['rollno']."'";
$run=$con->query($query);
if($run){
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Your General Details has been updated.  
</div>';}
 }}
 if(isset($_POST['ssubmit'])){
 $skills=$_POST['skills'];

 $hobbies=$_POST['hobbies'];


 $query="UPDATE students SET skills='$skills', hobbies='$hobbies' WHERE rollno='".$row['rollno']."'";
$run=$con->query($query);
if($run){
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Your skills and hobbies has been updated.  
</div>';}
 }
  if(isset($_POST['psubmit'])){
 $nationality=$_POST['nationality'];
 
 $father=$_POST['father'];
 $languages=$_POST['languages'];
 $marital=$_POST['marital'];

 $query="UPDATE students SET nationality='$nationality', fathername='$father', languages='$languages', martialstatus='$marital'  WHERE rollno='".$row['rollno']."'";
$run=$con->query($query);
if($run){
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Your Personal Details has been updated.  
</div>';}
 }
 
 if(isset($_POST['asubmit'])){
 $tenth=$_POST['10th'];
 $inter=$_POST['inter'];
 $engineering=$_POST['engineering'];

 $query="UPDATE students SET 10th='$tenth', inter='$inter', engineering='$engineering'  WHERE rollno='".$row['rollno']."'";
$run=$con->query($query);
if($run){
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Your Academic Details has been updated.  
</div>';}
 }
 if(isset($_POST['pasubmit'])){
 $old=$_POST['old'];
 $new=$_POST['new'];
 $conform=$_POST['conform'];
	 $query="SELECT password FROM students WHERE rollno='".$_SESSION['user']."'";
$run = $con->query($query);
$row1=mysqli_fetch_assoc($run);
if(sha1($old)==$row1['password']&&$new==$conform){
$new=sha1($new);
 $query="UPDATE students SET password='$new'  WHERE rollno='".$row['rollno']."'";
$run=$con->query($query);
if($run){
echo '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Well done!</strong> Your Password has been updated.  
</div>';}
}

 }
 ?>
  <div class="thumbnail">
<?php
  echo'<img src="images/'.$_SESSION['user'].'.jpg" alt="Choose File and Select image to upload">';
      ?>
      <div class="caption">
    <form action="profile" method="post" enctype="multipart/form-data">
  <div class="form-group ">
  <div class="row">
  <div class="col-sm-6">
      <input  type="file" name="myfile" >
</div>
<div class="col-sm-6">
<input  class="btn btn-sm btn-primary pull-right" type="submit"  value="Upload Image" name="isubmit">

    </div></div>
    </div>
</form>
      </div>
    </div>

<form action="profile" method="post">
<div class="form-group ">
 <label >First Name</label>
 <input class="form-control"  name="fname" required placeholder="Your name" type="text" value="<?php echo $row['firstname'];?>"/>
</div>
 <div class="form-group ">
 <label >Last Name</label>
<input class="form-control" name="lname" required placeholder="Your last name" type="text" value="<?php echo $row['lastname'];?>"/>
</div>
  <div class="form-group ">
<label >Email</label>
<input class="form-control" name="email" required placeholder="Your email address" type="email" value="<?php echo $row['email'];?>"/>
</div>

<div class="form-group ">
<label >Gender</label>
<select class="select form-control"  name="gende">
 <option>Select</option>
<option value="Male" >Male</option>
<option value="Female" >Female</option>
 </select>
</div>
  <div class="form-group ">
<label>DOB</label>
<input class="form-control" required name="dob" placeholder="MM/DD/YYYY" type="date" value=""/>
 </div>
 <div class="form-group ">
 <label >Mobile Number</label>
 <input class="form-control" required name="phone" placeholder="Your mobile number" type="number" value="<?php echo $row['contactno'];?>"/>
 </div>
 <div class="form-group ">
<label >Address</label>
 <textarea class="form-control"  required cols="10"  name="address" placeholder="Enter your Address" rows="5" ><?php echo $row['address'];?></textarea>
</div>
<div class="form-group ">
 <label class="control-label " >City</label>
 <input class="form-control" required name="city" type="text" placeholder="Enter your city" value="<?php echo $row['city'];?>" />
 </div>
	<div class="form-group ">
 <label class="control-label " >State</label>
<select class="select form-control" id="state" name="state">
                                        <option value="">Please Select</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Andhra Pradesh" >Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chandigarh">Chandigarh</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
                                        <option value="Daman and Diu">Daman and Diu</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Lakshadweep">Lakshadweep</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Manipur">Manipur</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Nagaland">Nagaland</option>
                                        <option value="Orissa">Orissa</option>
                                        <option value="Pondicherry">Pondicherry</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana" >Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttaranchal">Uttaranchal</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                
 </div>
	   <div class="form-group ">
                                    <label >Postal Code</label>
                                    <input class="form-control" required  name="postalcode" type="number" value="<?php echo $row['postalcode'];?>"/>
                                </div>
        <br><button class="btn btn-sm btn-primary btn-block" name="submit" type="submit">Update</button>
      </form><hr>
<h2 align="center"class="lead" style="color:#337AB7;"> Skills & Hobbies</h2><hr>	  
<form action="profile" method="post">
 <div class="form-group ">
<label >Skills</label>
 <textarea class="form-control"  required cols="10"  name="skills" placeholder="Enter your Skills" rows="5" ><?php echo $row['skills'];?></textarea>
</div>
 <div class="form-group ">
<label >Hobbies</label>
 <textarea class="form-control"  required cols="10"  name="hobbies" placeholder="Enter your Hobbies" rows="5" ><?php echo $row['hobbies'];?></textarea>
</div>
<button class="btn btn-sm btn-primary btn-block" name="ssubmit" type="submit">Update</button>
</form>

</div>
<div class="col-sm-6">
<h2 align="center"class="lead" style="color:#337AB7;"> Personal Details</h2><hr>
<form action ="profile" method="post">
  <div class="form-group "><br>
                                    <label class="control-label " >
                                        Nationality
                                    </label>
									 <select class="select form-control"  name="nationality">

                                        <option>Select</option>
                                        <option value="afghan">Afghan</option>
                                        <option value="albanian">Albanian</option>
                                        <option value="algerian">Algerian</option>
                                        <option value="american">American</option>
                                        <option value="andorran">Andorran</option>
                                        <option value="angolan">Angolan</option>
                                        <option value="antiguans">Antiguans</option>
                                        <option value="argentinean">Argentinean</option>
                                        <option value="armenian">Armenian</option>
                                        <option value="australian">Australian</option>
                                        <option value="austrian">Austrian</option>
                                        <option value="azerbaijani">Azerbaijani</option>
                                        <option value="bahamian">Bahamian</option>
                                        <option value="bahraini">Bahraini</option>
                                        <option value="bangladeshi">Bangladeshi</option>
                                        <option value="barbadian">Barbadian</option>
                                        <option value="barbudans">Barbudans</option>
                                        <option value="batswana">Batswana</option>
                                        <option value="belarusian">Belarusian</option>
                                        <option value="belgian">Belgian</option>
                                        <option value="belizean">Belizean</option>
                                        <option value="beninese">Beninese</option>
                                        <option value="bhutanese">Bhutanese</option>
                                        <option value="bolivian">Bolivian</option>
                                        <option value="bosnian">Bosnian</option>
                                        <option value="brazilian">Brazilian</option>
                                        <option value="british">British</option>
                                        <option value="bruneian">Bruneian</option>
                                        <option value="bulgarian">Bulgarian</option>
                                        <option value="burkinabe">Burkinabe</option>
                                        <option value="burmese">Burmese</option>
                                        <option value="burundian">Burundian</option>
                                        <option value="cambodian">Cambodian</option>
                                        <option value="cameroonian">Cameroonian</option>
                                        <option value="canadian">Canadian</option>
                                        <option value="cape verdean">Cape Verdean</option>
                                        <option value="central african">Central African</option>
                                        <option value="chadian">Chadian</option>
                                        <option value="chilean">Chilean</option>
                                        <option value="chinese">Chinese</option>
                                        <option value="colombian">Colombian</option>
                                        <option value="comoran">Comoran</option>
                                        <option value="congolese">Congolese</option>
                                        <option value="costa rican">Costa Rican</option>
                                        <option value="croatian">Croatian</option>
                                        <option value="cuban">Cuban</option>
                                        <option value="cypriot">Cypriot</option>
                                        <option value="czech">Czech</option>
                                        <option value="danish">Danish</option>
                                        <option value="djibouti">Djibouti</option>
                                        <option value="dominican">Dominican</option>
                                        <option value="dutch">Dutch</option>
                                        <option value="east timorese">East Timorese</option>
                                        <option value="ecuadorean">Ecuadorean</option>
                                        <option value="egyptian">Egyptian</option>
                                        <option value="emirian">Emirian</option>
                                        <option value="equatorial guinean">Equatorial Guinean</option>
                                        <option value="eritrean">Eritrean</option>
                                        <option value="estonian">Estonian</option>
                                        <option value="ethiopian">Ethiopian</option>
                                        <option value="fijian">Fijian</option>
                                        <option value="filipino">Filipino</option>
                                        <option value="finnish">Finnish</option>
                                        <option value="french">French</option>
                                        <option value="gabonese">Gabonese</option>
                                        <option value="gambian">Gambian</option>
                                        <option value="georgian">Georgian</option>
                                        <option value="german">German</option>
                                        <option value="ghanaian">Ghanaian</option>
                                        <option value="greek">Greek</option>
                                        <option value="grenadian">Grenadian</option>
                                        <option value="guatemalan">Guatemalan</option>
                                        <option value="guinea-bissauan">Guinea-Bissauan</option>
                                        <option value="guinean">Guinean</option>
                                        <option value="guyanese">Guyanese</option>
                                        <option value="haitian">Haitian</option>
                                        <option value="herzegovinian">Herzegovinian</option>
                                        <option value="honduran">Honduran</option>
                                        <option value="hungarian">Hungarian</option>
                                        <option value="icelander">Icelander</option>
                                        <option value="indian" >Indian</option>
                                        <option value="indonesian">Indonesian</option>
                                        <option value="iranian">Iranian</option>
                                        <option value="iraqi">Iraqi</option>
                                        <option value="irish">Irish</option>
                                        <option value="israeli">Israeli</option>
                                        <option value="italian">Italian</option>
                                        <option value="ivorian">Ivorian</option>
                                        <option value="jamaican">Jamaican</option>
                                        <option value="japanese">Japanese</option>
                                        <option value="jordanian">Jordanian</option>
                                        <option value="kazakhstani">Kazakhstani</option>
                                        <option value="kenyan">Kenyan</option>
                                        <option value="kittian and nevisian">Kittian and Nevisian</option>
                                        <option value="kuwaiti">Kuwaiti</option>
                                        <option value="kyrgyz">Kyrgyz</option>
                                        <option value="laotian">Laotian</option>
                                        <option value="latvian">Latvian</option>
                                        <option value="lebanese">Lebanese</option>
                                        <option value="liberian">Liberian</option>
                                        <option value="libyan">Libyan</option>
                                        <option value="liechtensteiner">Liechtensteiner</option>
                                        <option value="lithuanian">Lithuanian</option>
                                        <option value="luxembourger">Luxembourger</option>
                                        <option value="macedonian">Macedonian</option>
                                        <option value="malagasy">Malagasy</option>
                                        <option value="malawian">Malawian</option>
                                        <option value="malaysian">Malaysian</option>
                                        <option value="maldivan">Maldivan</option>
                                        <option value="malian">Malian</option>
                                        <option value="maltese">Maltese</option>
                                        <option value="marshallese">Marshallese</option>
                                        <option value="mauritanian">Mauritanian</option>
                                        <option value="mauritian">Mauritian</option>
                                        <option value="mexican">Mexican</option>
                                        <option value="micronesian">Micronesian</option>
                                        <option value="moldovan">Moldovan</option>
                                        <option value="monacan">Monacan</option>
                                        <option value="mongolian">Mongolian</option>
                                        <option value="moroccan">Moroccan</option>
                                        <option value="mosotho">Mosotho</option>
                                        <option value="motswana">Motswana</option>
                                        <option value="mozambican">Mozambican</option>
                                        <option value="namibian">Namibian</option>
                                        <option value="nauruan">Nauruan</option>
                                        <option value="nepalese">Nepalese</option>
                                        <option value="new zealander">New Zealander</option>
                                        <option value="ni-vanuatu">Ni-Vanuatu</option>
                                        <option value="nicaraguan">Nicaraguan</option>
                                        <option value="nigerien">Nigerien</option>
                                        <option value="north korean">North Korean</option>
                                        <option value="northern irish">Northern Irish</option>
                                        <option value="norwegian">Norwegian</option>
                                        <option value="omani">Omani</option>
                                        <option value="pakistani">Pakistani</option>
                                        <option value="palauan">Palauan</option>
                                        <option value="panamanian">Panamanian</option>
                                        <option value="papua new guinean">Papua New Guinean</option>
                                        <option value="paraguayan">Paraguayan</option>
                                        <option value="peruvian">Peruvian</option>
                                        <option value="polish">Polish</option>
                                        <option value="portuguese">Portuguese</option>
                                        <option value="qatari">Qatari</option>
                                        <option value="romanian">Romanian</option>
                                        <option value="russian">Russian</option>
                                        <option value="rwandan">Rwandan</option>
                                        <option value="saint lucian">Saint Lucian</option>
                                        <option value="salvadoran">Salvadoran</option>
                                        <option value="samoan">Samoan</option>
                                        <option value="san marinese">San Marinese</option>
                                        <option value="sao tomean">Sao Tomean</option>
                                        <option value="saudi">Saudi</option>
                                        <option value="scottish">Scottish</option>
                                        <option value="senegalese">Senegalese</option>
                                        <option value="serbian">Serbian</option>
                                        <option value="seychellois">Seychellois</option>
                                        <option value="sierra leonean">Sierra Leonean</option>
                                        <option value="singaporean">Singaporean</option>
                                        <option value="slovakian">Slovakian</option>
                                        <option value="slovenian">Slovenian</option>
                                        <option value="solomon islander">Solomon Islander</option>
                                        <option value="somali">Somali</option>
                                        <option value="south african">South African</option>
                                        <option value="south korean">South Korean</option>
                                        <option value="spanish">Spanish</option>
                                        <option value="sri lankan">Sri Lankan</option>
                                        <option value="sudanese">Sudanese</option>
                                        <option value="surinamer">Surinamer</option>
                                        <option value="swazi">Swazi</option>
                                        <option value="swedish">Swedish</option>
                                        <option value="swiss">Swiss</option>
                                        <option value="syrian">Syrian</option>
                                        <option value="taiwanese">Taiwanese</option>
                                        <option value="tajik">Tajik</option>
                                        <option value="tanzanian">Tanzanian</option>
                                        <option value="thai">Thai</option>
                                        <option value="togolese">Togolese</option>
                                        <option value="tongan">Tongan</option>
                                        <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                        <option value="tunisian">Tunisian</option>
                                        <option value="turkish">Turkish</option>
                                        <option value="tuvaluan">Tuvaluan</option>
                                        <option value="ugandan">Ugandan</option>
                                        <option value="ukrainian">Ukrainian</option>
                                        <option value="uruguayan">Uruguayan</option>
                                        <option value="uzbekistani">Uzbekistani</option>
                                        <option value="venezuelan">Venezuelan</option>
                                        <option value="vietnamese">Vietnamese</option>
                                        <option value="welsh">Welsh</option>
                                        <option value="yemenite">Yemenite</option>
                                        <option value="zambian">Zambian</option>
                                        <option value="zimbabwean">Zimbabwean</option>

                                    </select>
									</div>
									
<div class="form-group">
<label>Father Name</label>
<input class="form-control" required name="father" placeholder="Your father's name" type="text" value="<?php echo $row['fathername'];?>">
</div>
 <div class="form-group ">
<label >Languages Known</label>
 <textarea class="form-control" required  cols="5"  name="languages" placeholder="Enter the languages separated with commas" rows="5" ><?php echo $row['languages'];?></textarea>
</div>
        <div class="form-group ">
                                    <label >
                                        Marital Status
                                    </label>
                                    <select required class="select form-control" name="marital">
                                        <option>Select</option>
                                        <option value="Married" >Married</option>
                                        <option value="Single" >Single</option>
                                        <option value="Divorced" >Divorced</option>
                                    </select>
                                </div>
<button class="btn btn-sm btn-primary btn-block" name="psubmit" type="submit">Update</button><br>
</form><hr>
<h2 align="center"class="lead" style="color:#337AB7;"> Academic Qualifications</h2><hr>
<form action="profile" method="post">
<div class="form-group">
<label>10th</label>
<input type="number"  required name="10th" placeholder="Enter your 10th percentage" class="form-control" value="<?php echo $row['10th'];?>">
</div>
<div class="form-group">
<label>Intermediate</label>
<input type="number" required name="inter" placeholder="Enter your inter percentage" class="form-control" value="<?php echo $row['inter'];?>">
</div>
<div class="form-group">
<label>Engineering</label>
<input type="number" required name="engineering" placeholder="Percentage upto now" class="form-control" value="<?php echo $row['engineering'];?>">
</div>
<button class="btn btn-sm btn-primary btn-block" name="asubmit" type="submit">Update</button><br><hr>
</form>
<h2 align="center"class="lead" style="color:#337AB7;"> Change Password</h2><hr>
<form action="profile" method="post">
<div class="form-group">
<label>Old password</label>
<input type="text" name="old" required placeholder="Enter your previous password" class="form-control" value="">
</div>
<div class="form-group">
<label>New password</label>
<input type="text" name="new" required placeholder="Enter your new password" class="form-control" value="">
</div>
<div class="form-group">
<label>Conform password</label>
<input type="text" name="conform" required placeholder="Retype your new password" class="form-control" value="">
</div>
<button class="btn btn-sm btn-primary btn-block" name="pasubmit" type="submit">Update</button><br><hr>
</form>
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


   <script src="../includes/jquery.js"></script>
   <script src="../includes/bootstrap.min.js"></script>
  </body>
</html>
