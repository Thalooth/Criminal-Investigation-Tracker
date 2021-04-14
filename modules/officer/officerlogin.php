<!doctype html>  
<html>  
<head>  
<title>Officer Login</title>  
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
<center><h1>OFFICER LOGIN</h1></center>  
<div class='leftbox'>
<h3>Enter your name and password</h3>  
<form action="" method="POST">  
<table>
<tr><td align="right">Case ID:</td><td align="left"><input type="text" name="case_id" autocomplete='off' required></td></tr>
<tr><td align="right">User ID:</td><td align="left"><input type="text" name="user" autocomplete='off' required></td></tr>
<tr><td align="right">Password:</td><td align="left"><input type="password" name="pass" required></td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Login" name="submit" /></td></tr>
</table>
</form>  
</div>
<div class='rightbox'>
<img src="/cit/modules/images/officer.png" align="right" width='200px'>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<center><a style="color: rgb(31, 97, 0);" href="/cit/modules/index.html">Back</a></center>

<?php  
if(isset($_POST["submit"])){  
$case_id=$_POST['case_id'];
$user=$_POST['user'];  
$pass=md5($_POST['pass']);  
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("SELECT * FROM officer_assignment WHERE officer_id='".$user."' AND password='".$pass."' AND case_id='".$case_id."'");  
$numrows=$result->num_rows;  
if($numrows!=0)  
{  
while($row = $result -> fetch_array(MYSQLI_ASSOC))  
{  
$dbusername=$row['officer_id'];  
$dbpassword=$row['password']; 
$dbcaseid=$row['case_id']; 
}  
if($user == $dbusername && $pass == $dbpassword && $dbcaseid== $case_id)  
{  
$result=$conn->query("SELECT * FROM officer WHERE id='".$user."'");  
$row=$result->fetch_assoc();
$name=$row['name'];
$date = date('Y-m-d H:i:s');
$action="Officer Login";
$details="Name: ".$name." \nOfficer id:".$user."\nCase ID:".$case_id;
$sql="INSERT INTO history(user,action,details,timestamp) VALUES(0,'$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "History updation failed";
}
session_start();  
$_SESSION['sess_user']=$user;  
$_SESSION['sess_case']=$case_id;
/* Redirect browser */  
header("Location: officerdashboard.php");  
}  
} 
else {  
echo "Invalid credentials!";  
}
mysqli_close($conn);
}  
?>  
</body>  
</html>   