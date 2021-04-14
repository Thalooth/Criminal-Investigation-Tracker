<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:officerlogin.php");  
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Edit Account</title>  
<link rel="stylesheet" href="/cit/modules/style.css" /> 
</head>  
<body > 
<center><h1>Change Password</h1></center>
<form action="" method="POST">
<table>
<tr><td align="right">Old Password: </td><td align="left"><input type='password' name='oldpass'></td></tr>
<tr><td align="right">New Password: </td><td align="left"><input type='password' name='newpass'></td></tr>
<tr><td align="right">Confirm Password: </td><td align="left"><input type='password' name='conpass'></td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Submit" name="submit" /></td></tr>
</table>
</form>
</body>
</html>

<?php
if(isset($_POST["submit"])){  
$oldpass=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$conpass=$_POST['conpass'];
if($conpass!=$newpass){
    exit("Passwords do not match");
}
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$officer_id=$_SESSION['sess_user'];
$case_id=$_SESSION['sess_case'];
$result=$conn->query("SELECT * FROM officer_assignment WHERE officer_id='".$officer_id."' and case_id='".$case_id."'");
if($result===false)
echo "failed";
else{
$row = $result->fetch_assoc();
$dbpass=$row['password'];
if(md5($oldpass)!=$dbpass){
    exit("Invalid password!");
}
$newpass=md5($newpass);
$result=$conn->query("UPDATE officer_assignment SET password='".$newpass."' WHERE officer_id='".$officer_id."'");
if($result===false)
echo "failed";
else{
echo "<br/>Password updated successfully";
$date = date('Y-m-d H:i:s');
$details="Officer ID: ".$officer_id."\nCase_id: ".$case_id;
$action="Account Password Updated";
$sql="INSERT INTO history(user,action,details,timestamp) VALUES('$officer_id','$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "<br />History updation failed";
mysqli_close($conn);
}
}
}
}
}
?>