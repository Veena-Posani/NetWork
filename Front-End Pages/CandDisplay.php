<!DOCTYPE html>
<html>
<head>
    <title>Candidate Profile</title>
	<link rel="stylesheet" href="Cprofile.css">
    <?php
		session_start();

        $servername = "localhost";
        $username = "root";
        $password = "Adbms2023#";
        $dbname = "mydb";

        $conn = new mysqli($servername, $username, $password, $dbname);
        //$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

        if (!isset($_SESSION['cid']))
		{
			header("location: Home.html");
		}

		// Retrieve data from the session
		$username = $_SESSION['username'];
		$table = $_SESSION['table']; 
		$password = $_SESSION['password'];
        $cid = $_SESSION['cid'];

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
		<a href="../Network/CanLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
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
                echo '<div class="right-panel">';
                echo '<h3 style="margin-left: 35px;margin-top:280px;">Recommendations for you</h3>';
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

            $sql = "SELECT CandidateID,CFirstName,CLastName,EmailAddress,PhoneNumber,EducationLevel,Nationality,MajorName 
            FROM candidate c join majors m on c.MajorID = m.MajorID WHERE CandidateID = $cid";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {    
                $row = $result->fetch_assoc();            
                echo '<div class="white2" style="width: 780px;margin-left:25px;color:white;">';
                echo '<div style="margin-left: 75px;">Candidate ID: ' . $row["CandidateID"] . '</div><br>';
                    echo '<img src = "profile.jpeg" style="width:200px; margin-left:25px;border-radius:120px;height:150px;">';
                    echo '<div style="height:180px; margin-left:250px; margin-top:-155px; font-size:23px;">';                       
                        echo '<div style="top:-20px;">';
                            echo "Candidate Name: " . $row["CFirstName"] . " " . $row["CLastName"] . "<br>";
                            echo "Nationality: " . $row["Nationality"] . "<br>";
                            echo "Email: " . $row["EmailAddress"] . "<br>";
                            echo "Phone: " . $row["PhoneNumber"] . "<br>";
                            echo "Education Level: " . $row["EducationLevel"] . "<br>";                            
                            echo "Major: " . $row["MajorName"] . "<br>";
                        echo '</div>';       
                        echo '</div>';
                echo '</div>';
            } 

            $sql = "SELECT applications.Status, jobs.JobID, jobs.Jobtitle, jobs.JobDomain, organization.OrganizationName 
            FROM applications 
            JOIN jobs ON applications.JobID = jobs.JobID 
            JOIN organization ON jobs.OrganizationID = organization.OrganizationID 
            WHERE applications.CandidateID = $cid";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo '<div class="bottom-panel">';
                echo '<h4>Active Applications</h4>';
                echo '<div style:"left:20px;">';
                while ($row = $result->fetch_assoc()) {     
                    if ($row['Status'] == 'Active')
                    {
                        echo '<div class="white2">';
                        // echo '<a href="new_page.php" style="color:white">';
                        echo "JobID: " . $row['JobID'] . "<br>";
                        echo '<h2><u>' . $row['Jobtitle'] . ' - ' . $row['JobDomain'] . ', ' . $row['OrganizationName'] . '</u></h2>';
                        // echo '</a>'; 
                        echo '</div>';
                    }
                }
                echo '</div>';
            }else{
                echo '<br><div style="font-size:23px;color:white;margin-left:30px;margin-top:30px;">No Applications filled</div>';
                echo '<form action="../Front-end pages/CProfile.php" method="POST">';         
			        echo '<div class="filter-section">';
				        echo '<button class="select" type="submit" style="margin-left:20%;width:150px;background-color:#3498db">Search Again?</button>';
			        echo '</div>';
		        echo '</form>';
            }
        ?>
</body>
</html>
