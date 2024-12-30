<?php
require 'adminHeader.php'; // Connection to header
?>
<div class="headp"></div>
<div class="registration-container">
    <div class="registration-wrapper">
        <a href="adminModule.php">
            <img src="return.png" class="image-link"> <h4>Return</h4>
        </a>
        <div class="registration-title">
            Add Module
        </div>
        <form action="adminAddModule.php" method="POST">
            <div class="registration-form">
                <div class="registration-input">
                    <input type="text" name="module_name" placeholder="Module Name" class="registration-input-field" required>
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
    $moduleName = $_POST['module_name'];
    $description = $_POST['description'];

    // Insert data into the database
    $sql = "INSERT INTO module (name, description) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);

    // Use 'ss' for three string placeholders
    $stmt->bind_param('ss', $moduleName, $description);

    if ($stmt->execute()) {
        // Redirect to a confirmation page with course details
        $redirectUrl = "adminModule.php?module_name=" . urlencode($moduleName) . "&description=" . urlencode($description);
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


