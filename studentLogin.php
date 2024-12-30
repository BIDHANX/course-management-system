

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Woodlands University College</title>
  <link rel="stylesheet" href="gp.css">
</head>
<body>
    
    <div class="container2">
        <img src="logo.png" alt="Logo" id="logoL3">
    <img src="home3.jpg" alt="Logo" id="logoL"> 
   </div>
    <div class="container">
         <img src="logo.png" alt="Logo" id="logoL2">
        <h2 class="til"> WOODLANDS UNIVERSITY</h2>
    </div>
     <h3 class="college">COLLEGE</h3>
     <h6 class="college2">Sign in with your University Account</h6>  
   
     <form action="studentLogin.php" method="POST" class="login-form">
  <input type="text" id="id" name="id" placeholder="ID" required><br><br>
  <input type="password" id="password" name="password" placeholder="Password" required><br><br>
  <input type="submit" value="Sign In" class="submit">
</form>


</body>
</html>


<?php
session_start(); // Start a session

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];

    // Query the database using prepared statement to get user by ID
    $sql = "SELECT * FROM student WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            // Authentication successful, set session variables
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            header("Location: studentHome.php"); // Redirect to the home page
            exit();
        }
    }

    // Authentication failed, display an error message
    echo "Invalid ID or password.";
}

$connection->close();
?>