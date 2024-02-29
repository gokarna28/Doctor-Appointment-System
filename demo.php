<?php
include("connection.php");
if(isset($_POST['submit'])){
    $selected_time = $_POST['time'];

    // Convert the selected time to the desired format
    $time = date("g A", strtotime($selected_time));

    $query = "INSERT INTO appointment (time) VALUES (DATE_FORMAT(STR_TO_DATE('$selected_time', '%H:%i'), '%h %p'))";

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
</head>
<body>
    <form action="#" method="post">
        <input type="time" name="time" >
        <input type="submit" name="submit" value="set">

    </form>
    
</body>
</html>