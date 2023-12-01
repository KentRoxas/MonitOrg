<?php
include "include.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to check if the username and password exist in the database
    $sql = "SELECT * FROM tbdepacc WHERE deptUserN='$username' AND deptUserPass='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Username and password are correct, redirect to a secure page
        header("location: departmentdashboard.php");
    } else {
        
        echo "<script>alert('Invalid username or password');</script>";
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Event Tracking System</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function clearForm() {
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
        }
    </script>
</head>
<body>
    <header>
        <h1>DEPARTMENT</h1>
    </header>
    <div class="login-container">
        <form action="" method="post">
            <label for="username">USERNAME:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">PASSWORD:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">LOG IN</button>
        </form>
    </div>
</body>
</html>




