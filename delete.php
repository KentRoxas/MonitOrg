<?php
include "include.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Assuming your table name is 'tbeventdetail'
    $sql = "TRUNCATE TABLE tbeventview"; // This query deletes all rows from the table

    if ($conn->query($sql) === TRUE) {
        echo'<script>alert("Event created successfully");</script>';

        // Redirect back to reportadmin.php
        header("Location: reportadmin.php");
    } else {
        echo "Error deleting event details: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
