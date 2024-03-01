<?php
include("connection.php");
$ID = $_GET['id'];

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

if (isset($_POST['update'])) {

    //image upload field

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "images/" . $filename;
    move_uploaded_file($tempname, $folder);

    $nmc = $_POST['nmc'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
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

    if (
        empty($nmcError) && empty($nameError) && empty($emailError) &&
        empty($ageError) && empty($genderError) && empty($phoneError) && empty($clinicError) && empty($caddressError) &&
        empty($specialError) && empty($degreeError)
    ) {

        // Check if user already exists
        $updateQuery = "UPDATE doctor SET nmc=$nmc, fullname='$fullname', email='$email', age='$age', gender='$gender', phone='$phone', clinic='$clinic', clinicaddress='$clinicaddress', speciality='$speciality', degree='$degree', image='$folder' WHERE id=$ID ";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            echo "update successfully";
            header("location:http://localhost/project-I/doctorrecord.php");
        } else {
            echo "failed" . mysqli_error($conn);
        }
    }
}
?>

<?php

include("connection.php");
$ID = $_GET['id'];

$query = "SELECT * FROM doctor WHERE id=$ID";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);
$result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update page</title>
    <link rel="stylesheet" href="form.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>
    <div class="doctorform-container">
        <div class="close-btn">
            <a href="doctorrecord.php"><i class="fas fa-times close"></i></a>
        </div>
        <h2>Update Details</h2>

        <form action="#" method="post" enctype="multipart/form-data">
            <div class="fields">
                <div class="input-field">
                    <label for="nmc">NMC no:</label><br />
                    <input type="number" name="nmc" value="<?php echo $result['nmc']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $nmcError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="fullname">Fullname:</label><br />
                    <input type="text" name="fullname" value="<?php echo $result['fullname']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $nameError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="email">Email:</label><br />
                    <input type="email" name="email" value="<?php echo $result['email']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $emailError ?>
                    </span>
                </div>
                <!--  -->
                <div class="input-field">
                    <label for="age">Age:</label><br />
                    <input type="number" name="age" value="<?php echo $result['age']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $ageError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="gender">Gender:</label><br />
                    <select name="gender">
                        <option disabled selected>Select gender</option>
                        <option <?php echo $result['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option <?php echo $result['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option <?php echo $result['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $genderError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="phone">Mobile No:</label><br />
                    <input type="number" name="phone" value="<?php echo $result['phone']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $phoneError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="clinic">Clinic:</label><br />
                    <input type="text" name="clinic" value="<?php echo $result['clinic']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $clinicError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="address">Clinic location:</label><br />
                    <input type="text" name="clinicaddress" value="<?php echo $result['clinicaddress']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $caddressError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label>Speciality:</label>
                    <select name="speciality">
                        <option disabled selected>select your speciality</option>
                        <option <?php echo $result['speciality'] == 'Physicians' ? 'selected' : '' ?>>Physicians</option>
                        <option <?php echo $result['speciality'] == 'Anesthesiologists' ? 'selected' : '' ?>>
                            Anesthesiologists</option>
                        <option <?php echo $result['speciality'] == 'Psychiatrists' ? 'selected' : '' ?>>Psychiatrists
                        </option>
                        <option <?php echo $result['speciality'] == 'Pathologists' ? 'selected' : '' ?>>Pathologists
                        </option>
                        <option <?php echo $result['speciality'] == 'Radiologists' ? 'selected' : '' ?>>Radiologists
                        </option>
                        <option <?php echo $result['speciality'] == 'Cardiology' ? 'selected' : '' ?>>Cardiology</option>
                        <option <?php echo $result['speciality'] == 'Neurology' ? 'selected' : '' ?>>Neurology</option>
                        <option <?php echo $result['speciality'] == 'Opthamalogy' ? 'selected' : '' ?>>Opthamalogy
                        </option>
                        <option <?php echo $result['speciality'] == 'Dentist' ? 'selected' : '' ?>>Dentist</option>
                        <option <?php echo $result['speciality'] == 'Dermatology' ? 'selected' : '' ?>>Dermatology
                        </option>
                        <option <?php echo $result['speciality'] == 'Surgeons' ? 'selected' : '' ?>>Surgeons</option>
                        <option <?php echo $result['speciality'] == 'Pediatricians' ? 'selected' : '' ?>>Pediatricians
                        </option>
                    </select><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $specialError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="degree">Degree:</label><br />
                    <input type="text" name="degree" value="<?php echo $result['degree']; ?>" /><br>
                    <span style="color:red; font-size:12px;">
                        <?php echo $degreeError ?>
                    </span>
                </div>
                <div class="input-field">
                    <label for="image">Profile Image:</label><br />
                    <input type="file" name="image" value="<?php echo $rsult['image'] ?>" />
                    <span style="color:red; font-size:12px;">
                        <?php echo $imgError ?>
                    </span>
                </div>
            </div>

            <div class="submit-btn">
                <input type="submit" name="update" value="Update Now" />
            </div>

        </form>
    </div>

</body>

</html>