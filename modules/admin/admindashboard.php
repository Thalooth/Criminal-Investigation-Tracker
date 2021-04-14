<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
header("location:/CIT/modules/admin/adminlogin.php");  
} else {  
?>  

<!doctype html>  
<html>  
<head>  
<title>Welcome</title>
<link rel="stylesheet" href="/cit/modules/style.css" /> 
</head>  
<body>  
<center><p style="font-size:40px">Criminal Investigation Tracker</p></center>  
<center><img src="/cit/modules/images/green.png" width="150" height="150"></center>
<center><h3>YOUR PERFECT PARTNER FOR SOLVING CRIMES</h3><br/>
<h2>Welcome, <?=$_SESSION['sess_user'];?>!
<br/><br/>
<nav>
  <ul class="nav">
    <li><a href="https://timesofindia.indiatimes.com/topic/Kerala-crime" class="active" target="targetframe">Home</a></li>
    <li><a>CASE</a>
      <ul>
        <li><a href="view_case.php" target="targetframe">VIEW CASE</a></li>
        <li><a href="add_case.php" target="targetframe">ADD CASE</a></a></li>
        <li><a href="assign_officer.php" target="targetframe">ASSIGN CASE</a></li>
        <li><a href="update_status.php" target="targetframe">UPDATE STATUS</a></li>
      </ul>
    </li>
    <li><a>OFFICER</a>
      <ul>
        <li><a href="view_officer.php" target="targetframe">VIEW OFFICER</a></li>
        <li><a href="add_officer.php" target="targetframe">ADD OFFICER</a></li>
        <li><a href="assign_officer.php" target="targetframe">ASSIGN OFFICER</a></li>
      </ul>
    </li>
    <li><a href="#">PREDICTOR</a></li>
    <li><a>RECORDS</a>
      <ul>
        <li><a href="../general/view_suspects.php" target="targetframe">VIEW SUSPECTS</a></li>
        <li><a href="add_suspect.php" target="targetframe">ADD SUSPECTS</a></li>
      </ul>
    </li>
    <li><a href="history.php" class="btn" target="targetframe">HISTORY</a></li>
  </ul>
</nav>
<br/>
<!--<div class="topnav" id="nav">
<a href="https://www.indiatvnews.com/crime" class="active" target="targetframe">Home</a>
<a href="add_case.php" class="btn" target="targetframe">ADD CASE</a>
<a href="add_officer.php" class="btn" target="targetframe">ADD OFFICER</a>
<a href="assign_officer.php" class="btn" target="targetframe">ASSIGN OFFICER</a>
<a href="add_evidence.php" class="btn" target="targetframe">ADD EVIDENCE</a>
<a href="predictor.php" class="btn" target="targetframe">PREDICT SUSPECT</a>
<a href="history.php" class="btn" target="targetframe">HISTORY</a>
</div>-->
<iframe src="https://timesofindia.indiatimes.com/topic/Kerala-crime" name="targetframe" allowTransparency="true" style="border:none" width="100%" height="700" >
</iframe>
<!--<script>
var header = document.getElementById("nav");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
btns[i].addEventListener("click", function() {
var current = document.getElementsByClassName("active");
current[0].className = current[0].className.replace("active", "btn");
this.className += " active";
});
}
</script>
-->
<br><a href="logout.php">Logout</a></h2>  
</body>  
</html>  

<?php  
}  
?>  