<?php
include "include.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to insert data into tbadmin table
    $sql = "INSERT INTO tbdepacc (deptUserN, deptUserPass) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>ADMIN </title>
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
        <h1>ADMIN</h1>
    </header>
    <div class="login-container">
        <form action="" method="post">
            <label for="username">USERNAME:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">PASSWORD:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">CREATE ACCOUNT</button>
            
        </form>
        <a href="admindashboard.php" class="button">Return</a>
    </div>
</body>
</html>