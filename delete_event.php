<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sm3101";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete request is sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eventID"])) {
    $eventID = $_POST["eventID"];

    // Perform the deletion
    $deleteSql = "DELETE FROM tbeventdetail WHERE eventID = $eventID";
    if ($conn->query($deleteSql) === TRUE) {
        // Deletion successful
        echo "Event deleted successfully";
    } else {
        // Error in deletion
        echo "Error deleting event: " . $conn->error;
    }

    // Close the database connection and exit
    $conn->close();
    exit();
}
$sql = "SELECT eventId, eventWhere, eventWhen, eventWhat, eventWho FROM tbeventdetail";
$result = $conn->query($sql);
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EVENT LIST</title>
    <style>
        /* CSS styles for the event list UI */
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

        .header-content {
            margin-left: 20px;
        }

        .event-list-container {
            width: 700px; /* Adjusted width for better display */
            margin: 0 auto;
            background-color: #E7DFD8;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            text-align: center;
        }

        .event-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            display: flex;
            justify-content: space-between; /* Align items to the start and end of the container */
            align-items: flex-start;
        }

        .event-item p {
            margin: 5px 0;
            text-align: left; /* Align text to the left within each paragraph */
        }

        .event-item button {
            background-color: #541A18;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .exitbutton {
    text-align: center;
    margin-top: 20px; /* Adjust as needed */
}

.create-button {
    background-color: #4CAF50;
    /* You can customize the button's appearance */
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .delete-button {
            background-color: #ff3333;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="background-cover"></div>

<header>
    <div class="header-content">
        <h1>EVENT LIST</h1>
    </div>
</header>
<div class="event-list-container">
    <table>
        <tr>
            <th>Event ID</th>
            <th>Event Where</th>
            <th>Event When</th>
            <th>Event What</th>
            <th>Event Who</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['eventId']}</td>
                        <td>{$row['eventWhere']}</td>
                        <td>{$row['eventWhen']}</td>
                        <td>{$row['eventWhat']}</td>
                        <td>{$row['eventWho']}</td>
                        <td><button class='delete-button' onclick='deleteEvent({$row['eventId']})'>Delete</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No events found</td></tr>";
        }
        ?>
    </table>
</div>


<div class= "exitbutton">
<button class="create-button" onclick="exitEvent()">EXIT</button>
</div>
<script>
     function deleteEvent(eventID) {
        if (confirm("Are you sure you want to delete this event?")) {
            // Use AJAX to send the event ID to the PHP script for deletion
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Show the response (success or error message)
                    location.reload(); // Reload the page after deletion
                }
            };
            xhr.send("eventID=" + eventID);
        }
    }

function exitEvent() {
            alert('Exit button clicked!');
            window.location.href = 'departmentdashboard.php';
        }
</script>
</body>

</html>
<?php
// Close the database connection
$conn->close();
?>
