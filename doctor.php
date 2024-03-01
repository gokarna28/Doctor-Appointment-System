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
    <link rel="stylesheet" href="doctor.css" />
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

        if (isset($_POST['submit'])) {

            $fullname = $_POST['fullname'];
            $date = $_POST['date'];

            $slot1from = date("g:i A", strtotime($time = $_POST['slot1from']));
            $slot1to = date("g:i A", strtotime($time = $_POST['slot1to']));
            $slot2from = date("g:i A", strtotime($time = $_POST['slot2from']));
            $slot2to = date("g:i A", strtotime($time = $_POST['slot2to']));
            $slot3from = date("g:i A", strtotime($time = $_POST['slot3from']));
            $slot3to = date("g:i A", strtotime($time = $_POST['slot3to']));
            $slot4from = date("g:i A", strtotime($time = $_POST['slot4from']));
            $slot4to = date("g:i A", strtotime($time = $_POST['slot4to']));
            $slot5from = date("g:i A", strtotime($time = $_POST['slot5from']));
            $slot5to = date("g:i A", strtotime($time = $_POST['slot5to']));


            //validation
            if (empty($fullname)) {
                $nameError = "name required";
            }
            if (empty($date)) {
                $dateError = "date required";
            }

            if (empty($nameError) && empty($dateError)) {



                //check date
                $checkQuery = "SELECT * FROM schedule WHERE date = '$date' && fullname='$fullname' ";
                $checkResult = mysqli_query($conn, $checkQuery);

                if ($checkResult) {
                    if (mysqli_num_rows($checkResult) > 0) {
                        $dateError = "already set on this date ";

                    } else {

                        $query = "INSERT INTO schedule(fullname,date,slot1from,slot1to,slot2from,slot2to,slot3from,slot3to,slot4from,slot4to,slot5from,slot5to)
VALUES('$fullname','$date','$slot1from','$slot1to','$slot2from','$slot2to','$slot3from','$slot3to','$slot4from','$slot4to','$slot5from','$slot5to')";
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

        <!-- schedule -->
        <div class=" set-schedule">
            <h2 align='center'>Set your Schedule</h2>

            <form action="#" method="post">
                <p>Note: You can set maximum five appointments in a day. </p>

                <div class="form-wrapper">

                    <div class="input-field">
                        <div>
                            <label>Fullname:</label><br>
                            <input type="text" name="fullname" placeholder="enter your fullname"
                                value="<?php echo $_SESSION['fullname']; ?>"><br>
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
                            <input type="time" name="slot1from">
                            to
                            <input type="time" name="slot1to">
                        </div>
                        <div>
                            <input type="time" name="slot2from">
                            to
                            <input type="time" name="slot2to">
                        </div>
                        <div>
                            <input type="time" name="slot3from">
                            to
                            <input type="time" name="slot3to">
                        </div>
                        <div>
                            <input type="time" name="slot4from">
                            to
                            <input type="time" name="slot4to">
                        </div>
                        <div>
                            <input type="time" name="slot5from">
                            to
                            <input type="time" name="slot5to">
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
        function toggleprofile() {
            document.querySelector(".profile-data").classList.toggle("hide");

        }
    </script>
</body>

</html>