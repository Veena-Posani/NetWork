<!DOCTYPE html>
<html>
<head>
    <title>Candidate Profile</title>
	<link rel="stylesheet" href="../Front-end pages/Cprofile.css">
	<?php
		session_start();

        $servername = "localhost";
        $username = "root";
        $password = "Adbms2023#";
        $dbname = "mydb";

        $conn = new mysqli($servername, $username, $password, $dbname);
        //$conn = new mysqli($servername, $username, $password, $dbname);

        if (!isset($_SESSION['cid']))
        {
            header("location: Home.html");
        }

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Retrieve data from the session
		$username = $_SESSION['username'];
		$table = $_SESSION['table']; 
		$password = $_SESSION['password'];
        $cid = $_SESSION['cid'];

        $major = $_POST['major'];
        $desired_position = $_POST['desired_position'];
        $nationality = $_POST['nationality'];
        $organisation = $_POST['organisation'];

	?>
	
</head>
<body>
	<div class="background"></div>
	<div class="top-menu">
        <img src="NWlogo.png" class="nw" width="180" height="55">
		<a href="CProfile.php"><img src = "home.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">HOME</span></a>
		<a href="CandDisplay.php"><img src = "profile.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">PROFILE</span></a>
		<a href="getnotifications.php?cid=<?php echo $cid?>"><img src = "noti.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">NOTIFICATIONS</span></a>
		<a href="CSettings.php"><img src = "settings.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">SETTINGS</span></a>
		<a href="../NetWork/CanLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
    </div>
    <div class="middle-panel">
		<form action="../Front-end pages/CProfile.php" method="POST">          
			<div class="filter-section">
				<button class="select" type="submit" style="margin-left:20%;width:150px;background-color:#3498db">Search Again?</button>		
			</div>
		</form>
    </div>
	<?php
        $sql = "SELECT j.JobID, j.JobTitle, j.Deadline, c.CityName, c.StateName, c.CountryName, o.OrganizationName
        FROM jobs j 
        JOIN job_locations jl ON j.JobID = jl.JobID 
        JOIN City c ON jl.CityID = c.CityID 
        JOIN organization o ON j.OrganizationID = o.OrganizationID 
        WHERE j.JobDomain LIKE (SELECT JobDomain FROM jobs WHERE JobTitle LIKE 
              (SELECT DesiredPosition FROM candidate WHERE CandidateID = $cid))
               AND j.Deadline > CURDATE()";         

        $result = $conn->query($sql);

        // Check if there are recommendations
        if ($result->num_rows > 0) {
            echo '<div style="margin-top: -140px;" class="right-panel">';
            echo '<h3 style="margin-left: 35px;">Recommendations for you</h3>';
            $recommend = array();
            // Loop through each recommendation
            while ($row = $result->fetch_assoc()) {
                echo '<div class="white">';
                echo '<a href="CandJobDisplay.php?jobID=' . $row['JobID'] . '" style="color:white">';
                echo '<h2><u>' . $row['JobTitle'] . ', ' . $row['OrganizationName'] . '</u></h2>';
                echo '</a>';
                echo '<h4>' . $row['CityName'] . ', ' . $row['StateName'] . ', ' . $row['CountryName'] . '</h4>';
                echo '<h4>Deadline: ' . date('m/d/Y', strtotime($row['Deadline'])) . '</h4>';
                echo '</div>';
            }

            echo '</div>';
        } 
        else {
            echo '<p style="margin-left: 50px;">No recommendations found.</p>';
        }
		
        if (isset($_POST['major'])) {
            $jobDomain = $_POST['major'];
        } else {
            $jobDomain = "%"; 
        }
        if (isset($_POST['desired_position'])) {
            $jobTitle = $_POST['desired_position'];
        } else {
            $jobTitle = "%"; 
        } 
        if (isset($_POST['nationality'])) {
            $country = $_POST['nationality'];
        } else {
            $country = "%"; 
        }
        if (isset($_POST['organisation'])) {
            $organisation = $_POST['organisation'];
        } else {
            $organisation = "%"; 
        }  
        
        $sql = "SELECT j.JobID, j.JobTitle, o.OrganizationName, j.Deadline, c.CityName, c.StateName, c.CountryName 
        FROM jobs j 
        JOIN organization o ON j.OrganizationID = o.OrganizationID 
        JOIN job_locations jl ON j.JobID = jl.JobID 
        JOIN city c ON jl.CityID = c.CityID 
        WHERE j.JobTitle LIKE '%$jobTitle%' 
          AND j.JobDomain LIKE '%$jobDomain%'
          AND o.OrganizationName LIKE '%$organisation%' 
          AND c.CountryName LIKE '%$country%'
          AND j.Deadline > CURDATE()";

        $result = $conn->query($sql);  

		if ($result->num_rows > 0) {
            echo '<div class="middle-panel" style="width:800px;margin-left:10px;margin-top:-35px;">';
            while ($row = $result->fetch_assoc()) { 
                echo '<div class="white2" style="color:white">';
                echo '<a href="CandJobDisplay.php?jobID=' . $row['JobID'] . '" style="color:white">';
                echo '<h2><u>' . $row['JobTitle'] . ', ' . $row['OrganizationName'] . '</u></h2>';
                echo '</a>';
                echo '<h4>' . $row['CityName'] . ', ' . $row['StateName'] . ', ' . $row['CountryName'] . '<span style="margin-left: 50px;">Deadline: ' . date('m/d/Y', strtotime($row['Deadline'])) . '</h4>';
                echo '</div>';
            }
            echo '</div>';
        }else{
            echo '<p style="color:white">No Records Found</p>';
        }
	?>
</body>
</html>
