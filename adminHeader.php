<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="gp.css">
    <title>Document</title>
</head>

<body>
    <div class="menu">
        <div class="allLink">
            <img src="logo.png" class="logo">
            <h1>Woodlands <br>University</h1>
            <a href="adminHome.php" class="link">
                <h2>Home</h2>
            </a>
            <a href="adminCourse.php" class="link">
                <h2>Course</h2>
            </a>
            <a href="adminModule.php" class="link">
                <h2>Module</h2>
            </a>
            <a href="adminTimeTable.php" class="link">
                <h2>Timetable</h2>
            </a>

            <!-- Create a dropdown container -->
            <div class="dropdown">
                <a href="#" class="dropdown-link">
                    <h2>Register</h2>
                </a>
                <div class="dropdown-content">
                    <a href="adminReg.php">
                        <h2>Admin</h2>
                    </a>
                    <a href="adminStaff.php">
                        <h2>Staff</h2>
                    </a>
                    <a href="adminStudent.php">
                        <h2>Student</h2>
                    </a>
                </div>
            </div>

            <img src="userimg.png" class="userimg">
            <div class="dropdown">
                <?php
                session_start(); // Start a session
                if (isset($_SESSION['name'])) {
                    $userName = $_SESSION['name'];
                    echo '<a href="info.php" class="dropdown-link"><h2>' . $userName . '</h2></a>';
                }
                ?>
                <div class="dropContent">
                    <a href="logOut.php" class="logout-button">LogOut</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>