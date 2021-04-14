<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:officerlogin.php");  
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Update Case</title>
<link rel="stylesheet" href="/cit/modules/style.css" />  
</head>  
<body >  
<center><h1>UPDATE CASE</h1></center>
<form action="" method="POST">  
<table>
<tr><td></td><td align="left"><h3>Enter Case Findings</h3></td></tr>
<tr><td align="right">Describe your findings:</td><td align="left"><textarea name="desc" rows="10" cols="50"></textarea></td></tr>
</table>
<br/>
<center><input type="submit" value="Submit" name="submit" /></center>
</form>  

<?php  
if(isset($_POST["submit"])){
$case_id=$_SESSION["sess_case"];
$description=$_POST['desc'];
$user=$_SESSION['sess_user'];
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("INSERT INTO case_updation(case_id,officer_id,description,date) VALUES('$case_id','$user','$description',now())");
if($result===false)
echo "failed";
else{
$date = date('Y-m-d H:i:s');
$us=$_SESSION['sess_user'];
$details="Case ID:".$case_id."\nOfficer ID:".$user."\nDescription:".$description."\nDate:".$date;
$action="Case Update";
$sql="INSERT INTO history(user,action,details,timestamp) VALUES('$us','$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "History updation failed";
}
mysqli_close($conn);
echo "Case Updated succesfully";
}
} 
}
?>  

</body>  
</html>   