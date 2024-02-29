<?php
include("connection.php");
$recordError="";
$emailError="";
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check in doctor table
    $query_doctor = "SELECT * FROM doctor WHERE email=? && status='approved'";
    $stmt_doctor = mysqli_prepare($conn, $query_doctor);
    mysqli_stmt_bind_param($stmt_doctor, "s", $email);
    mysqli_stmt_execute($stmt_doctor);
    $result_doctor = mysqli_stmt_get_result($stmt_doctor);

    // Check in user table
    $query_user = "SELECT * FROM user WHERE email=?";
    $stmt_user = mysqli_prepare($conn, $query_user);
    mysqli_stmt_bind_param($stmt_user, "s", $email);
    mysqli_stmt_execute($stmt_user);
    $result_user = mysqli_stmt_get_result($stmt_user);

    // Check if the email exists in either table
    if(mysqli_num_rows($result_doctor) == 1){
        // Email exists in doctor table
        while($row = mysqli_fetch_assoc($result_doctor)){
            session_start();
            $hashed_password = $row['password'];
            $_SESSION['session_id']= $row['id'];
            $_SESSION['fullname']= $row['fullname'];
            $_SESSION['email']= $row['email'];
            $_SESSION['clinicaddress']= $row['clinicaddress'];
            $_SESSION['clinic']= $row['clinic'];
            $_SESSION['phone']= $row['phone'];
            $_SESSION['degree']= $row['degree'];
            $_SESSION['speciality']= $row['speciality'];
            $_SESSION['image']= $row['image'];
        }
        // Verify the provided password against the hashed password
        if(password_verify($password, $hashed_password)){
            echo "Login successful!";
            header("location:http://localhost/project-I/doctor.php");
        } else {
            $emailError= "Email or password is wrong.";
        }
    } elseif(mysqli_num_rows($result_user) == 1) {
        // Email exists in user table
        while($row = mysqli_fetch_assoc($result_user)){
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            
        }
        echo "Login successful!";
        header("location:http://localhost/project-I/dashboard.php");
    } else {
        // No matching email found in either table
        $recordError= "There is no record. Please register first.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>login page</title>
  <link rel="stylesheet" href="form.css" />
  <!-- Link to Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <!-- Import Google font - Poppins  -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>

  <div class="loginform-container">
    <div class="close-btn">
      <a href="dashboard.php"><i class="fas fa-times close"></i></a>
    </div>
    <h2>Login Form</h2>
    <form action="#" method="post">
      <div class="fields">
    <span style="color:red; font-size:15px;"><?php echo $recordError ;?></span>
        
        <div class="input-field">
          <label for="email">Email:</label><br />
          <input type="email" name="email" placeholder="Enter your email" /><br>
          <span style="color:red; font-size:15px;"><?php echo $emailError ;?></span>
        </div>
        <div class="input-field">
          <label for="password">Password:</label><br />
          <input type="password" name="password" placeholder="Enter your password" class="password"/>

          <span class="eyeclose"><i class="fas fa-eye-slash " onclick="hideShow()"></i></span>
          <span class="eyeopen hide "><i class="fas fa-eye eyeopen" onclick="showHide()"></i></span><br><br>
          <span></span>
        </div>
      </div>

      <div class="forget-pass">
        <a href="#">Forget Password</a>
      </div>

      <div class="submit-btn">
        <input type="submit" name="submit" value="Login" />
      </div>
      <div class="link">
        Don't have a account ? <a href="usersignup.php">register as user</a> or
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
  </script>
</body>

</html>