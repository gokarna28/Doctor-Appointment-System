<?php

if (isset($_POST['book'])) {

    $dname = $_POST['dname'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>doctor view</title>
    <link rel="stylesheet" href="book.css">
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>
    <div class="wrapper">
        <div class="header">
            <h3>Book Appointment</h3>
        </div>

        <form action="#" method="post">
            <?php
            include("connection.php");
            error_reporting(E_ALL);

            if (isset($_GET['id'])) {
                $ID = $_GET['id'];

                $query = "SELECT *
              FROM doctor 
              INNER JOIN schedule ON doctor.fullname = schedule.fullname
              WHERE status='approved' AND id=$ID";

                $data = mysqli_query($conn, $query);
                if ($data) {
                    if (mysqli_num_rows($data) > 0) {
                        // Output the results
                        $result = mysqli_fetch_assoc($data);
                        echo "
                 
                        <div class='doctor-data'>

                        <div class='data'>
                            <label>Doctor Name:</label><br>
                            <input type='text' name='dname' value='" . $result['fullname'] . "'>
                        </div>

                        <div class='data'>
                            <label>NMC:</label><br>
                            <input type='text' name='dname' value='" . $result['nmc'] . "'>
                            </div>

                        <div class='data'>
                            <label>Doctor Email:</label><br>
                            <input type='text' name='dname' value='" . $result['email'] . "'>
                            </div>

                        <div class='data'>
                            <label>Speciality:</label><br>
                            <input type='text' name='dname' value='" . $result['speciality'] . "'>
                            </div>

                        <div class='data'>
                            <label>Degree:</label><br>
                            <input type='text' name='dname' value='" . $result['degree'] . "'>
                            </div>

                        <div class='data'>
                            <label>Clinic Name:</label><br>
                            <input type='text' name='dname' value='" . $result['clinic'] . "'>
                            </div>

                        <div class='data'>
                            <label>Clinic Location:</label><br>
                            <input type='text' name='dname' value='" . $result['clinicaddress'] . "'>
                            </div>

                        <div class='data'>
                            <label>Contact:</label><br>
                            <input type='text' name='dname' value='" . $result['phone'] . "'>
                            </div>
            
                        </div>
                        <div class='datetime'>
                        <h3>Select your appointment time</h3>
                        <div class='date'><span>Date:</span> " . $result['date'] . "</div>
                            <div class='time'>
                            

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot1'] . ">
                                <label for='slot1'>" . $result['slot1'] . "</label>
                                </div>
                                
                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot2'] . ">
                                <label for='slot1'>" . $result['slot2'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot3'] . ">
                                <label for='slot1'>" . $result['slot3'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot4'] . ">
                                <label for='slot1'>" . $result['slot4'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot5'] . ">
                                <label for='slot1'>" . $result['slot5'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot6'] . ">
                                <label for='slot1'>" . $result['slot6'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot7'] . ">
                                <label for='slot1'>" . $result['slot7'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot8'] . ">
                                <label for='slot1'>" . $result['slot8'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot9'] . ">
                                <label for='slot1'>" . $result['slot9'] . "</label>
                                </div>

                                <div class='data'>
                                <input type='checkbox' value=" . $result['slot10'] . ">
                                <label for='slot1'>" . $result['slot10'] . "</label>
                                </div>
                            </div>
                            
                        </div>

                    
                     ";
                    }
                } else {
                    echo "No records";
                }
            } else {

                echo "Error executing query: " . mysqli_error($conn);
            }


            ?>
            <div class='patient-data'>

                <h3>Fill your details</h3>


                <div class="fields">
                    <div class="input-field">
                        <label>Fullname:</label><br>
                        <input type='text' name='pname' placeholder='Enter your fullname'>
                    </div>

                    <div class="input-field">
                        <label>Gender:</label><br>
                        <select name='pgender'>
                            <option disabled selected>Select gender</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label>Age:</label><br>
                        <input type='number' name='page' placeholder='Enter your age'>
                    </div>

                    <div class="input-field">
                        <label>Email:</label><br>
                        <input type='email' name='pemail' placeholder='Enter your email'>
                    </div>

                    <div class="input-field">
                        <label>phone:</label><br>
                        <input type='number' name='pphone' placeholder='Enter your phone'>
                    </div>
                </div>

            </div>

            <div class="book-btn">
                <input type="submit" name="book" value="Book Now">
            </div>

    </div>
    </form>
</body>

</html>