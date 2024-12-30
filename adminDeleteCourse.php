<?php
require 'adminHeader.php';
require 'db.php';

// Check if an ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];

    // Delete the course from the database based on the provided ID
    $deleteSql = "DELETE FROM course WHERE course_id = ?";
    $deleteStmt = $connection->prepare($deleteSql);
    $deleteStmt->bind_param('i', $courseId);

    if ($deleteStmt->execute()) {
        // Redirect back to the course list after successful deletion
        header("Location: adminCourse.php");
        exit();
    } else {
        echo "Error deleting course: " . $deleteStmt->error;
    }

    $deleteStmt->close();
} else {
    echo "Invalid request.";
}

// Close the database connection
$connection->close();
?>

