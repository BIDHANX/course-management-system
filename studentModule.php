<?php
require 'studentHeader.php'; // Include the student header or navigation bar
require 'db.php';

// Fetch all modules from the database
$sql = "SELECT module_id, name, description FROM module ORDER BY module_id ASC";
$result = $connection->query($sql);

// Initialize an array to store all module details
$modules = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $moduleId = $row['module_id'];
        $moduleName = $row['name'];
        $description = $row['description'];

        // Store module details in the array
        $modules[] = array(
            'module_id' => $moduleId,
            'module_name' => $moduleName,
            'description' => $description
        );
    }
} else {
    // Handle the case where no modules are found
    $modules[] = array(
        'module_id' => null,
        'module_name' => "N/A",
        'description' => "No modules found."
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
    <title>Student Modules</title>
</head>
<body>
<div class="course-wrapper">
    <h1>Modules</h1>

    <?php
    // Loop through and display all modules
    foreach ($modules as $module) {
        echo '<article>';
        echo '<div class="colorful-box"></div>';
        echo '<h1>Module ID: ' . $module['module_id'] . '</h1>';
        echo '<h2>' . $module['module_name'] . '</a></h2>';
        echo '<p>Description: ' . $module['description'] . '</p>';
        echo '</article>';
    }
    ?>
</div>
</body>
</html>
