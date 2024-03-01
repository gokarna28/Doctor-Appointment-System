<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>doctor appointment system-dashboard</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>
    <!-- header section -->
    <div class="navbar">
        <div class="nav">
            <a href="#"><img src="logo/logo.png" class="logo"></a>
            <a href="login.php" class="login-btn">Login</a>
        </div>
    </div>

    <div class="main">

        <!-- Landing page -->
        <div class="landing-text">
            <p>Your Health, Your Time: Book your appointment with <span class="title">FIND MY
                    DOCTOR</span><br><span>Book
                    Smarter, Better Healthcare on Your Schedule.</span></p>

            <div class="search-btn">
                <input type="text" placeholder="search here..">
                <button>Search</button>
            </div>
        </div>

        <!-- Doctor section -->
        <div class="doctor-section">
            <h2>Appointment With</h2>
            <div class="doctor-wrapper">
                <?php
                include("connection.php");
                error_reporting(E_ALL);

                $query = "SELECT * FROM doctor WHERE status='approved'";
                $data = mysqli_query($conn, $query);
                if ($data) {
                    if (mysqli_num_rows($data) > 0) {

                        while ($result = mysqli_fetch_assoc($data)) {
                            echo "<div class='doctor-card'>
                        
                        <div><img src='" . $result['image'] . "' alt='Doctor Image' style='width: 200px; height:200px;'></div>
                        
                        <div>" . $result['fullname'] . "</div>
                        <div>" . $result['speciality'] . "</div>
                        <div class='view-btn'>
                         <a href=\"view.php?id=" . $result['id'] ."\">Appointment</a>
                            
                        </div>  
                        </div>";
                        }
                    } else {
                        echo "No records";
                    }
                }

                ?>
            </div>

        </div>

    </div>
</body>

</html>