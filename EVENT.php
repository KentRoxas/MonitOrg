<?php
// Include your database connection code (replace 'include.php' with your actual file)
include "include.php";

// SQL query to retrieve event data from the database
$sql = "SELECT eventWhat FROM tbeventdetail";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Output an empty default option
    echo '<option value="" disabled selected>Select an event</option>';
    
    // Fetch associative array of the result
    while ($row = mysqli_fetch_assoc($result)) {
        // Output option element for each eventWhat value in the database
        echo '<option value="' . htmlspecialchars($row['eventWhat']) . '">' . htmlspecialchars($row['eventWhat']) . '</option>';
    }
} else {
    // Handle the query error if necessary
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
