<?php
include "include.php";
// Fetch department options from tbstudent table
$deptQuery = "SELECT DISTINCT deptName FROM tbdepartment";
$deptResult = $conn->query($deptQuery);

// Fetch section options from tbstudent table
$sectionQuery = "SELECT DISTINCT section FROM tbstudent";
$sectionResult = $conn->query($sectionQuery);
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
            margin-right: 20px;
            font-weight: bold;
        }

        .container .search-container select {
            flex: 2;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }


        .container table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.container th, .container td {
    border: 2PX solid #ddd;
    padding: 2px;
    text-align: left;
}

.container th {
    background-color: #f2f2f2;
}

/* Style for form elements */
.container form {
    text-align: left;
}

.container label {
    font-weight: bold;
}

.container select {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    margin-bottom: 10px;
}

/* Style for buttons */
.buttons {
    margin-top: 20px;
    text-align: center;
}

.buttons button {
    margin-right: 10px;
    padding: 15px 32px;
    font-size: 15px;
    cursor: pointer;
    border-radius: 8px;
}

#reportButton {
    background-color: #4CAF50;
    /* Bootstrap's primary color */
    color: white;
    border: none;
}

#reportButton:hover {
    background-color: #45a049;
    /* Darker color on hover */
}

#exitButton {
    background-color: #4CAF50;
    color: white;
    border: none;
}

#exitButton:hover {
    background-color: #45a049;
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
            <div class="search-container">
                <label for="eventName" style="width: 20%">Search Event Name:</label>
                <select id="eventName" name="eventName" style="width: 80%">
                    <?php
                    // Fetch event names from tbeventdetail table
                    $eventQuery = "SELECT DISTINCT eventWhat FROM tbeventdetail";
                    $eventResult = $conn->query($eventQuery);

                    // Populate event dropdown options
                    while ($row = $eventResult->fetch_assoc()) {
                        echo "<option value='" . $row['eventWhat'] . "'>" . $row['eventWhat'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="search-container">
                <label for="course" style="width: 20%">Search Department:</label>
                <select id="course" name="department" style="width: 80%">
                    <?php
                    // Populate department dropdown options
                    while ($row = $deptResult->fetch_assoc()) {
                        echo "<option value='" . $row['deptName'] . "'>" . $row['deptName'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="search-container">
                <label for="section" style="width: 20%">Search Section:</label>
                <select id="section" name="section" style="width: 80%">
                    <?php
                    // Populate section dropdown options
                    while ($row = $sectionResult->fetch_assoc()) {
                        echo "<option value='" . $row['section'] . "'>" . $row['section'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Search">
        </form>

        <?php
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $department = $_POST['department'];
            $section = $_POST['section'];
            $eventName = $_POST['eventName']; // New line to retrieve selected event name
                // Query to fetch data from tbeventview table based on the selected department, section, and event
                $sql = "SELECT srCode, section, deptName, eventWhat, evdate, evtime FROM tbeventview WHERE deptName = ? AND section = ? AND eventWhat = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $department, $section, $eventName);
                $stmt->execute();
                $result = $stmt->get_result();
            
                // Display the table header
                echo "<table border='1'>
                        <tr>
                            <th>srCode</th>
                            <th>Section</th>
                            <th>Dept Name</th>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Check-in</th>
                        </tr>";
            
                // Display the data in the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["srCode"] . "</td>
                            <td>" . $row["section"] . "</td>
                            <td>" . $row["deptName"] . "</td>
                            <td>" . $row["eventWhat"] . "</td>
                            <td>" . $row["evdate"] . "</td>
                            <td>" . $row["evtime"] . "</td>
                        </tr>";
                }
            
                // Close the table
                echo "</table>";
            
                // Close the statement
                $stmt->close();
            }
            
            // Close the database connection
            $conn->close();
            ?>



            
        
    </div>
</body>

</html>

<?php
// Close the database connection

?>
<div class="buttons">
    <button id="reportButton">Report</button>
    <button id="exitButton">Exit</button>
</div>

<script>
    // JavaScript code to handle button click event
    document.getElementById("exitButton").addEventListener("click", function() {
        // Redirect to dashboard.php
        window.location.href = "admindashboard.php";
    });

    document.getElementById("reportButton").addEventListener("click", function() {

        window.location.href = "reportadmin.php";
    });
</script>
</div>

</body>

</html>