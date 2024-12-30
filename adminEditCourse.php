<?php
require 'adminHeader.php';
require 'db.php';

// Check if a course ID is provided in the query parameters
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    
    // Fetch the course details from the database based on the course ID
    $sql = "SELECT course_id, name, description FROM course WHERE course_id = ?";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $courseId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $courseName = $row['name'];
        $description = $row['description'];
    } else {
        // Handle the case where the course with the given ID doesn't exist
        echo "Course not found.";
        exit;
    }
    
    // Handle form submission to update course details
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newCourseName = $_POST['course_name'];
        $newDescription = $_POST['description'];
        
        // Update the course details in the database
        $updateSql = "UPDATE course SET name=?, description=? WHERE course_id=?";
        $updateStmt = $connection->prepare($updateSql);
        $updateStmt->bind_param("ssi", $newCourseName, $newDescription, $courseId);
        
        if ($updateStmt->execute()) {
            // Redirect back to adminCourse.php after updating
            header("Location: adminCourse.php");
            exit;
        } else {
            // Handle update error
            echo "Error updating course details: ";
        }
    }
} else {
    // Handle the case where no course ID is provided in the query parameters
    echo "Course ID not provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
</head>
<body>
<div class="headp"></div>
<div class="course-edit-form">
    <div class="registration-container">
    <div class="registration-wrapper">
        <a href="adminCourse.php">
            <img src="return.png" class="image-link"> <h4>Return</h4>
        </a>
        <div class="registration-title">
            Edit Course
        </div>
        <form action="adminEditCourse.php?id=<?php echo $courseId; ?>" method="post">
        <label for="course_name">Course Name:</label>
        <input type="text" name="course_name" id="course_name" value="<?php echo $courseName; ?>">
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="description"><?php echo $description; ?></textarea><br><br>
        
        <input type="submit" value="Update">
    </form>
    </div>
</div>

</div>
</body>
</html>

 