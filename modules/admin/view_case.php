<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){
header("location:adminlogin.php");  
} 
else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>View Cases</title>  
<link rel="stylesheet" href="/cit/modules/style.css" /> 
<style>  
table, th, td {
border: 1px solid black;
}  
</style>  
</head>  
<body>
<form action="" method="POST">
<label for='c_id'>Select a case: </label>
<?php
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("SELECT case_id,case_name from cases");
echo "<select id='c_id' name='c_id'>";
while ($row = $result->fetch_row()) {
echo "<option value=".$row[0].">".$row[0].": ".$row[1]."</option>";
}
?>
<br/>
<input type='submit' value='GO' name='submit'>
</form>
<br/><br/>
</body>
</html>

<?php
if(isset($_POST['submit'])){
$case_id=$_POST['c_id'];
$result=$conn->query("SELECT * FROM cases WHERE case_id='".$case_id."'");
if($result===false)
echo "failed";
else{
$row = $result->fetch_assoc();
echo "<center><h1>CASE ID:".$row['case_id']." - ".$row['case_name']."</h1></center>";
echo "<table><tr><th align='right'>DESCRIPTION:</th><td>".$row['description'];
echo "</td></tr><th align='right'>REGISTRATION DATE:</th><td>".$row['date'];
echo "</td></tr><th align='right'>STATUS:</th><td>".$row['status']."</td></tr>";
}
$result=$conn->query("SELECT officer_id FROM officer_assignment WHERE case_id='".$case_id."'");
if($result->num_rows>0){
$row=$result->fetch_assoc();
echo "<tr><th align='right'>ASSIGNED OFFICERS: </th><td>".$row['officer_id']."</td></tr>";

while($row=$result->fetch_assoc()){
    echo "<tr><th></th><td>".$row['officer_id']."</td></tr>";
}
echo "</table>";
$result=$conn->query("SELECT * FROM case_updation WHERE case_id='".$case_id."' ORDER BY change_id DESC");
if($result===false)
echo "failed";
else{
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
}
mysqli_free_result($result);
mysqli_close($conn);
}
?>