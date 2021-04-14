<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:officerlogin.php");  
} else {  
?>  

<!doctype html>  
<html>  
<head>  
<title>Welcome Officer</title>
<style>
</style> 
<link rel="stylesheet" href="/cit/modules/style.css" /> 
</head>  
<body>  
<center><p style="font-size:40px">Criminal Investigation Tracker</p></center>  
<center><img src="/cit/modules/images/green.png" width="150" height="150"></center>
<center><h3>YOUR PERFECT PARTNER FOR SOLVING CRIMES</h3><br/>

<?php
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$id=$_SESSION['sess_user'];
$result=$conn->query("SELECT * FROM officer WHERE id='".$id."'");  
$row=$result->fetch_assoc();
if($result===false)
echo "failure";
$name=$row['name'];
echo "<h1>Welcome ".$name."</h1>";
?>

<br />
<br />
<nav>
  <ul class="nav">
    <li><a href="https://timesofindia.indiatimes.com/topic/Kerala-crime" class="active" target="targetframe">HOME</a></li>
    <li><a href="account.php" class="active" target="targetframe">ACCOUNT</a></li>
    <li><a href="assignment_case.php" class="active" target="targetframe">CASE DETAILS</a></li>
    <li><a href="update_case.php" class="active" target="targetframe">UPDATE CASE</a></li>
    <li><a href="#" class="active" target="targetframe">PREDICTOR</a></li>
    <li><a href="/cit/modules/general/view_suspects.php" class="active" target="targetframe">RECORDS</a></li>
  </ul>
</nav>
<!--
<div class="topnav" id="nav">
<a href="/CIT/modules/menu/home.php" class="btn active" target="targetframe">Home</a>
<a href="/CIT/modules/menu/account.php" class="btn" target="targetframe">ACCOUNT</a>
<a href="/CIT/modules/menu/assignment_case.php" class="btn" target="targetframe">CASE DETAILS</a>
<a href="/CIT/modules/menu/update_case.php" class="btn" target="targetframe">UPDATE CASE</a>
<a href="https://www.indiatvnews.com/crime" class="active" target="targetframe">Home</a>
-->
</div>
<br/>
<iframe src="https://timesofindia.indiatimes.com/topic/Kerala-crime" name="targetframe" allowTransparency="true" style="border:none" width="100%" height="700" >
</iframe>
<script>
// Add active class to the current button (highlight it)
var header = document.getElementById("nav");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
<br/><a href="logout.php">Logout</a></h2>  
</body>  
</html>  

<?php 
mysqli_free_result($result);
mysqli_close($conn); 
}  
?>  