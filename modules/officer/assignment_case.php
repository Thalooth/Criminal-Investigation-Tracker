<?php   
session_start();  
if(!isset($_SESSION["sess_user"]) ||

!isset($_SESSION["sess_case"])){  
header("location:officerlogin.php");  
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>Case Assigned</title>  
<link rel="stylesheet" href="/cit/modules/style.css" /> 
<style>  
table, th, td {
border: 1px solid black;
}  
</style>  
</head>  
</html>

<?php
$user=$_SESSION['sess_user'];
$case_id=$_SESSION["sess_case"];
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("SELECT * FROM cases WHERE case_id='".$case_id."'");
if($result===false)
echo "failed";
else{
$row = $result->fetch_assoc();
echo "<center><h1>CASE ID:".$row['case_id']." ".$row['case_name']."</h1></center>";
echo "<br /><br />DESCRIPTION: ".$row['description'];
echo "<br /><br />REGISTRATION DATE: ".$row['date'];
echo "<br /><br />STATUS: ".$row['status'];
}
$result=$conn->query("SELECT * FROM case_updation WHERE case_id='".$case_id."' ORDER BY change_id DESC");
if($result===false)
echo "failed";
else{
if($result->num_rows>0){
echo "<br/><br/><table style='width:100%'>
<tr>
<th>Change ID</th>
<th>Officer ID</th>
<th>Date</th>
<th>Findings</th>
</tr>";
while($row = $result->fetch_assoc()){
echo "<tr><td>".$row['change_id']. "</td>
<td>".$row['officer_id']. "</td>
<td>".$row['date']. "</td>
<td>".$row['description']."</td></tr>";
}
echo "</table>";
}
}
mysqli_free_result($result);
mysqli_close($conn);
}
?>