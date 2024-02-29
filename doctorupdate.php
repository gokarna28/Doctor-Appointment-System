<?php
include("connection.php");

$nmcError = "";
$nameError = "";
$emailError = "";
$passError = "";
$cpassError = "";
$ageError = "";
$genderError = "";
$phoneError = "";
$clinicError = "";
$caddressError = "";
$specialError = "";
$degreeError = "";
$imgError = "";

if (isset($_POST['doctorsubmit'])) {

    //image upload field

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/" . $filename;
    move_uploaded_file($tempname, $folder);

    $nmc = $_POST['nmc'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $age = $_POST['age'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $phone = $_POST['phone'];
    $clinic = $_POST['clinic'];
    $clinicaddress = $_POST['clinicaddress'];
    $speciality = isset($_POST['speciality']) ? $_POST['speciality'] : '';
    $degree = $_POST['degree'];


    // Check NMC Number
    if (empty($nmc)) {
        $nmcError = "NMC number is required";
    }

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

    // Check Clinic
    if (empty($clinic)) {
        $clinicError = "Clinic name is required";
    }

    // Check Address
    if (empty($clinicaddress)) {
        $caddressError = "Clinic location is required";
    }

    // Check Department
    if (empty($speciality)) {
        $specialError = "Specialty is required";
    }

    // Check Degree
    if (empty($degree)) {
        $degreeError = "Degree is required";
    }
    // //check image
    // if (empty($folder)) {
    //     $imgError = "required";
    // }
    if (
        empty($nmcError) && empty($nameError) && empty($emailError) && empty($passError) && empty($cpassError) &&
        empty($ageError) && empty($genderError) && empty($phoneError) && empty($clinicError) && empty($caddressError) &&
        empty($specialError) && empty($degreeError)
    ) {

        // Check if user already exists
        $checkQuery = "SELECT * FROM doctor WHERE email = '$email' || NMC='$nmc' ";
        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult) {
            if (mysqli_num_rows($checkResult) > 0) {
                $emailError = "User with this email already exists.";
                $nmcError = "user with this nmc already exists.";
            } else {
                // hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO doctor(image,nmc,fullname,email,password,age,gender,phone,clinic,clinicaddress,speciality,degree)
    VALUES('$folder','$nmc','$fullname','$email','$hashedPassword','$age','$gender','$phone','$clinic','$clinicaddress','$speciality','$degree')";
                $data = mysqli_query($conn, $query);

                if ($data) {
                    echo "data inserted successfully";
                } else {
                    echo "fialed";
                }
            }
        }
    }
}
mysqli_close($conn);
?>
<?php
$ID = $_GET['id'];

$query = "SELECT * FROM doctor WHERE id=$ID";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);

if ($total > 0) {



    $result = mysqli_fetch_assoc($data);

    echo $result['fullname'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>doctor-signup page</title>
    <link rel="stylesheet" href="forms.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>
    <div class="doctorform-container">
        <div class="close-btn">
            <a href="dashboard.php"><i class="fas fa-times close"></i></a>
        </div>
        <h2>Doctor Registration</h2>
        <?php
        include("connection.php");

        if (isset($_GET['id'])) {
            $ID = $_GET['id'];

            $query = "SELECT * FROM doctor WHERE id=$ID";
            $data = mysqli_query($conn, $query);
            $total = mysqli_num_rows($data);

            if ($total > 0) {
                $result = mysqli_fetch_assoc($data);
                ?>

                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="fields">
                        <div class="input-field">
                            <label for="nmc">NMC no:</label><br />
                            <input type="number" name="nmc" value="<?php echo $result['nmc']; ?>"
                                placeholder="Enter your nmc number" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $nmcError ?>
                            </span>
                        </div>
                        <div class="input-field">
                            <label for="fullname">Fullname:</label><br />
                            <input type="text" name="fullname" value="<?php echo $result['fullname'] ?>"
                                placeholder="Enter your fullname" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $nameError ?>
                            </span>
                        </div>
                        <div class="input-field">
                            <label for="email">Email:</label><br />
                            <input type="email" name="email" value="<?php echo $result['email'] ?>"
                                placeholder="Enter your email" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $emailError ?>
                            </span>
                        </div>

                        <div class="input-field">
                            <label for="age">Age:</label><br />
                            <input type="number" name="age" value="<?php echo $result['age'] ?>"
                                placeholder="Enter your age" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $ageError ?>
                            </span>
                        </div>
                        <div class="input-field">
                            <label for="gender">Gender:</label><br />
                            <select name="gender">
                                <option disabled selected>Select gender</option>
                                <?php
                                $genders = array("Male", "Female", "Other");
                                foreach ($genders as $gender) {
                                    $selected = ($result['gender'] == $gender) ? 'selected' : '';
                                    echo "<option value='$gender' $selected>$gender</option>";
                                }
                                ?>

                            </select><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $genderError ?>
                            </span>
                        </div>
                        <div class="input-field">
                            <label for="phone">Mobile No:</label><br />
                            <input type="number" name="phone" value="<?php echo $result['phone'] ?>"
                                placeholder="Enter your mobile number" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $phoneError ?>
                            </span>
                        </div>
                        <div class="input-field">
                            <label for="clinic">Clinic:</label><br />
                            <input type="text" name="clinic" value="<?php echo $result['clinic'] ?>"
                                placeholder="Enter your clinic name" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $clinicError ?>
                            </span>
                        </div>
                        <div class="input-field">
                            <label for="address">Clinic location:</label><br />
                            <input type="text" name="clinicaddress" value="<?php echo $result['clinicaddress'] ?>"
                                placeholder="Enter your clinic address" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $caddressError ?>
                            </span>
                        </div>
                        <div class="input-field">
                            <label>Speciality:</label>
                            <select name="speciality">
                                <option disabled>Select your speciality</option>
                                <?php
                                $specialities = array(
                                    "Physicians",
                                    "Anesthesiologists",
                                    "Psychiatrists",
                                    "Pathologists",
                                    "Radiologists",
                                    "Cardiology",
                                    "Neurology",
                                    "Opthamalogy",
                                    "Dentist",
                                    "Dermatology",
                                    "Surgeons",
                                    "Pediatricians"
                                );

                                foreach ($specialities as $speciality) {
                                    $selected = ($result['speciality'] == $speciality) ? 'selected' : '';
                                    echo "<option value='$speciality' $selected>$speciality</option>";
                                }
                                ?>
                                <span style="color:red; font-size:12px;">
                                    <?php echo $specialError ?>
                                </span>
                        </div>
                        <div class="input-field">
                            <label for="degree">Degree:</label><br />
                            <input type="text" name="degree" value="<?php echo $result['degree'] ?>"
                                placeholder="Enter your degree" /><br>
                            <span style="color:red; font-size:12px;">
                                <?php echo $degreeError ?>
                            </span>
                        </div>
                    <?php }
        } ?>
                <div class="input-field">
                    <label for="image">Profile Image:</label><br />
                    <input type="file" name="image" value="<?php echo $result['image'] ?>" />
                    <span style="color:red; font-size:12px;">
                        <?php echo $imgError ?>
                    </span>
                </div>
            </div>

            <div class="submit-btn">
                <input type="submit" name="doctorsubmit" value="Register Now" />
            </div>
            <div class="link">
                already have a account ? <a href="login.php">login</a> or
                <a href="usersignup.php">register as user</a>
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