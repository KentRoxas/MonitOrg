<?php
include "include.php";

if(isset($_POST['submit'])) {
    // Get form data
    $eventWhere = $_POST['event-where'];
    $eventWhen = $_POST['event-when'];
    $eventWhat = $_POST['event-what'];
    $eventWho = $_POST['eventWho'];

    // Insert data into the tbeventdetail table
    $sql = "INSERT INTO tbeventdetail (eventWhere, eventWhen, eventWhat, eventWho) VALUES ('$eventWhere', '$eventWhen', '$eventWhat', '$eventWho')";

    if(mysqli_query($conn, $sql)) {
        echo'<script>alert("Event created successfully");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    

    // Close the database connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CREATE EVENTS</title>
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

        .create-container {
            width: 350px;
            margin: 0 auto;
            background-color: #E7DFD8;
            padding: 20px;
            border-radius: 10px;
            margin-top: 70px; /* Adjusted margin-top value */
            text-align: center;
        }

        .create-container button {
            width: 40%;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-right: 10px;
        }

        .create-container span {
            width: 40%;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-right: 10px;
        }

        .create-container span:nth-of-type(odd) {
            background-color: #9B1F1C; /* Setting odd-indexed buttons' background color */
            color: white; /* Setting odd-indexed buttons' text color */
        }

        .create-container button:nth-of-type(3) {
            background-color: #541A18; /* Setting the third button's background color */
            color: white; /* Setting the third button's text color */
        }

        .create-container input[type="text"] {
            width: 50%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        .create-container .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .create-container .button-container button {
            width: 45%;
            background-color: #541A18; /* Setting the "Clear" button's background color */
            color: white; /* Setting the "Clear" button's text color */
        }

        .create-container form img {
            display: block;
            margin: 0;
            margin-bottom: 20px;
            max-width: 30px;
            max-height: 30px;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<div class="background-cover"></div>

<header>
    <div class="header-content">
        <h1>CREATE EVENT</h1>
    </div>
</header>

<div class="create-container">
    <form action="" method="post" >
        <div style="text-align: left;">
            <img src="ICON.png" alt="Icon">
        </div>
        <div class="button-container">
            <span style="background-color: #9B1F1C;">WHERE</span>
            <input type="text" id="event-where" name="event-where" placeholder="Event Location">
        </div>
        <div class="button-container">
            <span style="background-color: #9B1F1C;">WHEN</span>
            <input type="text" id="event-when" name="event-when" placeholder="Event Date">
        </div>
        <div class="button-container">
            <span style="background-color: #9B1F1C;">WHAT</span>
            <input type="text" id="event-what" name="event-what" placeholder="Event Name">
        </div>
        <div class="button-container">
            <span style="background-color: #9B1F1C;">WHO</span>
            <input type="text" id="eventWho" name="eventWho" placeholder="Who are invited ">
        </div>
    
        <div class="button-container">
    <button style="width: 30%;" onclick="clearFields()">CLEAR</button>
    <button type="submit" class="btn btn-success" name="submit">Save</button>
    <a href="departmentdashboard.php"><button type="button" style="background-color: green; color: white; width: 100%;">Exit</button></a>
</div>

</form>

</body>
</html>
   