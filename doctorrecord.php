<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin pannel</title>
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />

    <style>
        :root {
            --primaryColor: #076297;
            --secondaryColor: #d1e6f0;
            --blue-color: rgb(0, 128, 255);
            --whiteColor: #fff;
            --blackColor: #222;
            --greyColor: #f5f5f5;
            --gold: #CC9A33;
        }

        body {
            font-family: poppins;
            background-color: var(--secondaryColor);
        }

        .record {
            background-color: var(--whiteColor);
            padding: 10px;
            border-radius: 12px;

        }

        .record h2 {
            color: var(--primaryColor);
            margin-left: 45%;
        }

        table th,
        td {
            text-decoration: none;
            border: 1px solid black;
            width: 200px;
        }

        .record td a {
            background-color: var(--primaryColor);
            padding: 0 5px;
            text-decoration: none;
            color: var(--whiteColor);
            border-radius: 6px;
        }

        .record td .cancel {
            background-color: red;
        }

        .close-btn {
            font-size: 30px;
            margin: 0 95%;
            color: var(--primaryColor);
        }

        .close-btn a .close {
            color: var(--primaryColor);
        }
    </style>
</head>

<body>
    <!-- doctor record -->
    <div class="record">
        <div class="close-btn">
            <a href="admin.php"><i class="fas fa-times close"></i></a>
        </div>
        <h2>Doctor records</h2>

        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>NMC</th>
                    <th>Fullname</th>
                    <th>Degree</th>
                    <th>Speciality</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Clinic</th>
                    <th>Clinic Location</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connection.php");
                error_reporting(E_ALL);

                $query = "SELECT * FROM doctor WHERE status='approved'";
                $data = mysqli_query($conn, $query);
                if ($data) {
                    if (mysqli_num_rows($data) > 0) {

                        while ($result = mysqli_fetch_assoc($data)) {
                            echo "<tr>
                        <td>" . $result['id'] . "</td>
                        <td><img src='" . $result['image'] . "' alt='Doctor Image' style='width: 50px; height:50px;'></td>
                        <td>" . $result['nmc'] . "</td>
                        <td>" . $result['fullname'] . "</td>
                        <td>" . $result['degree'] . "</td>
                        <td>" . $result['speciality'] . "</td>
                        <td>" . $result['age'] . "</td>
                        <td>" . $result['gender'] . "</td>
                        <td>" . $result['phone'] . "</td>
                        <td>" . $result['clinic'] . "</td>
                        <td>" . $result['clinicaddress'] . "</td>
                        <td>
                        <a href=\"doctorupdate.php?id=" . $result['id'] . "\">Update</a>
                            <a href=\"doctordelete.php?id=" . $result['id'] . "\" class='cancel' onclick='delete()'>Delete</a>
                            
                        </td>  
                        </tr>";
                        }
                    } else {
                        echo "No records";
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
    <script>
        //delete confirmation
        function delete (){
            if (confirm("Are you sure to delete this data.")) {

            }
        }
    </script>
</body>

</html>