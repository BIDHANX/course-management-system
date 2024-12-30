<?php
require 'adminHeader.php';
require 'db.php';

// Check if a course ID is provided in the query parameters
if (isset($_GET['id'])) {
    $moduleId = $_GET['id'];
    
    // Fetch the course details from the database based on the course ID
    $sql = "SELECT module_id, name, description FROM module WHERE module_id = ?";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $moduleId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $moduleName = $row['name'];
        $description = $row['description'];
    } else {
        // Handle the case where the course with the given ID doesn't exist
        echo "Course not found.";
        exit;
    }
    
    // Handle form submission to update course details
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newModuleName = $_POST['module_name'];
        $newDescription = $_POST['description'];
        
        // Update the course details in the database
        $updateSql = "UPDATE module SET name=?, description=? WHERE module_id=?";
        $updateStmt = $connection->prepare($updateSql);
        $updateStmt->bind_param("ssi", $newModuleName, $newDescription, $moduleId);
        
        if ($updateStmt->execute()) {
            // Redirect back to adminCourse.php after updating
            header("Location: adminModule.php");
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
<div class="course-edit-form">
<div class="registration-wrapper">
        <a href="adminModule.php">
            <img src="return.png" class="image-link"> <h4>Return</h4>
        </a>
        <div class="registration-title">
            Edit Module
        </div>
        <form action="adminEditModule.php?id=<?php echo $moduleId; ?>" method="post">
        <label for="module_name">Module Name:</label>
        <input type="text" name="module_name" id="moudle_name" value="<?php echo $moduleName; ?>">
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="description"><?php echo $description; ?></textarea><br><br>
        
        <input type="submit" value="Update">
    </form>
    </div>
</div>
</body>
</html>
   