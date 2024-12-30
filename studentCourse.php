<?php
require 'studentHeader.php'; // Include the student header or navigation bar
require 'db.php';

// Fetch all courses from the database
$sql = "SELECT course_id, name, description FROM course ORDER BY course_id ASC";
$result = $connection->query($sql);

// Initialize an array to store all course details
$courses = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courseId = $row['course_id'];
        $courseName = $row['name'];
        $description = $row['description'];

        // Store course details in the array
        $courses[] = array(
            'course_id' => $courseId,
            'course_name' => $courseName,
            'description' => $description
        );
    }
} else {
    // Handle the case where no courses are found
    $courses[] = array(
        'course_id' => null,
        'course_name' => "N/A",
        'description' => "No courses found."
    );
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Courses</title>
</head>
<body>
<div class="course-wrapper">
    <h1>Courses</h1>

    <?php
    // Loop through and display all courses
    foreach ($courses as $course) {
        echo '<article>';
        echo '<div class="colorful-box"></div>';
        echo '<h1>Course ID: ' . $course['course_id'] . '</h1>';
        echo '<h2><a href="courseDetails.php?id=' . $course['course_id'] . '">' . $course['course_name'] . '</a></h2>';
        echo '<p>Description: ' . $course['description'] . '</p>';
        echo '</article>';
    }
    ?>
</div>
</body>
</html>
