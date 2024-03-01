<?php
include("connection.php");
// date_default_timezone_set("Asia/Kathmandu");
// echo "hour is ".date("h:i A")."<br>";
if(isset($_POST['submit'])){
    // $time=$_POST['time'];

    $formatted_time = date("g:i A", strtotime($time=$_POST['time']));

    echo $formatted_time;  

    $query="INSERT INTO appointment(time) VALUES('$formatted_time')";
    $data=mysqli_query($conn,$query);

    if($data){
        echo"successfull";
    }else{
        echo"failed".mysqli_error($conn);
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>

    .content{
        background-color: red;
        width: 200px;
        height: 200px;
        
    }
</style>
</head>
<body>
<div class="content"></div>
    
</body>
</html>
<form action="#" method="post">
<input type="time" name="time">
<input type="submit" name="submit">
</form>