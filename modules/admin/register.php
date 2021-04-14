<!doctype html>  
<html>  
<head>  
<title>Register</title>  
<link rel="stylesheet" href="/cit/modules/style.css" /> 
</head>  
<body>  

<center><h1>CREATE REGISTRATION AND LOGIN FORM USING PHP AND MYSQL</h1></center>  
<p><a href="register.php">Register</a> | <a href="adminlogin.php">Login</a></p>  
<center><h2>Registration Form</h2></center>  
<form action="" method="POST">  
<legend>  
<fieldset>  
<table>
<tr><td align="right">Name:</td> <td align="left"><input type="text" name="user" required></td></tr> 
<tr><td align="right">Phone:</td> <td align="left"><input type="int" name="phone" required></td></tr>
<tr><td align="right">Email id:</td> <td align="left"><input type="text" name="email" required></td></tr>
<tr><td align="right">Password:</td> <td align="left"> <input type="password" name="pass" required></td></tr>  
<tr><td align="right">Retype Password:</td> <td align="left"> <input type="password" name="rpass" required></td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Submit" name="submit" /></td></tr>
</table>  
</fieldset>  
</legend>  
</form>  
<?php  
if(isset($_POST["submit"])){
$user=$_POST['user']; 
$phone=$_POST['phone'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$rpass=$_POST['rpass']; 
if($pass!=$rpass){
    exit("Both passwords should be same!");
} 
$conn=new mysqli('localhost','root','','cit') ;
if ($conn -> connect_errno) {
echo "Failed to connect to MySQL: " . $conn -> connect_error;
exit();
} 

$sql="INSERT INTO admin(name,date,phone,email,password) VALUES('$user',now(),'$phone','$email','$pass')";  
$result = $conn->query("SELECT * FROM admin WHERE name='".$user."'");
if($result===false)
echo "error";
if ($result->num_rows==0) 
{
$result=$conn->query($sql);
if ($result){
echo "Account Successfully Created";  
$date = date('Y-m-d H:i:s');
$details="Name:".$user."\nPhone:".$phone."\nEmail ID:".$email;
$action="New Admin Registered";
$sql="INSERT INTO history(user,action,details,timestamp) VALUES(0,'$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "History updation failed";
}
} 
}
else 
echo "That username already exists! Please try again with another.";
mysqli_close($conn);
}
?>  
</body>
</html>