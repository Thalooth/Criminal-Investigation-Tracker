<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:/CIT/modules/admin/adminlogin.php"); 
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Add Officer</title>  
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
<center><h1>ADD NEW OFFICER</h1></center>
<h3>Enter Officer Details</h3>  
<form action="" method="POST" enctype="multipart/form-data">  
<table>
<tr><td align="right">Name: </td><td align="left"><input type="text" name="name" autocomplete="off" required></td></tr>
<tr><td align="right">Address: </td><td align="left"><input type="text" name="address" autocomplete='off' required></td></tr>
<tr><td align="right">Phone: </td><td align="left"><input type="text" name="phone" autocomplete='off' required></td></tr>
<tr><td align="right">Email: </td><td align="left"><input type="text" name="email" autocomplete='off' required></td></tr>
<tr><td align="right">Location: </td><td align="left"><input type="text" name="loc" autocomplete='off' required></td></tr>
<tr><td align="right"><label for="img">Select image:</label></td>
<td align="left"><input type="file" name="uploadfile" accept="image/*" onchange="loadFile(event)" /></td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Submit" name="submit" /></td></tr>
</table>
<img id="output"/ width="25%"><br/>
</form> 

<?php  
if(isset($_POST["submit"])){ 
$officer_name=$_POST['name'];  
$address=$_POST['address'];  
$phone=$_POST['phone'];  
$email=$_POST['email'];
$location=$_POST['loc'];  
$name = $_FILES['uploadfile']['name'];
$target_dir = "../uploads/officer/";
$target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    exit("Sorry, only JPG, JPEG & PNG files are allowed.");
}
$temp = explode(".", $_FILES["uploadfile"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("INSERT INTO officer(name,address,phone,email,location,image_name,date) VALUES('$officer_name','$address','$phone','$email','$location','$newfilename',now())");
if($result===false)
echo "failed";
else{
if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], "../uploads/officer/" . $newfilename)){}
else
echo "not moved";
$date = date('Y-m-d H:i:s');
$us=$_SESSION['sess_user'];
$details="Name: ".$officer_name."\nPhone: ".$phone."\nEmail ID: ".$email."\nAddress: ".$address."\nLocation: ".$location;
$action="New Officer Added";
$sql="INSERT INTO history(user,action,details,timestamp) VALUES('$us','$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "History updation failed";
}
}
mysqli_close($conn);
echo "<br />Officer added succesfully";
} 
}
?>  
</body>  
</html>   