<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:officerlogin.php");  
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Account</title>  
<link rel="stylesheet" href="/cit/modules/style.css" /> 
<style>  
.center {

  margin-left: auto;
  margin-right: auto;
}
.leftbox{
  float:left;
  width:70%;
}
.rightbox{
  float:right;
  width:30%;
}
a {
  border: dashed darkgreen;
  background-color: black;
  color: darkgreen;
  padding: 5px 5px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
</style>  
</head>  
<body > 
<center><h1>Account Details</h1></center>
</body>
</html>

<?php
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$officer_id=$_SESSION['sess_user'];
$result=$conn->query("SELECT * FROM officer WHERE id='".$officer_id."'");
if($result===false)
echo "failed";
else{
$row = $result->fetch_assoc();
$imgname=$row['image_name'];
$dirname="../uploads/officer/";
echo "<div class='rightbox'><img src=".$dirname.$imgname." alt='Not working!' width='200px'/></div>";
echo "<div class='leftbox'><br/><table class='center'>
<tr><td align='right'>Name:</td><td align='left'>".$row['name']. "</td></tr>
<tr><td align='right'>Officer ID:</td><td align='left'>".$row['id']. "</td></tr>
<tr><td align='right'>Email ID:</td><td align='left'>".$row['email']. "</td></tr>
<tr><td align='right'>Phone:</td><td align='left'>".$row['phone']. "</td></tr>
<tr><td align='right'>Address:</td><td align='left'>".$row['address']. "</td></tr>
<tr><td align='right'>Location:</td><td align='left'>".$row['location']. "</td></tr>
<tr><td></td><td></td></tr>
</table></div>";
}
echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><center><a href='edit_password.php'>Change Password</a></center>";
mysqli_free_result($result);
mysqli_close($conn);
}
?>
