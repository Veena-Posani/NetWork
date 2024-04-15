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

        if (isset($_GET['jobID'])) {
            $jobID = $_GET['jobID'];
        } else {
            echo 'Job ID not provided.';
        }
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
            echo '<div style="margin-top: -40px;" class="right-panel">';
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
            echo '<p>No recommendations found.</p>';
        }

        $sql = "SELECT j.JobID, j.JobDomain, j.JobTitle, j.OrganizationID, j.PayRate, j.PayPeriod, j.PostingDate, j.Deadline, j.Information, o.OrganizationName, c.CityID, c.CountryName, c.CityName, c.StateName 
        FROM jobs j 
        JOIN organization o ON j.OrganizationID = o.OrganizationID 
        JOIN job_locations jl ON j.JobID = jl.JobID 
        JOIN city c ON jl.CityID = c.CityID 
        WHERE j.JobID = $jobID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {    
            $row = $result->fetch_assoc();            
            echo '<div class="white2" style="width: 780px;margin-left:25px;color:white;">';
                echo '<h2>' . $row['JobTitle'] . ' (Job ID: ' . $row['JobID'] . ')</h2>';  
                
                $checkAppliedSQL = "SELECT * FROM applications WHERE CandidateID = $cid AND JobID = $jobID";
                $resultApplied = $conn->query($checkAppliedSQL);
            if ($resultApplied->num_rows == 0) {
                echo '<p>Job Domain: ' . $row['JobDomain'] . '</p>';
                echo '<p>Organization: ' . $row['OrganizationName'] . '</p>';
                echo '<p>PayRate: $' . $row['PayRate'] . ' ' . $row['PayPeriod'] . '</p>';
                echo '<p>Posted On: ' . $row['PostingDate'] . '</p>';
                echo '<p>Apply Before: ' . $row['Deadline'] . '</p>';
                echo '<p>Description: ' . $row['Information'] . '</p>';
                echo '<p>Location: ' . $row['CityName'] . ', ' . $row['StateName'] . ', ' . $row['CountryName'] . '</p>';
                echo '<form action="apply.php" method="post" onsubmit="return onSubmit()">';
                echo '<input type="hidden" name="jobID" value="' . $jobID . '">';
                echo '<input type="hidden" name="candiID" value="' . $cid . '">';
                    echo '<button
                    style="background-color: #3498db;border: none;border-radius: 15px;cursor: pointer;margin:6.5px;width:200px;padding:10px;" 
                    type="submit">Apply</button>';
                echo '</form>';
                }else{
                    echo '<p>You have already applied for this job.</p>';
                }
            echo '</div>';
        } else {
            echo 'Job not found.';
        }

        $sql = "SELECT j.JobID, j.JobTitle, j.JobDomain, j.PostingDate, j.Deadline, ct.CityName, ct.StateName, ct.CountryName, org.OrganizationName 
        FROM jobs j 
        JOIN job_locations jl ON j.JobID = jl.JobID 
        JOIN city ct ON jl.CityID = ct.CityID 
        JOIN organization org ON j.OrganizationID = org.OrganizationID 
        WHERE j.PostingDate >= NOW() - INTERVAL 5 DAY;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="bottom-panel">';
            echo '<h4>Recently Added</h4>';
            while ($row = $result->fetch_assoc()) { 
                echo '<div class="white2">';
                echo '<a href="CandJobDisplay.php?jobID=' . $row['JobID'] . '" style="color:white">';
                echo '<h2><u>' . $row['JobTitle'] . ', ' . $row['OrganizationName'] . '</u></h2>';
                echo '</a>';
                echo '<h4>' . $row['CityName'] . ', ' . $row['StateName'] . ', ' . $row['CountryName'] . ' - Deadline: ' . date('m/d/Y', strtotime($row['Deadline'])) . '</h4>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
</body>
</html>
