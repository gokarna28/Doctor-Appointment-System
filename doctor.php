<?php
include("connection.php");
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['email'])) {
    header("location:http://localhost/project-I/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctor pannel</title>
    <link rel="stylesheet" href="admin1.css" />
    <link rel="stylesheet" href="doctor1.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>
    <!--sidebar-->
    <div class="sidebar ">
        <!--logo-->
        <a href="#"><img src="logo/logo.png" class="logo"></a>

        <!--list of menus-->
        <div class="sidebar-menus">
            <a href="#"><i class="fa-solid fa-house"></i>Home</a>
            <a href="#"><i class="fa-solid fa-calendar-check"></i>Appointment</a>
            <a href="#"><i class="fa-solid fa-calendar-days"></i>Time Schedule</a>
            <a href="#"><i class="fa-regular fa-clipboard"></i>appointments records</a>
            <a href="#"><i class="fa-solid fa-gear"></i>Setting</a>
        </div>
        <!--logout-->
        <div class="sidebar-logout">
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        </div>
    </div>

    <!-- main section -->
    <div class="main">
        <div class="profile-data hide">
            <div>
                <?php echo '<img src="' . $_SESSION['image'] . '" alt="User Image">'; ?>
            </div>
            <div class="details">

                <div>
                    <i class="fa-solid fa-user"></i>
                    <?php echo $_SESSION['fullname']; ?>
                </div>
                <div>
                    <i class="fa-solid fa-stethoscope"></i>
                    <?php echo $_SESSION['speciality']; ?>
                </div>
                <div>
                    <i class="fa-solid fa-graduation-cap"></i>
                    <?php echo $_SESSION['degree']; ?>
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i>
                    <?php echo $_SESSION['email']; ?>
                </div>
                <div>
                    <i class="fa-solid fa-house-medical"></i>
                    <?php echo $_SESSION['clinic']; ?>
                </div>
                <div>
                    <i class="fa-solid fa-location-dot"></i>
                    <?php echo $_SESSION['clinicaddress']; ?>
                </div>
                <div>
                    <i class="fa-solid fa-phone"></i>
                    <?php echo $_SESSION['phone']; ?>
                </div>
            </div>
            <div class="edit">
                <a href="#?id=' . $row['id'] . '"><i class="fa-solid fa-pen-to-square"></i>edit</a>
            </div>
        </div>
        <div class="header">
            <div class="search">
                <input type="text" placeholder="search here..." class="input">
                <input type="submit" value="Search" class="search-btn">
            </div>
            <div class="profile" onclick="toggleprofile()">
                <div>
                    <?php echo '<img src="' . $_SESSION['image'] . '" alt="User Image">'; ?>
                </div>
                <a href="#">Profile</a>
            </div>
        </div>

        <!-- Set schedule -->
        <?php
        include("connection.php");

        $nameError = "";
        $dateError = "";
        $slot1Error = "";
        $slot2Error = "";
        $slot3Error = "";
        $slot4Error = "";
        $slot5Error = "";
        $slot6Error = "";
        $slot7Error = "";
        $slot8Error = "";
        $slot9Error = "";
        $slot10Error = "";

        if (isset($_POST['submit'])) {

            $fullname = $_POST['fullname'];
            $date = $_POST['date'];

            $slot1 = isset($_POST['slot1']) ? $_POST['slot1'] : "";
            $slot2 = isset($_POST['slot2']) ? $_POST['slot2'] : "";
            $slot3 = isset($_POST['slot3']) ? $_POST['slot3'] : "";
            $slot4 = isset($_POST['slot4']) ? $_POST['slot4'] : "";
            $slot5 = isset($_POST['slot5']) ? $_POST['slot5'] : "";
            $slot6 = isset($_POST['slot6']) ? $_POST['slot6'] : "";
            $slot7 = isset($_POST['slot7']) ? $_POST['slot7'] : "";
            $slot8 = isset($_POST['slot8']) ? $_POST['slot8'] : "";
            $slot9 = isset($_POST['slot9']) ? $_POST['slot9'] : "";
            $slot10 = isset($_POST['slot10']) ? $_POST['slot10'] : "";

            //validation
            if (empty($fullname)) {
                $nameError = "name required";
            }
            if (empty($date)) {
                $dateError = "date required";
            }
            // if (!empty($slot1 == $slot2 || $slot1 == $slot3 || $slot1 == $slot4 || $slot1 == $slot5 || $slot1 == $slot6 || $slot1 == $slot7 || $slot1 == $slot8 || $slot1 == $slot9 || $slot1 == $slot10)) {
            //     $slot1Error = "already taken";
            // }
            // if ($slot2 == $slot1 || $slot2 == $slot3 || $slot2 == $slot4 || $slot2 == $slot5 || $slot2 == $slot6 || $slot2 == $slot7 || $slot2 == $slot8 || $slot2 == $slot9 || $slot2 == $slot10) {
            //     $slot2Error = "already taken";
            // }
            // if ($slot3 == $slot2 || $slot3 == $slot1 || $slot3 == $slot4 || $slot3 == $slot5 || $slot3 == $slot6 || $slot3 == $slot7 || $slot3 == $slot8 || $slot3 == $slot9 || $slot3 == $slot10) {
            //     $slot3Error = "already taken";
            // }
            // if ($slot4 == $slot2 || $slot4 == $slot3 || $slot4 == $slot1 || $slot4 == $slot5 || $slot4 == $slot6 || $slot4 == $slot7 || $slot4 == $slot8 || $slot4 == $slot9 || $slot4 == $slot10) {
            //     $slot4Error = "already taken";
            // }
            // if ($slot5 == $slot2 || $slot5 == $slot3 || $slot5 == $slot4 || $slot5 == $slot1 || $slot5 == $slot6 || $slot5 == $slot7 || $slot5 == $slot8 || $slot5 == $slot9 || $slot5 == $slot10) {
            //     $slot5Error = "already taken";
            // }
            // if ($slot6 == $slot2 || $slot6 == $slot3 || $slot6 == $slot4 || $slot6 == $slot5 || $slot6 == $slot1 || $slot6 == $slot7 || $slot6 == $slot8 || $slot6 == $slot9 || $slot6 == $slot10) {
            //     $slot6Error = "already taken";
            // }
            // if ($slot7 == $slot2 || $slot7 == $slot3 || $slot7 == $slot4 || $slot7 == $slot5 || $slot7 == $slot6 || $slot7 == $slot1 || $slot7 == $slot8 || $slot7 == $slot9 || $slot7 == $slot10) {
            //     $slot7Error = "already taken";
            // }
            // if ($slot8 == $slot2 || $slot8 == $slot3 || $slot8 == $slot4 || $slot8 == $slot5 || $slot8 == $slot6 || $slot8 == $slot7 || $slot8 == $slot1 || $slot8 == $slot9 || $slot8 == $slot10) {
            //     $slot8Error = "already taken";
            // }
            // if ($slot9 == $slot2 || $slot9 == $slot3 || $slot9 == $slot4 || $slot9 == $slot5 || $slot9 == $slot6 || $slot9 == $slot7 || $slot9 == $slot8 || $slot9 == $slot9 || $slot9 == $slot10) {
            //     $slot9Error = "already taken";
            // }
            // if ($slot10 == $slot2 || $slot10 == $slot3 || $slot10 == $slot4 || $slot10 == $slot5 || $slot10 == $slot6 || $slot10 == $slot7 || $slot10 == $slot8 || $slot10 == $slot9 || $slot10 == $slot1) {
            //     $slot10Error = "already taken";
            // }
        

            if (empty($nameError) && empty($dateError)) {



                //check date
                $checkQuery = "SELECT * FROM schedule WHERE date = '$date' && fullname='$fullname' ";
                $checkResult = mysqli_query($conn, $checkQuery);

                if ($checkResult) {
                    if (mysqli_num_rows($checkResult) > 0) {
                        $dateError = "already set on this date ";

                    } else {

                        $query = "INSERT INTO schedule(fullname,date,slot1,slot2,slot3,slot4,slot5,slot6,slot7,slot8,slot9,slot10)
VALUES('$fullname','$date','$slot1','$slot2','$slot3','$slot4','$slot5','$slot6','$slot7','$slot8','$slot9','$slot10')";
                        $data = mysqli_query($conn, $query);
                        if ($data) {
                            echo "data inserted sucessfully";

                        } else {
                            echo "failed" . mysqli_error($conn);
                        }
                    }
                }
            }
        }
        ?>


        <div class=" set-schedule">
            <h2 align='center'>Set your Schedule</h2>

            <form action="#" method="post">
                <div class="form-wrapper">

                    <div class="input-field">
                        <div>
                            <label>Fullname:</label><br>
                            <input type="text" name="fullname" placeholder="enter your fullname"><br>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $nameError ?>
                            </span>
                        </div>
                        <div>
                            <label>Date:</label><br>
                            <input type="date" name="date">
                            <span style='color:red; font-size:11px;'>
                                <?php echo $dateError ?>
                            </span>
                        </div>
                    </div>

                    <div class="time">
                        <div>
                            <select name="slot1">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot1Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot2">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot2Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot3">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot3Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot4">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot4Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot5">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot5Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot6">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot6Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot7">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot7Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot8">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot8Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot9">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot9Error ?>
                            </span>
                        </div>
                        <div>
                            <select name="slot10">
                                <option disabled selected>Set your schedule</option>
                                <option>10:00 AM-10:30 AM</option>
                                <option>10:30 AM-11:00 AM</option>
                                <option>11:00 AM-11:30 AM</option>
                                <option>11:30 AM-12:00 PM</option>
                                <option>12:00 PM-12:30 PM</option>
                                <option>12:30 PM-01:00 PM</option>
                                <option>02:00 PM-02:30 PM</option>
                                <option>02:30 PM-03:00 PM</option>
                                <option>03:00 PM-03:30 PM</option>
                                <option>03:30 PM-04:00 PM</option>
                            </select>
                            <span style='color:red; font-size:11px;'>
                                <?php echo $slot10Error ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="set-btn">
                    <input type="submit" name="submit" value="Set Now">
                </div>
            </form>

        </div>
    </div>

    <script>
        function toggleprofile(){
            document.querySelector(".profile-data").classList.toggle("hide");

        }
    </script>
</body>

</html>