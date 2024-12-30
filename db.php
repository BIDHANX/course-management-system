
<?php
$server = "localhost";
$user = "root"; 
$password = "";     
$database = "assignment"; 

$connection = new mysqli($server, $user, $password, $database);

if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}
?>

