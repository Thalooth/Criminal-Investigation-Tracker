<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:/CIT/modules/admin/adminlogin.php");  
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Update Case Status</title>
<link rel="stylesheet" href="/cit/modules/style.css" />  
</head>  
<body >  
<center><h1>UPDATE CASE STATUS</h1></center>
<form action="" method="POST">  
<table>
    <tr>
    <td align="right">Case ID: </td><td align="left"><input type="text" name="c_id" required></td></tr>
    <tr><td align="right">Status: </td><td align="left"><input type="text" name="stat" required></td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Submit" name="submit" /></td></tr>
</table>
</form>  

<?php  
if(isset($_POST["submit"])){
$case_id=$_POST['c_id'];
$status=$_POST['stat'];
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("UPDATE cases SET status='".$status."' where case_id=$case_id");
if($result===false)
echo "failed";
else{
    $description="Case status updated:".$status;
    $result=$conn->query("INSERT INTO case_updation(case_id,officer_id,description,date) VALUES('$case_id',0,'$description',now())");
    if($result===false)
    echo "failed";
    else{
    $date = date('Y-m-d H:i:s');
    $us=$_SESSION['sess_user'];
    $details="Case id:".$case_id."\nFinding:".$description."\nDate:".$date;
    $action="Case Update";
    $sql="INSERT INTO history(user,action,details,timestamp) VALUES('$us','$action','$details','$date')";  
    $result=$conn->query($sql);
    if($result===false){
    echo "History updation failed";
    }
mysqli_close($conn);
echo "Case status updated succesfully";
}
} 
}
}
?>  
</body>  
</html>   