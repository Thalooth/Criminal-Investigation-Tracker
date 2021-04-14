<!doctype html>  
<html>  
<head>  
<title>Admin Login</title>  
<style>
.leftbox{
  float:left;
  width:50%;
}
.rightbox{
  float:right;
  width:50%;
}
</style>
<link rel="stylesheet" href="/cit/modules/style.css" /> 
</head>  
<body>  
<center><h1>ADMIN LOGIN</h1></center> 
<center><a style="color: grey;" href="register.php">Register</a> | <a style="color: grey;" href="adminlogin.php">Login</a></center> 
<div class='leftbox'>
<h3>Enter your name and password</h3>  
<form action="" method="POST">  
<table>
<tr><td align="right">Username:</td> <td align="left"><input type="text" name="user" required></td></tr>
<tr><td align="right">Password:</td> <td align="left"><input type="password" name="pass" required></td></tr>   
<tr><td align="right"></td><td align="left"><input type="submit" value="Login" name="submit" /></td></tr>
</table> 
</form>  
</div>
<div class='rightbox' style="border: 1px; border-color: green;">
    <img src="/cit/modules/images/admin.png" align="right" width='200px'>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<center><a style="color: rgb(31, 97, 0);" href="/cit/modules/index.html">Back</a></center>
<?php  
if(isset($_POST["submit"])){ 
$user=$_POST['user'];  
$pass=md5($_POST['pass']);  
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("SELECT * FROM admin WHERE name='".$user."' AND password='".$pass."'");  
$numrows=$result->num_rows;  
if($numrows!=0)  
{  
while($row = $result -> fetch_array(MYSQLI_ASSOC))  
{  
$dbusername=$row['name'];  
$dbpassword=$row['password'];  
}  
if($user == $dbusername && $pass == $dbpassword)  
{  
session_start();  
$_SESSION['sess_user']=$user;  
/* Redirect browser */  
header("Location: admindashboard.php");  
}  
} 
else {  
echo "Invalid username or password!";  
} 
mysqli_free_result($result);
mysqli_close($conn); 
}  
?>  
</body>  
</html>   