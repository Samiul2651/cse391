<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f5f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
  }
  .container {
    max-width: 500px; /* Increased max-width */
    padding: 20px;
    background-color: #e3f2fd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  .form-group {
    margin-bottom: 15px;
  }
  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  input[type="text"],
  input[type="password"] {
    width: 75%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-right: 5px;
  }
  .submit-container {
    text-align: left;
  }
  input[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  input[type="submit"]:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>

<div class="container">
  <h2>Login</h2>
  <form action="" method="POST">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" name="password" required>
    </div>
    <div class="submit-container">
      <input type="submit" name="submit" value="Login">
    </div>
  </form>
</div>

<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header("Location: restricted_page.php");
    exit();
}

if(isset($_POST['submit'])) {
    
    include 'db.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['authenticated'] = true;
        
        header("Location: teacher.php");
        exit();
    } else {
        
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }

    $conn->close();
}
?>

</body>
</html>
