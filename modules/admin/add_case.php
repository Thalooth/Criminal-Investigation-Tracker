<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:/CIT/modules/admin/adminlogin.php");  
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Add Case</title>
<link rel="stylesheet" href="/cit/modules/style.css" />  
</head>  
<body >  
<center><h1>ADD NEW CASE</h1></center>
<h3>Enter Case Details</h3>
<form action="" method="POST">  
<table>
    <tr>
    <td align="right">Case name: </td><td align="left"><input type="text" name="cname" required></td>
</tr>
    <tr><td align="right">Case Description:</td><td align="left"><textarea name="desc" rows="10" cols="50">Write the description of the case here...</textarea></td></tr>
    <tr><td align="right">Status: </td><td align="left"><input type="text" name="stat" required></td></tr>
<tr><td align="right">Registered date: </td><td align="left"><input type="text" name="date" required></td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Submit" name="submit" /></td></tr>
</table>
</form>  

<?php  
if(isset($_POST["submit"])){
$case_name=$_POST['cname'];  
$description=$_POST['desc'];  
$status=$_POST['stat'];  
$date=$_POST['date'];
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("INSERT INTO cases(case_name,description,status,date) VALUES('$case_name','$description','$status','$date')");
if($result===false)
echo "failed";
else{
$date = date('Y-m-d H:i:s');
$us=$_SESSION['sess_user'];
$details="Case name:".$case_name."\nStatus:".$status;
$action="New Case Added";
$sql="INSERT INTO history(user,action,details,timestamp) VALUES('$us','$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "History updation failed";
}
mysqli_close($conn);
echo "Case added succesfully";
}
} 
}
?>  

</body>  
</html>   