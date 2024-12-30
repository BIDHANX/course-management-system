<?php
require 'adminHeader.php';
require 'db.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    
    // Fetch course details based on the 'id' parameter
    $sql = "SELECT course_id, name, description, tutor FROM course WHERE course_id = $courseId";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseId = $row['course_id'];
        $courseName = $row['name'];
        $description = $row['description'];
        $tutorName = $row['tutor']; // Fetch the tutor's name from the database
    } else {
        // Handle the case where the course with the specified ID is not found
        echo 'Course not found.';
    }
} else {
    // Handle the case where the 'id' parameter is not set
    echo 'Invalid request.';
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Course</title>
</head>
<body>
        <a href="adminCourse.php">
            <img src="return.png" class="img-link"> <h5>Return</h5>
        </a>
    <div class="course-wrap">
    
    <div class="image-container">
        <img src="home11.jpg" alt="Woodland University" class="courseimg">
    </div>
    <div class="details-container">
        <h1>Course ID: <?php echo $courseId; ?></h1>
        <h2>Course Name: <?php echo $courseName; ?></h2>
        <p>Description: <?php echo $description; ?></p>
       
    </div>
    <div class="dc">
        <h2>Tutor: <?php echo $tutorName; ?></h2>
    </div>
     
</div>

</body>
</html>
