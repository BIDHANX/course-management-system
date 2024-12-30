<?php
require 'adminHeader.php'; // Connection to header
?> 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<div class="headp"></div>
<div class="registration-container">
  <div class="registration-wrapper">
    <div class="registration-title">
      Admin Register
    </div>
    
    <form action="adminReg.php" method="POST">
      <div class="registration-form">
        <div class="registration-input">
          <input type="text" name="full_name" placeholder="Full Name" class="registration-input-field" required>
          <i class="fas fa-user"></i>
        </div>
        <div class="registration-input">
          <input type="text" name="email" placeholder="Email" class="registration-input-field" required>
          <i class="far fa-envelope"></i>
        </div>
        <div class="registration-input">
          <input type="password" name="password" placeholder="Password" class="registration-input-field" required>
          <i class="fas fa-lock"></i>
        </div>
        <div class="registration-btn">
          <input type="submit" name="submit" value="Register"> 
        </div>
      </div>
    </form>
  </div>
</div>


<?php

require 'db.php';
// Insert values into the admin table
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security (you should use password_hash in a real application)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert data
    $sql = "INSERT INTO admin (name, email, password) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    
    // Bind parameters and execute the statement
    $stmt->bind_param("sss", $full_name, $email, $hashed_password);
    
    if ($stmt->execute()) {
        echo 'Account created successfully';
    } else {
        echo 'Error creating account: ' . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
    
    // Close the database connection
    $connection->close();
}
?>