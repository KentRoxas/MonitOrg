<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>VIEW EVENT</title>
    <style>
        /* CSS styles for the create events UI */
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

        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
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

table {
    width: 80%;
    margin: 20px auto;
    border-collapse: collapse;
}

thead {
    background-color: greenyellow;
    color: black;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.create-button {
            background-color: greenyellow;
            color: black;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .create-button:hover {
            background-color: whitesmoke;
        }

        .alert {
            background-color: #f2f2f2;
            color: #333;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        /* Optional: Style the page container */
        .page-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Add new style for button container */
        .button-container {
            text-align: center;
        }

</style>
    <body>

<div class="background-cover"></div>

<header>
    <div class="header-content">
        <h1>STUDENT VIEW EVENT</h1>
    </div>
</header>

    </head>
        <table>
        <thead>
            <tr>
                <th>Event Where</th>
                <th>Event When</th>
                <th>Event What</th>
                <th>Event Who</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Establish a database connection (replace these with your database credentials)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_sm3101";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to fetch data from the database table tbeventdetail
            $sql = "SELECT eventWhere, eventWhen, eventWhat, eventWho FROM tbeventdetail";

            // Execute the query and display data in the table
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["eventWhere"]. "</td><td>" . $row["eventWhen"]. "</td><td>" . $row["eventWhat"]. "</td><td>" . $row["eventWho"]. "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No events found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>
    <div class="button-container">
        <button class="create-button" onclick="exitEvent()">EXIT</button>
        <button class= "create-button" onclick="attendEvent()">Attend</button>
    </div>

 <script>
        function exitEvent() {
            alert('Exit button clicked!');
            window.location.href = 'attendanceportal.php';
        }
        function attendEvent() {
            alert('proceeding to login page!');
            window.location.href = 'student_login.php';
        }
    </script>

</body>

</html>