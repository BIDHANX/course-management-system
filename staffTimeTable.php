<?php
require 'staffHeader.php';
require 'db.php';

// Handle form submission for deletion
if (isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    // Delete the timetable entry from the database
    $deleteSql = "DELETE FROM timetable WHERE id = ?";
    
    // Prepare the delete statement
    $stmt = $connection->prepare($deleteSql);
    $stmt->bind_param('i', $deleteId);

    if ($stmt->execute()) {
        header("Location: staffTimeTable.php"); // Redirect to the timetable after deleting
        exit;
    } else {
        echo "Error deleting timetable entry: " . $stmt->error;
    }
}

// Handle form submission for adding/updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $timeSlot = $_POST['time_slot'];
    $subject = $_POST['subject'];
    $day = $_POST['day'];

    // Check if a row with the same time slot exists
    $checkSql = "SELECT * FROM timetable WHERE time_slot = ?";
    
    // Prepare the select statement
    $stmt = $connection->prepare($checkSql);
    $stmt->bind_param('s', $timeSlot);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the existing row
        $existingRow = $result->fetch_assoc();

        // Update the subject for the specified day in the existing row
        $existingRow[$day] = $subject;

        // Update the existing row in the database
        $updateSql = "UPDATE timetable SET sunday = ?, 
                                            monday = ?, 
                                            tuesday = ?, 
                                            wednesday = ?, 
                                            thursday = ?, 
                                            friday = ? 
                      WHERE time_slot = ?";
        
        // Prepare the update statement
        $stmt = $connection->prepare($updateSql);
        $stmt->bind_param('sssssss', $existingRow['sunday'], $existingRow['monday'], $existingRow['tuesday'], $existingRow['wednesday'], $existingRow['thursday'], $existingRow['friday'], $timeSlot);

        if ($stmt->execute()) {
            echo "Timetable entry updated successfully.";
        } else {
            echo "Error updating timetable entry: " . $stmt->error;
        }
    } else {
        // Insert a new row if the time slot doesn't exist
        $insertSql = "INSERT INTO timetable (time_slot, $day) VALUES (?, ?)";
        
        // Prepare the insert statement
        $stmt = $connection->prepare($insertSql);
        $stmt->bind_param('ss', $timeSlot, $subject);

        if ($stmt->execute()) {
            echo "Timetable entry added successfully.";
        } else {
            echo "Error adding timetable entry: " . $stmt->error;
        }
    }
}

// Retrieve timetable data from the database and order it by time_slot
$selectSql = "SELECT * FROM timetable ORDER BY time_slot ASC";
$result = $connection->query($selectSql);

?>
 <?php
    if ($result->num_rows > 0) {
        echo '<table class="timetable">';
        echo '<tr>';
        echo '<th>Time Slot</th>';
        echo '<th>Sunday</th>';
        echo '<th>Monday</th>';
        echo '<th>Tuesday</th>';
        echo '<th>Wednesday</th>';
        echo '<th>Thursday</th>';
        echo '<th>Friday</th>';
        echo '<th>Action</th>'; // Add a new column for actions
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['time_slot'] . '</td>';
            echo '<td>' . $row['sunday'] . '</td>';
            echo '<td>' . $row['monday'] . '</td>';
            echo '<td>' . $row['tuesday'] . '</td>';
            echo '<td>' . $row['wednesday'] . '</td>';
            echo '<td>' . $row['thursday'] . '</td>';
            echo '<td>' . $row['friday'] . '</td>';
            echo '<td>';
            echo '<form action="AdminTimeTable.php" method="post">';
            echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
            echo '<input type="submit" value="Delete">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No timetable entries found.</p>';
    }

    $connection->close();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Timetable</title>
    
</head>
<body>
<form action="staffTimeTable.php" method="post" class="timetable-form">
    <label for="time_slot">Time Slot:</label>
    <input type="text" id="time_slot" name="time_slot" required>
    
    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject" required>
    
    <label for="day">Day:</label>
    <select id="day" name="day" required>
        <option value="sunday">Sunday</option>
        <option value="monday">Monday</option>
        <option value="tuesday">Tuesday</option>
        <option value="wednesday">Wednesday</option>
        <option value="thursday">Thursday</option>
        <option value="friday">Friday</option>
        <!-- Add options for other days -->
    </select>

    <input type="submit" value="Add/Update">
</form>
</body>
</html>
