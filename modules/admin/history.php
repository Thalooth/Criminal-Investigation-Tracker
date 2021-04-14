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
<style>  
table, th, td {
border: 1px solid darkgreen;
}  
</style>  
</head>  
<body > 
<center><h1>History</h1></center>
</body>
</html>

<?php
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("SELECT * FROM history ORDER BY update_id DESC");
if($result===false)
echo "failed";
else{
echo "<br/><table style='width:100%'>
<tr>
<th>S.no</th>
<th>User</th>
<th>Time</th>
<th>Action</th>
<th>Details</th>
</tr>";
while($row = $result->fetch_assoc()){
echo "<tr><td>".$row['update_id']. "</td>
<td>".$row['user']. "</td>
<td>".$row['timestamp']."</td>
<td>".$row['action']."</td>
<td>".nl2br($row['details'])."</td></tr>";
}
echo "</table>";
}
mysqli_free_result($result);
mysqli_close($conn);
}
?>