<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>doctor view</title>
    <link rel="stylesheet" href="view1.css">
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
</head>

<body>
    <!-- Doctor section -->
    <div class="main">
        <div class="close-btn">
            <a href="dashboard.php"><i class="fas fa-times close"></i></a>
        </div>
        <h2 align='center'>Schedule</h2>
        <div class="doctor-details">

            <?php
            include("connection.php");
            error_reporting(E_ALL);

            $ID = $_GET['id'];

            // $query = "SELECT *
            // FROM doctor 
            // INNER JOIN schedule ON doctor.fullname = schedule.fullname WHERE status='approved' && id=$ID ";
            
            $query = "SELECT * FROM doctor WHERE status='approved' && id=$ID ";
            $data = mysqli_query($conn, $query);
            if ($data) {
                if (mysqli_num_rows($data) > 0) {

                    while ($result = mysqli_fetch_assoc($data)) {
                        echo "
                        <div class='doctor-card'>
                        
                            <div><img src='" . $result['image'] . "' alt='Doctor Image' style='width: 200px; height:200px;'></div>
                            <div class='details'>
                                <div> NMC: " . $result['nmc'] . "</div>
                                <div>" . $result['fullname'] . "</div>
                                <div>" . $result['speciality'] . "</div>
                                <div>" . $result['degree'] . "</div>
                                <div> Clinic: " . $result['clinic'] . "</div>
                                <div> Location: " . $result['clinicaddress'] . "</div>
                            </div>
                         </div>

                        ";
                    }
                } else {
                    echo "No records";
                }
            }

            ?>
            <div class='schedule'>
                <div class='line'></div>
                <div class="title">
                    <h3>Date</h3>
                    <h3>Time schedule</h3>
                </div>

                <?php
                include("connection.php");
                error_reporting(E_ALL);

                $ID = $_GET['id'];

                $query = "SELECT *
            FROM doctor 
            INNER JOIN schedule ON doctor.fullname = schedule.fullname WHERE status='approved' && id=$ID ";
                $data = mysqli_query($conn, $query);
                if ($data) {
                    if (mysqli_num_rows($data) > 0) {

                        while ($result = mysqli_fetch_assoc($data)) {
                            echo "
                        <div class='time'>
                        <div class='select-time'>
                            <div>" . $result['date'] . "</div>
                            <div>" . $result['slot1'] . "</div>
                            <div>" . $result['slot2'] . "</div>
                            <div>" . $result['slot3'] . "</div>
                            <div>" . $result['slot4'] . "</div>
                            <div>" . $result['slot5'] . "</div>
                            <div>" . $result['slot6'] . "</div>
                            <div>" . $result['slot7'] . "</div>
                            <div>" . $result['slot8'] . "</div>
                            <div>" . $result['slot9'] . "</div>
                            <div>" . $result['slot10'] . "</div>
                            </div>

                            <div class='book'>
                             <a href='book.php?id=" . $result['id'] . "'>Book</a>
                            </div>
                        </div>

                        ";
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