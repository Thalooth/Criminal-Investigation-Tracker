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
<title>View Suspects</title>  
<link rel="stylesheet" href="/cit/modules/style.css" /> 
<style>
.leftbox{
  float:left;
  width:30%;
}
.rightbox{
  float:right;
  width:30%;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
</head>
<body>
    <center><h1>VIEW SUSPECTS</h1></center><br/>
    <form action="" method="POST">
    <div class='leftbox'>
    <div class="search-box">
        <input type="text" autocomplete="off" placeholder="Search suspect..." name='name' id='searchbox'/>
        <div class="result"></div>
    </div></div>
    <div style="float:'right';">
    
        <input type='submit' value='SEARCH' name='submit'>
    </div>
    </form>
<br/><br/><br/>
</body>
</html>
<?php
if(isset($_POST['submit'])){
$conn=new mysqli('localhost','root','','cit') or die(mysql_error());
$criminal_name=$_POST['name'];
$result=$conn->query("SELECT * FROM criminal WHERE name='".$criminal_name."'");
if($result===false)
echo "failed";
else{
    $row = $result->fetch_assoc();
    $imgname=$row['image_name'];
    $dirname="../uploads/criminal/";
    echo "<div class='rightbox'><img src=".$dirname.$imgname." alt='Not working!' width='200px'/></div>";
    echo "<div class='leftbox'><br/><table class='center'>
    <tr><td align='right'>Name:</td><td align='left'>".$row['name']. "</td></tr>
    <tr><td align='right'>Criminal ID:</td><td align='left'>".$row['criminal_id']. "</td></tr>
    <tr><td align='right'>Gender:</td><td align='left'>".$row['sex']. "</td></tr>
    <tr><td align='right'>Date of birth:</td><td align='left'>".$row['dob']. "</td></tr>
    <tr><td align='right'>Description:</td><td align='left'>".$row['description']. "</td></tr>
    <tr><td></td><td></td></tr>
    </table></div>";
    mysqli_free_result($result);
    }
    mysqli_close($conn);
    }
}
?>   