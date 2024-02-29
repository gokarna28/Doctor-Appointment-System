<?php
include("connection.php");

$nameError = "";
$emailError = "";
$passError = "";
$cpassError = "";
$ageError = "";
$genderError = "";
$phoneError = "";
$addressError = "";

if (isset($_POST['usersubmit'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $age = $_POST['age'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check Full Name
    if (empty($fullname)) {
        $nameError = "Full Name is required";
    } elseif (strlen($fullname) > 40) {
        $nameError = "Full name exceeds 40 characters.";
    }

    // Check Email
    if (empty($email)) {
        $emailError = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format";
    }

    // Check Password
    if (empty($password)) {
        $passError = "Password is required";
    } elseif (strlen($password) < 8) {
        $passError = "Password must be at least 8 characters long";
    }

    // Check Confirm Password
    if (empty($cpassword)) {
        $cpassError = "Confirm Password is required";
    } elseif ($cpassword != $password) {
        $cpassError = "Passwords do not match";
    }

    // Check Age
    if (empty($age)) {
        $ageError = "Age is required";
    } elseif (!is_numeric($age) || $age < 0 || $age > 100) {
        $ageError = "Invalid age";
    }

    // Check Gender
    if (empty($gender)) {
        $genderError = "Gender is required";
    }

    // Check Phone Number
    if (empty($phone)) {
        $phoneError = "Phone number is required";
    } elseif (strlen($phone) != 10) {
        $phoneError = "Phone number must be 10 digits";
    }

    // Check Address
    if (empty($address)) {
        $addressError = "Clinic location is required";
    }

    if (empty($nameError) && empty($emailError) && empty($passError) && empty($cpassError) &&
        empty($ageError) && empty($genderError) && empty($phoneError) && empty($addressError)) {

        // Check if user already exists
        $checkQuery = "SELECT * FROM user WHERE email = '$email' ";
        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult) {
            if (mysqli_num_rows($checkResult) > 0) {
                $emailError = "This email address is already taken.";
            } else {
                // hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO user(fullname,email,password,age,gender,phone,address)
                    VALUES('$fullname', '$email', '$hashedPassword', '$age', '$gender', '$phone','$address')";
                $data = mysqli_query($conn, $query);

                if ($data) {
                    echo "data inserted successfully";
                    header("location:http://localhost/project-I/dashboard.php");
                } else {
                    echo "failed" . mysqli_error($conn);
                }

                mysqli_close($conn);
            }
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>user-signup page</title>
    <link rel="stylesheet" href="form.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>
    <div class="userform-container">
    <div class="close-btn">
            <a href="dashboard.php"><i class="fas fa-times close"></i></a>
        </div>
        <h2>User Registration</h2>

        <form action="#" method="post">
            <div class="fields">
                <div class="input-field">
                    <label for="fullname">Fullname:</label><br />
                    <input type="text" name="fullname" placeholder="Enter your fullname" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $nameError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="email">Email:</label><br />
                    <input type="email" name="email" placeholder="Enter your email" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $emailError ?>
                    </span>

                </div>
                <div class="input-field">
                    <label for="password">Password:</label><br />
                    <input type="password" name="password" placeholder="Enter your password" class="password" />

                    <span class="eyeclose"><i class="fas fa-eye-slash " onclick="hideShow()"></i></span>
                    <span class="eyeopen hide "><i class="fas fa-eye eyeopen" onclick="showHide()"></i></span><br>

                    <span style="color:red; font-size:12px;">
                        <?php echo $passError ?>
                    </span>

                </div>
                <div class="input-field">
                    <label for="confirm password">Confirm Password:</label><br />
                    <input type="password" name="cpassword" placeholder="Retype your password" class="cpassword" />

                    <span class="ceyeclose"><i class="fas fa-eye-slash " onclick="confirmhideShow()"></i></span>
                    <span class="ceyeopen hide"><i class="fas fa-eye eyeopen"
                            onclick="confirmshowHide()"></i></span><br>

                    <span style="color:red; font-size:12px;">
                        <?php echo $cpassError ?>
                    </span>

                </div>
                <div class="input-field">
                    <label for="age">Age:</label><br />
                    <input type="number" name="age" placeholder="Enter your age" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $ageError ?>
                    </span>

                </div>
                <div class="input-field">
                    <label for="gender">Gender:</label><br>
                    <select name="gender">
                        <option disabled selected>Select gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $genderError ?>
                    </span>

                </div>
                <div class="input-field">
                    <label for="phone">Mobile no:</label><br />
                    <input type="number" name="phone" placeholder="Enter your mobile number" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $phoneError ?>
                    </span>

                </div>
                <div class="input-field">
                    <label for="address">Address:</label><br />
                    <input type="text" name="address" placeholder="Enter your address" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $addressError ?>
                    </span>

                </div>
            </div>

            <div class="submit-btn">
                <input type="submit" name="usersubmit" value="Register Now" />
            </div>
            <div class="link">
                already have a account ? <a href="login.php">login</a> or
                <a href="doctorsignup.php">register as doctor</a>
            </div>
        </form>
    </div>


    <script>
        //password
        function hideShow() {
            const password = document.querySelector(".password");
            const eyeClose = document.querySelector(".eyeclose");
            const eyeOpen = document.querySelector(".eyeopen");

            password.type = "text";
            eyeClose.classList.add("hide");
            eyeOpen.classList.remove("hide");
        }


        function showHide() {
            const password = document.querySelector(".password");
            const eyeClose = document.querySelector(".eyeclose");
            const eyeOpen = document.querySelector(".eyeopen");

            eyeOpen.classList.add("hide");
            eyeClose.classList.remove("hide");
            password.type = "password";
        }

        //confirm password
        function confirmhideShow() {
            const cpassword = document.querySelector(".cpassword");
            const ceyeClose = document.querySelector(".ceyeclose");
            const ceyeOpen = document.querySelector(".ceyeopen");

            cpassword.type = "text";
            ceyeClose.classList.add("hide");
            ceyeOpen.classList.remove("hide");
        }


        function confirmshowHide() {
            const cpassword = document.querySelector(".cpassword");
            const ceyeClose = document.querySelector(".ceyeclose");
            const ceyeOpen = document.querySelector(".ceyeopen");

            ceyeOpen.classList.add("hide");
            ceyeClose.classList.remove("hide");
            cpassword.type = "password";
        }
    </script>
</body>

</html>