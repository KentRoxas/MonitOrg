<?php
// Replace these values with your database connection details
$host = "localhost";
$username = "root";
$password = "";
$database = "db_sm3101";

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the list of courses from tbstudent
$courses = $conn->query("SELECT DISTINCT course FROM tbstudent");
$events = $conn->query("SELECT DISTINCT eventWhat FROM tbeventview");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedCourse = $_POST["course"];
    $selectedEvent = $_POST["event"];

    // SQL query to retrieve filtered data from tbstudent and tbeventview
    $sql = "SELECT tbstudent.srCode, tbstudent.course, tbstudent.section, 
                   IFNULL(tbeventview.eventWhat, 'No attendance') AS eventWhat, 
                   IFNULL(tbeventview.evtime, 'No attendance') AS evtime
            FROM tbstudent
            LEFT JOIN tbeventview ON tbstudent.srCode = tbeventview.srCode
            WHERE tbstudent.course = '$selectedCourse'";

    // Add a condition for the selected event
    if (!empty($selectedEvent)) {
        $sql .= " AND tbeventview.eventWhat = '$selectedEvent'";
    }

    $result = $conn->query($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VIEW ATTENDEES</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .background-cover {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('bg.png') no-repeat center;
            background-size: cover;
            opacity: 0.6;
            z-index: -1;
        }

        header {
            background-color: rgba(230, 224, 224, 0.6);
            color: black;
            text-align: left;
            font-family: 'Times New Roman', Times, serif;
            font-size: x-large;
            padding: 5px 0;
            margin-top: 20px;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            background-color: #E7DFD8;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }

        .container form {
            text-align: left;
        }

        .container form img {
            display: block;
            margin: 0;
            margin-bottom: 20px; 
            max-width: 50px; 
            max-height: 50px;
            margin-left: 57px; 
        }

        .container .search-container {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container .search-container label {
            flex: 1;
            margin-right: 10px;
            font-weight: bold;
        }

        .container .search-container select {
            flex: 2;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .container .search-container button {
            flex: 1;
            padding: 8px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .container .datalist-view {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .container .datalist-view th, .container .datalist-view td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .container .datalist-view th {
            background-color: #f2f2f2;
        }

        .container textarea {
            width: calc(100% - 18px);
            height: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 8px;
            resize: vertical;
            margin-top: 10px;
        }

        .container .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .container .button-container button {
            width: 130px;
            height: 50px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .container .button-container .print-exit-buttons {
            display: flex;
        }

        .container .button-container .print-exit-buttons button {
            width: 100px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="background-cover"></div>
<header>
    <div class="header-content">
        <h1 style="font-weight: bold;">VIEW ATTENDANCE</h1>
    </div>
</header>

<div class="container">
<form method="post" action="">
    <!-- Dropdown menu for selecting course -->
    <label for="course">Select Course:</label>
    <select name="course">
        <?php
        // Populate dropdown with course options
        while ($row = $courses->fetch_assoc()) {
            echo "<option value='" . $row["course"] . "'>" . $row["course"] . "</option>";
        }
        ?>
    </select>

   <!-- Dropdown menu for selecting eventWhat -->
   <label for="event">Select Event:</label>
    <select name="event">
        <option value="">All Events</option>
        <?php
        // Populate dropdown with event options
        while ($row = $events->fetch_assoc()) {
            echo "<option value='" . $row["eventWhat"] . "'>" . $row["eventWhat"] . "</option>";
        }
        ?>
    </select>
    <button type="submit">Search</button>
</form>

    <table class="datalist-view">
                <tr>
                    <th>SR-CODE</th>
                    <th>COURSE</th>
                    <th>SECTION</th>
                    <th>EVENT NAME</th>
                    <th>Check-in Time</th>
                </tr>

                <?php
                
                // Display data in the table if result is available
                if (isset($result) && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["srCode"] . "</td>";
                        echo "<td>" . $row["course"] . "</td>";
                        echo "<td>" . $row["section"] . "</td>";
                        echo "<td>" . $row["eventWhat"] . "</td>";
                        echo "<td>" . $row["evtime"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </table>
        

            <div class="button-container">
    <div class="print-exit-buttons">
        <button type="button" id="printButton">Print</button>
        <button type="button" id="exitButton">Exit</button>
        <form method="post" action="deletereport.php">
        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete all event details?')">Reset the Attendance</button>
    </form>
    </div>
  
    <script>
    document.getElementById("exitButton").addEventListener("click", function() {
        // Show the alert
        alert("You are now going to View attendance");

        // Redirect to view_data.php
        window.location.href = "view_data.php";
    });

    // You can add any additional JavaScript logic here

</script>
</form>
</div>
</body>
</html>