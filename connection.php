<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'doctorappointmentsystem';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn) {
    //echo "connection seccessfull";

} else
    "failed" . mysqli_error($conn);
