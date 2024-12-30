<?php
require 'adminHeader.php';
require 'db.php';

// Fetch all courses from the database
$sql = "SELECT module_id, name, description FROM module ORDER BY module_id ASC";
$result = $connection->query($sql);

// Initialize an array to store all course details
$modules = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $moduleId = $row['module_id'];
        $moduleName = $row['name'];
        $description = $row['description'];

        // Store course details in the array
        $modules[] = array(
            'module_id' => $moduleId,
            'module_name' => $moduleName,
            'description' => $description
        );
    }
} else {
    // Handle the case where no courses are found
    $modules[] = array(
        'module_id' => null,
        'module_name' => "N/A",
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
    <title>Admin Course</title>
</head>
<body>
<div class="course-wrapper">
    <div class="cc">
        <a href="adminAddModule.php"><button>ADD MODULE</button></a>
    </div>
    <h1>Modules</h1>

    <?php
    // Loop through and display all courses
    foreach ($modules as $module) {
        echo '<article>';
        echo '<div class="colorful-box"></div>';
        echo '<h1>Module ID: ' . $module['module_id'] . '</h1>';
        echo '<h2>' . $module['module_name'] . '</a></h2>';
        echo '<p>Description: ' . $module['description'] . '</p>';

        if ($module['module_id'] !== null) {
            // Wrap "Edit" and "Delete" links in a span with a common class
            echo '<span class="edit-delete-links">';
            echo '<a href="adminDeleteModule.php?id=' . $module['module_id'] . '">Delete</a>';
            echo '</span>';
            echo '<span class="edit-del-links">';
            echo '<a href="adminEditModule.php?id=' . $module['module_id'] . '">Edit</a>';
        }
        echo '</article>';
    }
    ?>
</div>
</body>
</html>
