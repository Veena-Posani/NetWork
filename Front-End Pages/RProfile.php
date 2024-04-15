<!DOCTYPE html>
<html>
<head>
    <title>Recruiter Profile</title>
	<link rel="stylesheet" href="Cprofile.css">
	<?php
		session_start();
		$servername = "localhost";
		$username = "root";
		$password = "Adbms2023#";
		$dbname = "mydb";
		$conn = new mysqli('localhost', 'root', 'Adbms2023#', 'mydb');
		if (!isset($_SESSION['rid']))
		{
		  header("location: Home.html");
		}  
		$rid = $_SESSION['rid'];
		$oid = $_SESSION['OrgID'];
		$sql = "SELECT RFirstName FROM recruiter WHERE RecruiterID = $rid"; 
		$result = mysqli_query($conn, $sql);
		// echo $result;

        $sql1 = "SELECT jobs.JobID, JobTitle, CityName, StateName, CountryName, Deadline FROM city INNER JOIN job_locations ON city.CityID = job_locations.CityID INNER JOIN jobs ON job_locations.JobID = jobs.JobID WHERE RecruiterID = $rid";
        $result1 = mysqli_query($conn, $sql1);
        
        if ($result1->num_rows > 0) 
		{
            $JobIDs = [];
			$JobTitles = [];
            $CityNames = [];
            $StateNames = [];
            $CountryNames = [];
            $Deadlines = [];
            while ($row1 = mysqli_fetch_array($result1))
            {   
                array_push($JobIDs, $row1['JobID']);
				array_push($JobTitles,$row1['JobTitle']);
                array_push($CityNames,$row1['CityName']);
                array_push($StateNames,$row1['StateName']);
                array_push($CountryNames,$row1['CountryName']);
                array_push($Deadlines,$row1['Deadline']);
            }
        }
		$sql2 = "SELECT * FROM organization WHERE OrganizationID = $oid";
		$result2 = mysqli_query($conn, $sql2);

		if ($result2->num_rows > 0)
		{
			$row2 = mysqli_fetch_array($result2);
			$OrganizationID = $row2['OrganizationID'];
			$organizationName = $row2['OrganizationName'];
		}
		$recruiterName = "";
		if ($row = mysqli_fetch_assoc($result)) {
			$recruiterName = $row['RFirstName'];
		}
	?>
	<script>
		function populateDesiredPositions() {
			const majorSelect = document.getElementById("jobDomain");
			const desiredPositionSelect = document.getElementById("jobTitle");
			desiredPositionSelect.innerHTML = '';
			const selectedMajor = majorSelect.value;
			if (selectedMajor === "Mechanical Engineering") {
				addOption(desiredPositionSelect, "Mechanical Engineer", "Mechanical Engineer");
				addOption(desiredPositionSelect, "Design Engineer", "Design Engineer");
				addOption(desiredPositionSelect, "Bettery Design Engineer", "Battery Design Engineer");
				addOption(desiredPositionSelect, "Product Mechanical Engineer", "Product Mechanical Engineer");
			}
			else if (selectedMajor === "Electrical Engineering") {
				addOption(desiredPositionSelect, "Substation Field Engineer", "Substation Field Engineer");
				addOption(desiredPositionSelect, "Equipment Engineer", "Equipment Engineer");
				addOption(desiredPositionSelect, "Electrical Controls Engineer", "Electrical Controls Engineer");
				addOption(desiredPositionSelect, "Custom Circuit Engineer", "Custom Circuit Engineer");
			}
			else if (selectedMajor === "Civil Engineering") {
				addOption(desiredPositionSelect, "Field Engineer", "Field Engineer");
				addOption(desiredPositionSelect, "Structural Engineer", "Structural Engineer");
				addOption(desiredPositionSelect, "Assistant City Engineer", "Assistant City Engineer");
				addOption(desiredPositionSelect, "Design Engineer Land Development", "Design Engineer Land Development");
			}
			else if (selectedMajor === "Computer Science") {
				addOption(desiredPositionSelect, "Data Scientist", "Data Scientist");
				addOption(desiredPositionSelect, "Software Engineer", "Software Engineer");
				addOption(desiredPositionSelect, "Full Stack Developer", "Full Stack Developer");
				addOption(desiredPositionSelect, "Testing Engineer", "Testing Engineer");
    		}
			else if (selectedMajor === "Finance") {
				addOption(desiredPositionSelect, "Financial Analyst", "Financial Analyst");
				addOption(desiredPositionSelect, "Loan Administration Analyst", "Loan Administration Analyst");
				addOption(desiredPositionSelect, "Finance Manager", "Finance Manager");
				addOption(desiredPositionSelect, "Wealth Manager", "Wealth Manager");
			}
			else if (selectedMajor === "Psychology") {
				addOption(desiredPositionSelect, "Clinical Psychologist", "Clinical Psychologist");
				addOption(desiredPositionSelect, "Psychotherapist", "Psychotherapist");
				addOption(desiredPositionSelect, "Mental health Counselor", "Mental Health Counselor");
				addOption(desiredPositionSelect, "Assistant Professor Counseling Psychology", "Assistant Professor Counseling Psychology");
			}
			else if (selectedMajor === "Nursing") {
				addOption(desiredPositionSelect, "Home Infusion", "Home Infusion");
				addOption(desiredPositionSelect, "Nurse", "Nurse");
				addOption(desiredPositionSelect, "Private Duty Nurse", "Private Duty Nurse");
				addOption(desiredPositionSelect, "Day Surgery Registered Nurse", "Day Surgery Registered Nurse");
			}
			else if (selectedMajor === "Biology") {
				addOption(desiredPositionSelect, "Biological Science Technician", "Biological Science Technician");
				addOption(desiredPositionSelect, "Regional Biologist", "Regional Biologist");
				addOption(desiredPositionSelect, "Genetic Engineer", "Genetic Engineer");
				addOption(desiredPositionSelect, "Molecular Biologist", "Molecular Biologist");
			}	
			else if (selectedMajor === "English") {
				addOption(desiredPositionSelect, "Journalist", "Journalist");
				addOption(desiredPositionSelect, "Marketing Executive", "Marketing Executive");
				addOption(desiredPositionSelect, "Museum Curator", "Museum Curator");
				addOption(desiredPositionSelect, "Librarian", "Librarian");
			}
			else if (selectedMajor === "Chemistry") {
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

		function displayJobs(jobs) {
		const container = document.querySelector(".bottom-panel");
	
		jobs.forEach((job) => {
			const jobElement = document.createElement("div");
			jobElement.className = "white2";
	
			const titleElement = document.createElement("h2");
			titleElement.innerHTML = `<u>${job.title}</u> - ${job.location} - Deadline: ${job.deadline}`;
	
			jobElement.appendChild(titleElement);
			container.appendChild(jobElement);
		});
		}
	</script>	
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
    <div class="middle-panel">
        <h1 style="color: whitesmoke;" ><?php echo $recruiterName; ?>, Welcome to NetWork!</h1>
    </div>
    <div class="right-panel">
        <h3 style="margin-left: 80px; margin-top: 200px; font-size: 25px;">Post a New Job</h3>
		<form action="../NetWork/postJob.php" method="POST">
			<select name="jobDomain" id="jobDomain" class="select" style = "margin-left: 2.5px; width: 350px; height: 50px; font-size: 20px; background: white" onchange="populateDesiredPositions()" required>
				<option value="None">Job Domain</option>
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
            <h6></h6>
            <select id="jobTitle" name="jobTitle" class="select" style = "margin-left: 2.5px; width: 350px; height: 50px; font-size: 20px; background: white" required>
				<option value="">Job Title</option>
            </select>
            <h6></h6>
            <select id="location" name="location" class="select" style = "margin-left: 2.5px; width: 350px; height: 50px; font-size: 20px; background: white" required>
                <option value="None">Job Location</option>
				<option value="6001">South Jason, Indiana, Mexico</option>
				<option value="6002">Manningborough, Delaware, England</option>
				<option value="6003">Susanchester, Washington, Thailand</option>
				<option value="6004">New Miguelmouth, Washington, Thailand</option>
				<option value="6005">New Charles, Montana, India</option>
				<option value="6006">South Bradleychester, Nevada, UAE</option>
				<option value="6007">Port Timothy, North Carolina, Mexico</option>
				<option value="6008">South Carolville, North Dakota, Thailand</option>
				<option value="6009">Allenport, Kansas, Germany</option>
				<option value="6010">Ryanborough, Colorado, Japan</option>
                <option value="6011">Brownview, Arizona, United States</option>
                <option value="6012">Lindsayborough, North Carolina, France</option>
                <option value="6013">Jeffreytown, Wyoming, United States</option>
                <option value="6014">Natalieport, Nevada, India</option>
                <option value="6015">Ashleyfurt, Rhode Island, India</option>
                <option value="6016">Port Jonathanhaven, Missouri, Malaysia</option>
                <option value="6017">West Paul, Minnesota, UAE</option>
                <option value="6018">West Robertbury, South Carolina, UAE</option>
                <option value="6019">Lewismouth, South Carolina, Germany</option>
                <option value="6020">Sharifurt, Arizona, UAE</option>
			</select>
            <h6></h6>
            <input type="number" id="pay_rate" name="pay_rate" style = "padding-left: 15px; width: 335px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px;" required placeholder="Pay Rate">
            <h6></h6>
            <select id="pay_period" name="pay_period" class="select" style = "margin-left: 2.5px; width: 350px; height: 50px; font-size: 20px; background: white" required>
                <option value="None">Pay Period</option>
				<option value="Per hour">Per Hour</option>
				<option value="Per week">Per Week</option>
				<option value="Per year">Per Year</option>
			</select>
            <h6></h6>
            <input type="datetime-local" id="deadline" name = "deadline" style = "padding-left: 15px; width: 335px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px;" required placeholder="Application Deadline">
            <h6></h6>
            <input type="text" id="information" name="information" style = "padding-left: 15px; width: 335px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px;" required placeholder="Information">
            <h6></h6>
			<select id="round_name" name="round_name" class="select" style = "margin-left: 2.5px; width: 350px; height: 50px; font-size: 20px; background: white" required placeholder="Round Name">
                <option value="None">Round Name</option>
				<option value="7001">Technical Round</option>
				<option value="7002">Written Exam</option>
				<option value="7003">Coding Round</option>
				<option value="7004">Phone Interview</option>
				<option value="7005">Behavioral Interview</option>
				<option value="7006">Final Round</option>
			</select>
			<h6></h6>
			<input type="text" id="round_link" name="round_link" style = "padding-left: 15px; width: 335px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px;" required placeholder="Round Link">
			<h6></h6>
			<select id="round_duration" name="round_duration" class="select" style = "margin-left: 2.5px; width: 350px; height: 50px; font-size: 20px; background: white" required placeholder="Round Duration">
                <option value="None">Round Duration</option>
				<option value="00:30:00">30 Minutes</option>
				<option value="01:00:00">1 Hour</option>
				<option value="01:30:00">1 Hour 30 Minutes</option>
				<option value="02:00:00">2 Hours</option>
			</select>
			<h6></h6>
            <input type="submit" value="Post" style = "margin-left: 125px; width: 100px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px; background-color: #3498db;" class="button">
        </form>

    </div>
	<div class="bottom-panel">
		<?php
			if ($result1->num_rows > 0) 
			{
		?>
		<h2>Posted Jobs</h2>
		<?php
				for ($i = 0; $i < count($JobTitles); $i++)
				{
		?>
        <div class="white2" id = 'repeat'>
			<h2>
				<u>
					<?php echo $JobTitles[$i];?>, 
					<?php echo $organizationName?>
					<a href = "viewPostedJob.php?varname=<?php echo $JobIDs[$i]?>">
						<input type="submit" value="View" style = "margin-left: 125px; width: 100px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px; background-color: #3498db;" class="button">
					</a>
				</u>
			</h2>
			<h4><?php echo $StateNames[$i]?>, <?php echo $CountryNames[$i]?> - Deadline: <?php echo $Deadlines[$i]?></h4>
		</div>
		<?php
				}
			}
			else
			{
		?>
		<h2>No Jobs Posted!</h2>
		<?php
			}
		?>
        <script type="text/javascript">
            let repeatElements = document.getElementsById("repeat");
            for (let i = 0; i < sizeof($JobTitles); i++) {
                console.log(repeatElements[i]);
            }
        </script>
    </div>
</body>
</html>
