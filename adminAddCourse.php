<?php
require 'adminHeader.php'; // Connection to header
?>
<div class="headp"></div>
<div class="registration-container">
    <div class="registration-wrapper">
        <a href="adminCourse.php">
            <img src="return.png" class="image-link"> <h4>Return</h4>
        </a>
        <div class="registration-title">
            Add Course
        </div>
        <form action="adminAddCourse.php" method="POST">
            <div class="registration-form">
                <div class="registration-input">
                    <input type="text" name="course_name" placeholder="Course Name" class="registration-input-field" required>
                </div>
                <div class="registration-input">
                    <input type="text" name="tutor_name" placeholder="Tutor" class="registration-input-field" required>
                </div>
                <div class="registration-input">
                    <textarea name="description" placeholder="Enter your description" class="description" required></textarea>
                </div>
                <div class="registration-btn">
                    <input type="submit" name="submit" value="Register">
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// Include the database connection file
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $courseName = $_POST['course_name'];
    $description = $_POST['description'];
    $tutorName = $_POST['tutor_name'];

    // Insert data into the database
    $sql = "INSERT INTO course (name, description, tutor) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Use 'sss' for three string placeholders
    $stmt->bind_param('sss', $courseName, $description, $tutorName);

    if ($stmt->execute()) {
        // Redirect to a confirmation page with course details
        $redirectUrl = "adminCourse.php?course_name=" . urlencode($courseName) . "&description=" . urlencode($description);
        header("Location: " . $redirectUrl);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$connection->close();
?>


