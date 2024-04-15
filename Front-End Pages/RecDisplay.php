<!DOCTYPE html>
<html>
<head>
    <title>Recruiter Profile Display</title>
	<link rel="stylesheet" href="Cprofile.css">
    <?php
		session_start();

		$servername = "localhost";
		$username = "root";
		$password = "Adbms2023#";
		$dbname = "mydb";

		$conn = new mysqli('localhost','root','Adbms2023#','mydb');
		//$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
        if (!isset($_SESSION['rid']))
		{
		  header("location: Home.html");
		}  

		// Retrieve data from the session
		$username = $_SESSION['username'];
		$table = $_SESSION['table']; 
		$password = $_SESSION['password'];
        $rid = $_SESSION['rid'];
        $oid = $_SESSION['OrgID'];

        $sql = "SELECT RecruiterID, RFirstName, RLastName, PositionName, EmailAddress, PhoneNumber, OrganizationID FROM recruiter WHERE RecruiterID = $rid";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0)
        {
            $row = mysqli_fetch_array($result);
        }

        $sql1 = "SELECT OrganizationName FROM organization WHERE OrganizationID = $oid";
        $result1 = mysqli_query($conn, $sql1);

        if ($result1->num_rows > 0)
        {
            $row1 = mysqli_fetch_array($result1);
        }
	?>
</head>
<body>
	<div class="background"></div>
	<div class="top-menu">
        <img src="NWlogo.png" class="nw" width="180" height="55">
		<a href="RProfile.php"><img src = "home.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">HOME</span></a>
		<a href="RecDisplay.php"><img src = "profile.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">PROFILE</span></a>
		<a href="Rnotifications.php?rid=<?php echo $rid?>"><img src = "noti.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">NOTIFICATIONS</span></a>
		<a href="RSettings.php"><img src = "settings.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">SETTINGS</span></a>
		<a href="../NetWork/RecLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
    </div>
    <div class="white2" style="width: 780px;margin-left:25px;color:white;">
        <div style="margin-left: 75px;">Recruiter ID: <?php echo $row["RecruiterID"];?></div><br>
        <img src = "profile.jpeg" style="width:200px; margin-left:25px;border-radius:120px;height:150px;">
        <div style="height:180px; margin-left:250px; margin-top:-155px; font-size:23px;">
            <div style="top:-20px;">
                Recruiter Name: <?php echo $row["RFirstName"];?> <?php echo $row["RLastName"];?><br>
                Position: <?php echo $row["PositionName"];?><br>
                Email Address: <?php echo $row["EmailAddress"];?><br>
                Phone Number: <?php echo $row["PhoneNumber"];?><br>
                Organization: <?php echo $row1["OrganizationName"];?>
            </div>
        </div>
    </div>
</body>
</html>