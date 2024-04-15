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

		$sql = "SELECT CFirstName FROM $table WHERE EmailAddress = '$username' AND Password = '$password' LIMIT 1"; 
		$result = $conn->query($sql);
			// Fetch the candidate name
		$candidateName = "Unknown"; // Initialize the variable
		if ($row = mysqli_fetch_assoc($result)) {
			$candidateName = $row['CFirstName'];
		}  

	?>
	<script>
		function populateDesiredPositions() {
			const majorSelect = document.getElementById("major");
			const desiredPositionSelect = document.getElementById("desired_position");
			desiredPositionSelect.innerHTML = '';
			const selectedMajor = majorSelect.value;
            if (selectedMajor === "None") {
				addOption(desiredPositionSelect, "%", "Desired Position");
            }
			if (selectedMajor === "Mechanical Engineering") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Mechanical Engineer", "Mechanical Engineer");
				addOption(desiredPositionSelect, "Design Engineer", "Design Engineer");
				addOption(desiredPositionSelect, "Battery Design Engineer", "Battery Design Engineer");
				addOption(desiredPositionSelect, "Product Mechanical Engineer", "Product Mechanical Engineer");
			}
			else if (selectedMajor === "Electrical Engineering") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Substation Field Engineer", "Substation Field Engineer");
				addOption(desiredPositionSelect, "Equipment Engineer", "Equipment Engineer");
				addOption(desiredPositionSelect, "Electrical Controls Engineer", "Electrical Controls Engineer");
				addOption(desiredPositionSelect, "Custom Circuit Engineer", "Custom Circuit Engineer");
			}
			else if (selectedMajor === "Civil Engineering") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Field Engineer", "Field Engineer");
				addOption(desiredPositionSelect, "Structural Engineer", "Structural Engineer");
				addOption(desiredPositionSelect, "Assistant City Engineer", "Assistant City Engineer");
				addOption(desiredPositionSelect, "Design Engineer Land Development", "Design Engineer Land Development");
			}
			else if (selectedMajor === "Computer Science") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Data Scientist", "Data Scientist");
				addOption(desiredPositionSelect, "Software Engineer", "Software Engineer");
				addOption(desiredPositionSelect, "Full Stack Developer", "Full Stack Developer");
				addOption(desiredPositionSelect, "Testing Engineer", "Testing Engineer");
			}
			else if (selectedMajor === "Finance") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Financial Analyst", "Financial Analyst");
				addOption(desiredPositionSelect, "Loan Administration Analyst", "Loan Administration Analyst");
				addOption(desiredPositionSelect, "Finance Manager", "Finance Manager");
				addOption(desiredPositionSelect, "Wealth Manager", "Wealth Manager");
			}
			else if (selectedMajor === "Psychology") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Clinical Psychologist", "Clinical Psychologist");
				addOption(desiredPositionSelect, "Psychotherapist", "Psychotherapist");
				addOption(desiredPositionSelect, "Mental Health Counselor", "Mental Health Counselor");
				addOption(desiredPositionSelect, "Assistant Professor Counseling Psychologyy", "Assistant Professor Counseling Psychology");
			}
			else if (selectedMajor === "Nursing") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Home Infusion", "Home Infusion");
				addOption(desiredPositionSelect, "Nurse", "Nurse");
				addOption(desiredPositionSelect, "Private Duty Nurse", "Private Duty Nurse");
				addOption(desiredPositionSelect, "Day Surgery Registered Nurse", "Day Surgery Registered Nurse");
			}
			else if (selectedMajor === "Biology") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Biological Science Technician", "Biological Science Technician");
				addOption(desiredPositionSelect, "Regional Biologist", "Regional Biologist");
				addOption(desiredPositionSelect, "Genetic Engineer", "Genetic Engineer");
				addOption(desiredPositionSelect, "Molecular Biologist", "Molecular Biologist");
			}	
			else if (selectedMajor === "English") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Journalist", "Journalist");
				addOption(desiredPositionSelect, "Marketing Executive", "Marketing Executive");
				addOption(desiredPositionSelect, "Museum Curator", "Museum Curator");
				addOption(desiredPositionSelect, "Librarian", "Librarian");
			}
			else if (selectedMajor === "Chemistry") {
                addOption(desiredPositionSelect, "%", "Desired Position");
				addOption(desiredPositionSelect, "Color Technologist", "Color Technologist");
				addOption(desiredPositionSelect, "Analytical Chemist", "Analytical Chemist");
				addOption(desiredPositionSelect, "Crime Scene Investigator", "Crime Scene Investigator");
				addOption(desiredPositionSelect, "Biotechnologist", "Biotechnologist");
			}
		}
		function addOption(selectElement, value, text) {
			const option = document.createElement("option");
			option.value = value;
			option.text = text;
			selectElement.appendChild(option);
		}

		document.addEventListener("DOMContentLoaded", function () {
		// Fetch data from the PHP script using Fetch API
		fetch("getJobs.php")
			.then((response) => response.json())
			.then((data) => displayJobs(data))
			.catch((error) => console.error("Error fetching data:", error));
		});



    function fetchNotifications() {
        // Replace 'get_notifications.php' with the actual PHP file that fetches notifications from the database
        window.location.href = 'get_notifications.php';
    }

	</script>
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
		<form action="Search.php" method="POST">
			<h1 style="color: whitesmoke;margin-left: 7%;" ><?php echo $candidateName; ?>, Welcome to NetWork!</h1>
			<!--input type="text" class="form-group" placeholder="&#x1F50D" /-->            
			<div class="filter-section">
				<select name="major" id="major" class="select" onchange="populateDesiredPositions()" style="margin-right: 100px;">
					<option value="%">Major</option>
					<option value="Mechanical Engineering">Mechanical Engineering</option>
					<option value="Electrical Engineering">Electrical Engineering</option>
					<option value="Civil Engineering">Civil Engineering</option>
					<option value="Computer Science">Computer Science</option>
					<option value="Finance">Finance</option>
					<option value="Psychology">Psychology</option>
					<option value="Nursing">Nursing</option>
					<option value="Biology">Biology</option>
					<option value="English">English</option>
					<option value="Chemistry">Chemistry</option>
				</select>
				<select id="desired_position" name="desired_position" class="select" style="margin-right: 100px;">
					<option value="%">Desired Position</option>
				</select><br></br>
				<select id="nationality" name="nationality" class="select" style="margin-right: 100px;">
					<option value="%">Country</option>
					<option value="United States">United States</option>
					<option value="Japan">Japan</option>
					<option value="Thailand">Thailand</option>
					<option value="India">India</option>
					<option value="Mexico">Mexico</option>
					<option value="UAE">UAE</option>
					<option value="Germany">Germany</option>
					<option value="England">England</option>
					<option value="France">France</option>
					<option value="Malaysia">Malaysia</option>
				</select>
				<select name="organisation" id="organisation" class="select">
					<option value="%">Organisation</option>
					<option value="Tesla">Tesla</option>
					<option value="Amazon">Amazon</option>
					<option value="Dr.Reddy's">Dr.Reddy's</option>
					<option value="Netflix">Netflix</option>
					<option value="Samsung">Samsung</option>
					<option value="SpaceX">SpaceX</option>
					<option value="Google">Google</option>
					<option value="Baker Publishing">Baker Publishing</option>
					<option value="Chanel">Chanel</option>
					<option value="Dior">Dior</option>
					<option value="Convenant Hospital">Convenant Hospital</option>
					<option value="Aecom">Aecom</option>
				</select><br></br>
                <button class="select" type="submit" style="margin-left:25%;width:70px;background-color:#3498db">Search</button>		
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
		echo '<div class="right-panel">';
		echo '<h3 style="margin-left: 35px;">Recommendations for you</h3>';
        // Check if there are recommendations
        if ($result->num_rows > 0) {
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

        } 
        else {
            echo '<p style="margin-left: 50px;">No recommendations found.</p>';
        }
		
		echo '</div>';

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
