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
<title>View Officers</title>  
<style>
.leftbox{
  float:left;
  width:70%;
}
.rightbox{
  float:right;
  width:30%;
}
</style>
<link rel="stylesheet" href="/cit/modules/style.css" />  
</head>  
<body>
<form action="" method="POST">
<label for='o_id'>Select an officer: </label>
<?php
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$result=$conn->query("SELECT id,name from officer");
echo "<select id='o_id' name='o_id'>";
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
$officer_id=$_POST['o_id'];
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
    mysqli_free_result($result);
    }
    mysqli_close($conn);
    }
}
?>
    