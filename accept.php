<?php
include("connection.php");
$ID = $_GET['id'];

$query = "UPDATE doctor SET status='approved' WHERE id=$ID";
$data = mysqli_query($conn, $query);

if ($data) {
    echo "updated successfully";
    header("location:http://localhost/project-I/admin.php");
} else {
    echo "failed" . mysqli_error($conn);
}
?>