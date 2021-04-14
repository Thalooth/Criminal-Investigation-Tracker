<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:/CIT/modules/admin/adminlogin.php");  
} else {  
?> 

<!doctype html>  
<html>  
<head>  
<title>ASSIGN OFFICER TO CASE</title>  
<link rel="stylesheet" href="/cit/modules/style.css" /> 
</head>  
<body >  
<center><h1>ASSIGN CASE TO OFFICER</h1></center>
<h3>Enter Assignment Details</h3>  
<form action="" method="POST" runat="server">  
<table>
<tr><td align="right"><label for="o_id">Officer:</label></td>
<td align="left">
<?php
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("SELECT  id,name from officer");
echo "<select id='o_id' name='o_id'>";
while ($row = $result->fetch_row()) {
echo "<option value=".$row[0].">".$row[0].": ".$row[1]."</option>";
}
mysqli_free_result($result);
echo "</select>";
?>
</td></tr>
<tr><td align="right"><label for='c_id'>Case: </label></td>
<td align="left">
<?php
$result=$conn->query("SELECT case_id,case_name from cases");
echo "<select id='c_id' name='c_id'>";
while ($row = $result->fetch_row()) {
echo "<option value=".$row[0].">".$row[0].": ".$row[1]."</option>";
}
$case_name=$row[1];
?>

</select>
</td></tr>
<tr><td align="right"></td><td align="left"><input type="submit" value="Submit" name="submit" /></td></tr>
</table>
</form>  
</body>  
</html>  

<?php 
function randomPassword() {
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pass = array(); //remember to declare $pass as an array
$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
for ($i = 0; $i < 8; $i++) {
$n = rand(0, $alphaLength);
$pass[$i] = $alphabet[$n];
}
return implode($pass); //turn the array into a string
} 
if(isset($_POST["submit"])){  
if(!empty($_POST['o_id']) && !empty($_POST['c_id'])) {  
$officer_id=$_POST['o_id'];  
$case_id=$_POST['c_id'];
$result=$conn->query("SELECT * from officer_assignment where case_id='".$case_id."' and officer_id='".$officer_id."'");
if($result===false)
echo "failed to recognize officer name";
else{
if($result->num_rows!=0){
echo "Officer already added!";
exit();
}
$pw=randomPassword();
$pass=md5($pw);
$result=$conn->query("INSERT INTO officer_assignment(case_id,officer_id,password) VALUES('$case_id','$officer_id','$pass')");
if($result===false)
echo "Failed";
else{
$result=$conn->query("SELECT * from officer where id='".$officer_id."'");
if($result===false)
echo "Failed";
$row=$result->fetch_assoc();
echo "<br/>Case Assigned Successfully<br />Case ID: ".$case_id."<br />Officer ID: ".$officer_id."<br />Password: ".$pw;
$date = date('Y-m-d H:i:s');
$us=$_SESSION['sess_user'];
$details="Officer ID: ".$officer_id."\nCase_id: ".$case_id;
$action="Case Assignment";
$sql="INSERT INTO history(user,action,details,timestamp) VALUES('$us','$action','$details','$date')";  
$result=$conn->query($sql);
if($result===false){
echo "<br />History updation failed";
}
}
}
}
else {  
echo "All fields are required!";  
}  
}
mysqli_close($conn);
}
?>   