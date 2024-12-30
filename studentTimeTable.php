<?php
require 'studentHeader.php';
require 'db.php';

// Retrieve timetable data from the database and order it by time_slot
$selectSql = "SELECT * FROM timetable ORDER BY time_slot ASC";
$result = $connection->query($selectSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Timetable</title>
</head>
<body>
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
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No timetable entries found.</p>';
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
