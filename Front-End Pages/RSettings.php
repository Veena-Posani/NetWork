<?php
//start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";
// Create connection
$conn = new mysqli('localhost', 'root', 'Adbms2023#', 'mydb');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['rid']))
{
    header("location: Home.html");
}

$rid = $_SESSION['rid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access all the fields with $_POST 
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $PhoneNumber = $_POST["PhoneNumber"];
    $PositionName = $_POST["PositionName"];
    $Password = $_POST["Password"];
    $EmailAddress = $_POST["EmailAddress"];
    //Access all details from the session
    $username = $_SESSION['username'];
    $table = $_SESSION['table'];
    $password = $_SESSION['password'];
    $rid = $_SESSION['rid'];
    // update statment for settings to update the fields in the database based on the provided fields
    $updateSql = "UPDATE $table SET RFirstName='$FirstName', RLastName='$LastName', PhoneNumber='$PhoneNumber', PositionName='$PositionName', EmailAddress = '$EmailAddress' WHERE RecruiterID='$rid'";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: ../Network/RecLogout.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
    <!-- External Cprofile for the background and href fields -->
    <link rel="stylesheet" href="Cprofile.css">
</head>
<body>
    <!-- In the settings to update the recruiter details we have used the update statement that will update the details of the provided
	given input fields of the recruiter from html -->
    <div class="background"></div>
	<div class="top-menu">
        <img src="NWlogo.png" class="nw" width="180" height="55">
		<a href="RProfile.php"><img src = "home.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">HOME</span></a>
		<a href="RecDisplay.php"><img src = "profile.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">PROFILE</span></a>
		<a href="Rnotifications.php?rid=<?php echo $rid?>"><img src = "noti.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">NOTIFICATIONS</span></a>
		<a href="RSettings.php"><img src = "settings.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">SETTINGS</span></a>
		<a href="../NetWork/RecLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
    </div>    
    <div class="middle-panel" style="margin: 50px auto; padding: 20px; width: 50%; background-color: rgba(255, 255, 255, 0.5); border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); text-align: center;">
        <form action="RSettings.php" method="POST">
            <!-- Input fields for the setting page and internal css for the page alignment -->
            <h1 style="font-size: 32px; margin-bottom: 20px;">SETTINGS</h1>
            <label for="FirstName" style="font-size: 24px;">First Name</label>
            <br>
            <input type="text" id="FirstName" name="FirstName" required style="font-size: 20px; padding: 10px; width: 80%; margin: 10px auto;">
            <br>

            <label for="LastName" style="font-size: 24px;">Last Name</label>
            <br>
            <input type="text" id="LastName" name="LastName" required style="font-size: 20px; padding: 10px; width: 80%; margin: 10px auto;">
            <br>

            <label for="PhoneNumber" style="font-size: 24px;">Phone Number</label>
            <br>
            <input type="tel" id="PhoneNumber" name="PhoneNumber" pattern="\+\d{11}" title="Please enter a valid phone number with a leading plus sign and 11 digits" style="font-size: 20px; padding: 10px; width: 80%; margin: 10px auto;" required>
            <br>

            <label for="PositionName" style="font-size: 24px;">Position Name</label>
            <br>
            <input type="text" id="PositionName" name="PositionName" required style="font-size: 20px; padding: 10px; width: 80%; margin: 10px auto;">
            <br>

            <label for="EmailAddress" style="font-size: 24px;">Email Address</label>
            <br>
            <input type="email" id="EmailAddress" name="EmailAddress" required style="font-size: 20px; padding: 10px; width: 80%; margin: 10px auto;">
            <br>

      <button type="submit" style="font-size: 24px; padding: 15px; margin-top: 20px;">Save </button>
        </form>
    </div>
</body>
</html>
