<?php
include("connection.php");
$ID = $_GET['id'];

$query = "DELETE FROM user WHERE id=$ID";
$data = mysqli_query($conn, $query);

if ($data) {
    echo "updated successfully";
     header("location:http://localhost/project-I/userrecord.php");
} else {
    echo "failed" . mysqli_error($conn);
}
?>