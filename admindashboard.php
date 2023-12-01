<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
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

        .header-content {
            margin-left: 20px;
        }

        .container {
            width: 350px;
            margin: 0 auto;
            background-color: #E7DFD8;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            text-align: center;
        }

        .container button {
            width: 50%;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .container button.create-account {
            background-color: green;
            color: white;
        }

        .container button.view-attendance {
            background-color: #541A18;
            color: white;
        }
        
        .container button.logout {
            background-color: #541A18;
            color: white;
            position: center;
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

        .container .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .container .button-container button {
            width: 45%;
        }

        .container .button-container p {
            width: 45%;
            font-size: 14px;
            margin: 0;
            text-align: left;
        }
        .container button.delete-event {
            background-color: #541A18;
            color: white;
            width: 45%;
            padding: 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
}

    </style>
    </style>
</head>
<body>

<div class="background-cover"></div>

<header>
    <div class="header-content">
        <h1>ADMIN</h1>
    </div>
</header>

<div class="container">
    <form>
        <div style="text-align: center;">
            <img src="ICON.png" alt="Icon">
        </div>
        <div class="button-container">
            <button class="create-account" type="button" onclick="goTocreateAccount()">CREATE</button>
            <p>Create Account Button - Click to create Department Account </p>
        </div>
        <div class="button-container">
            <button class="view-attendance" type="button" onclick="viewAttendance()">VIEW</button>
            <p>View Attendance Button - Click to view attendance </p>
        </div>
        
        <div class="button-container">
            <button class="logout" type="button" onclick="logout()">LOG OUT</button>
            
        </div>
    </form>
</div>
<script>
    function goTocreateAccount() {
        window.location.href = 'create_account.php';
    }
    function viewAttendance(){
        window.location.href = "viewdept.php";
    }
    function logout(){
        window.location.href = "adminportal.php"
    }
</script>

</body>
</html>