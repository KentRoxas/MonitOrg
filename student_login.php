<?php
include "include.php";

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
        
.create-container{max-width: 400px;
    margin: 100px auto;
    padding: 20px;
    background-color: rgba(175, 152, 76, 0.8);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border: 2px solid #333;}
form {
    text-align: center;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="text"],
select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.check-in-button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.check-in-button:hover {
    background-color: #45a049;
}
.Exit_button{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}
#exit-button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;}
#exit-button:hover {
    background-color: #45a049;
}          
    </style>
</head>
<body>

    <div class="background-cover"></div>

    <header>
        <div class="header-content">
            <h1>STUDENT VIEW EVENT</h1>
        </div>
    </header>

    <div class="create-container">
        <form action="checkin.php" method="POST">
            <div style="text-align: center;">
                <label for="section">Enter Section:</label>
                <input type="text" id="section" name="section">
                
                <label for="department">Enter Department:</label>
                <input type="text" id="department" name="department">
            </div>

            <div class="button-container">
                
                <select id="eventName" name="eventName" >
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
            <div class="buttons">
            <button class="check-in-button">CHECK IN</button>
            </div>
            
        </form>
        <div class="Exit_button">
        <button id="exit-button">EXIT</button>
    </div>
        
</body>
<script>
     document.getElementById("exit-button").addEventListener("click", function() {

window.location.href = "view_event.php";
});
</script>
</html>