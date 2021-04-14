<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:/CIT/modules/admin/adminlogin.php"); 
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Add Suspect</title>  
<link rel="stylesheet" href="/cit/modules/style.css" />  
<script>
var loadFile = function(event) {
var output = document.getElementById('output');
output.src = URL.createObjectURL(event.target.files[0]);
output.onload = function() {
URL.revokeObjectURL(output.src) // free memory
}
};
</script>
</head>  
<body >  
<center><h1>ADD NEW SUSPECT</h1></center>
<h3>Enter Suspect Details</h3>  
<form action="" method="POST" enctype="multipart/form-data">  
<table>
<tr><td align="right">Name: </td><td align="left"><input type="text" name="name" autocomplete="off" required></td></tr>
<tr><td align="right">Date Of Birth: </td><td align="left"><input type="date" name="dob" min="1900-01-01" max="2020-01-01" autocomplete='off'></td></tr>
<tr><td align="right">Gender: </td><td align="left"><select  name='sex'><option value='male'>Male</option><option value='female'>Female</option><option value='other'>Other</option></td></tr>
<tr><td align="right">Description:</td><td align="left"><textarea name="desc" rows="10" cols="50">Write the description of the suspect here...</textarea></td></tr>
<tr><td align="right"><label for="img">Select image:</label></td>
<td align="left"><input type="file" name="uploadfile" accept="image/*" onchange="loadFile(event)" /></td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Submit" name="submit" /></td></tr>
</table>
<img id="output"/ width="25%"><br/>
</form> 

<?php  
if(isset($_POST["submit"])){ 
$suspect_name=$_POST['name'];  
$dob=$_POST['dob'];  
$sex=$_POST['sex'];  
$desc=$_POST['desc'];
$name = $_FILES['uploadfile']['name'];
$target_dir = "../uploads/criminal/";
$target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    exit("Sorry, only JPG, JPEG & PNG files are allowed.");
}
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$temp = explode(".", $_FILES["uploadfile"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$result=$conn->query("INSERT INTO criminal(name,dob,description,sex,image_name) VALUES('$suspect_name','$dob','$desc','$sex','$newfilename')");
if($result===false)
echo "failed";
else{
if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "../uploads/criminal/" . $newfilename)){}
else
echo "not moved!";
$date = date('Y-m-d H:i:s');
$us=$_SESSION['sess_user'];
$details="Name: ".$suspect_name."\nDate of birth: ".$dob."\nGender: ".$sex;
$action="New Suspect Added";
$sql="INSERT INTO history(user,action,details,timestamp) VALUES('$us','$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "History updation failed";
}
}
mysqli_close($conn);
echo "<br />Suspect added succesfully";
} 
}
?>  
</body>  
</html>   