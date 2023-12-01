<?php
include "include.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $section = $_POST['section'];
    $department = $_POST['department'];
    $eventName = $_POST['eventName'];

    // Fetch the srCode from the session or wherever it is stored
    // For example, if it's stored in a session variable:
    session_start();
    $srCode = $_SESSION['srCode'];

    // Get the current date and time
    $evdate = date("Y-m-d");
    $evtime = date("H:i:s");

    // Insert data into tbeventview table
    $insertQuery = "INSERT INTO tbeventview (section, deptName, eventWhat, evdate, evtime, srCode) VALUES ('$section', '$department', '$eventName', '$evdate', '$evtime', '$srCode')";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ... (previous code)
    
        if ($conn->query($insertQuery) === TRUE) {
            // Check-in successful
            echo "<script>alert('Check-in successful!');</script>";
            
            // Delay the redirection by 2 seconds (adjust as needed)
            echo "<script>setTimeout(function(){ window.location.href = 'student_login.php'; }, 2000);</script>";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid request method!";
    }
}
$conn->close();
?>

