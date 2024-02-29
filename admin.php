<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin pannel</title>
    <link rel="stylesheet" href="admin1.css" />
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
            <a href="doctorrecord.php"><i class="fa-solid fa-user-doctor"></i>Doctors</a>
            <a href="userrecord.php"><i class="fa-solid fa-users"></i>Users</a>
            <a href="#"><i class="fa-solid fa-calendar-check"></i>Appointments</a>
            <a href="#"><i class="fa-solid fa-address-book"></i>Admin-user</a>
            <a href="#"><i class="fa-solid fa-gear"></i>Setting</a>
        </div>
        <!--logout-->
        <div class="sidebar-logout">
            <a href="#"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        </div>
    </div>

    <!-- main section -->
    <div class="main">
        <div class="header">
            <div class="search">
                <input type="text" placeholder="search here..." class="input">
                <input type="submit" value="Search" class="search-btn">
            </div>
            <div class="profile">
                <img src="#">
                <a href="#">Profile</a>
            </div>
        </div>



        <!-- analysis  -->
        <div class="analysis">
            <div class="card">
                <div>
                    <i class="fa-solid fa-users"></i>
                    <p>Total Users</p>
                </div>
                <p class="num">
                    <?php
                    include("connection.php");
                    $query = "SELECT * FROM user";
                    $data = mysqli_query($conn, $query);
                    $total = mysqli_num_rows($data);
                    echo $total; ?>
                </p>
            </div>
            <div class="card">
                <div>
                    <i class="fa-solid fa-user-doctor"></i>
                    <p>Total Doctors</p>
                </div>
                <p class="num">
                    <?php
                    include("connection.php");
                    $query = "SELECT * FROM doctor";
                    $data = mysqli_query($conn, $query);
                    $total = mysqli_num_rows($data);
                    echo $total; ?>
                </p>
            </div>
            <div class="card">
                <div>
                    <i class="fa-solid fa-calendar-check"></i>
                    <p>Total Assignments</p>
                </div>
                <p class="num">20</p>
            </div>
        </div>


        <!-- doctor request -->
        <div class="request">
            <h2>Requests</h2>

            <table>
                <tbody>
                    <?php
                    include("connection.php");

                    $query = "SELECT * FROM doctor WHERE status='pending'";
                    $data = mysqli_query($conn, $query);
                    if ($data) {
                        if (mysqli_num_rows($data) > 0) {

                            while ($result = mysqli_fetch_assoc($data)) {
                                echo "<tr>
                        <td style='width:100px;'>" . $result['nmc'] . "</td>
                        <td style='width:300px;'>" . $result['fullname'] . "</td>
                        <td style='width:100px;'>" . $result['degree'] . "</td>
                        <td style='width:300px;'>
                        <a href='https://nmc.org.np/searchPractitioner' class='check'>Check</a>
                        <a href=\"accept.php?id=" . $result['id'] . "\">Accept</a>
                            <a href=\"cancel.php?id=" . $result['id'] . "\" class='cancel'>Cancel</a>
                            
                        </td>  
                        </tr>";
                            }
                        } else {
                            echo "No requests";
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>



        <!-- Add Users -->
        <div class="add">
            <div class="add-card">
                <i class="fa-solid fa-users"></i>
                <a href="#">Add User</a>
            </div>

            <div class="add-card" id="adddoctor">
                <i class="fa-solid fa-user-doctor"></i>
                <a href="#">Add Doctor</a>
            </div>

            <div class="add-card" id="addadmin">
                <i class="fa-solid fa-address-book"></i>
                <a href="#">Add Admin</a>
            </div>
        </div>
    </div>
</body>

</html>