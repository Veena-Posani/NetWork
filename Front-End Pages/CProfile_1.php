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

		$conn = new mysqli('localhost','root','Adbms2023#','mydb');
		//$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
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
				addOption(desiredPositionSelect, "None", "Desired Position");
            }
			if (selectedMajor === "meng") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "mech_engineer", "Mechanical Engineer");
				addOption(desiredPositionSelect, "des_engineer", "Design Engineer");
				addOption(desiredPositionSelect, "bat_des_engineer", "Battery Design Engineer");
				addOption(desiredPositionSelect, "pro_mech_engineer", "Product Mechanical Engineer");
			}
			else if (selectedMajor === "eeng") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "sub_f_engineer", "Substation Field Engineer");
				addOption(desiredPositionSelect, "equip_engineer", "Equipment Engineer");
				addOption(desiredPositionSelect, "elec_cont_engineer", "Electrical Controls Engineer");
				addOption(desiredPositionSelect, "cust_cir_engineer", "Custom Circuit Engineer");
			}
			else if (selectedMajor === "ceng") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "f_engineer", "Field Engineer");
				addOption(desiredPositionSelect, "struct_engineer", "Structural Engineer");
				addOption(desiredPositionSelect, "a_c_engineer", "Assistant City Engineer");
				addOption(desiredPositionSelect, "des_engineer", "Design Engineer Land Development");
			}
			else if (selectedMajor === "cs") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "data_sci", "Data Scientist");
				addOption(desiredPositionSelect, "sw_engineer", "Software Engineer");
				addOption(desiredPositionSelect, "full_stack_engineer", "Full Stack Developer");
				addOption(desiredPositionSelect, "test_engineer", "Testing Engineer");
    		}
			else if (selectedMajor === "fin") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "fin_analyst", "Financial Analyst");
				addOption(desiredPositionSelect, "loan_adm_analyst", "Loan Administration Analyst");
				addOption(desiredPositionSelect, "fin_manager", "Finance Manager");
				addOption(desiredPositionSelect, "wel_manager", "Wealth Manager");
			}
			else if (selectedMajor === "psy") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "c_psychologist", "Clinical Psychologist");
				addOption(desiredPositionSelect, "psycho", "Psychotherapist");
				addOption(desiredPositionSelect, "m_h_counselor", "Mental Health Counselor");
				addOption(desiredPositionSelect, "a_p_c_psy", "Assistant Professor Counseling Psychology");
			}
			else if (selectedMajor === "nrs") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "hm_inf", "Home Infusion");
				addOption(desiredPositionSelect, "nrs", "Nurse");
				addOption(desiredPositionSelect, "pro_duty_nrs", "Private Duty Nurse");
				addOption(desiredPositionSelect, "reg_nrs", "Day Surgery Registered Nurse");
			}
			else if (selectedMajor === "bio") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "bio_sci_tech", "Biological Science Technician");
				addOption(desiredPositionSelect, "reg_bio", "Regional Biologist");
				addOption(desiredPositionSelect, "gen_eng", "Genetic Engineer");
				addOption(desiredPositionSelect, "mol_bio", "Molecular Biologist");
			}	
			else if (selectedMajor === "eng") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "jour", "Journalist");
				addOption(desiredPositionSelect, "mark_ex", "Marketing Executive");
				addOption(desiredPositionSelect, "mus_cur", "Museum Curator");
				addOption(desiredPositionSelect, "lib", "Librarian");
			}
			else if (selectedMajor === "chem") {
                addOption(desiredPositionSelect, "None", "Desired Position");
				addOption(desiredPositionSelect, "col_tech", "Color Technologist");
				addOption(desiredPositionSelect, "anl_chem", "Analytical Chemist");
				addOption(desiredPositionSelect, "crm_inv", "Crime Scene Investigator");
				addOption(desiredPositionSelect, "biotec", "Biotechnologist");
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
	
		document.addEventListener("DOMContentLoaded", function () {
		// Fetch data from the PHP script using Fetch API
		fetch("getJobs.php")
			.then((response) => response.json())
			.then((data) => displayJobs(data))
			.catch((error) => console.error("Error fetching data:", error));
		});
	</script>	
</head>
<body>
	<div class="background"></div>
	<div class="top-menu">
        <img src="NWlogo.png" class="nw" width="180" height="55">
		<a href="CProfile.php"><img src = "home.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">HOME</span></a>
		<a href="CandDisplay.php"><img src = "profile.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">PROFILE</span></a>
		<a href="Notify.html"><img src = "noti.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">NOTIFICATIONS</span></a>
		<a href="Settings.html"><img src = "settings.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">SETTINGS</span></a>
		<a href="Home.html"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
    </div>
    <div class="middle-panel">
		<form action="../Front-end pages/Search.php" method="POST">
			<h1 style="color: whitesmoke;margin-left: 7%;" >Welcome <?php echo $candidateName; ?>, to NetWork</h1>
			<!--input type="text" class="form-group" placeholder="&#x1F50D" /-->            
			<div class="filter-section">
				<select name="major" id="major" class="select" onchange="populateDesiredPositions()" style="margin-right: 100px;">
					<option value="%">Major</option>
					<option value="meng">Mechanical Engineering</option>
					<option value="eeng">Electrical Engineering</option>
					<option value="ceng">Civil Engineering</option>
					<option value="cs">Computer Science</option>
					<option value="fin">Finance</option>
					<option value="psy">Psychology</option>
					<option value="nrs">Nursing</option>
					<option value="bio">Biology</option>
					<option value="eng">English</option>
					<option value="chem">Chemistry</option>
				</select>
				<select id="desired_position" name="desired_position" class="select" style="margin-right: 100px;">
					<option value="%">Desired Position</option>
				</select><br></br>
				<select id="nationality" name="nationality" class="select" style="margin-right: 100px;">
					<option value="%">Country</option>
					<option value="us">United states</option>
					<option value="japan">Japan</option>
					<option value="thailand">Thailand</option>
					<option value="india">India</option>
					<option value="mexico">Mexico</option>
					<option value="uae">UAE</option>
					<option value="germany">Germany</option>
					<option value="england">England</option>
					<option value="france">France</option>
					<option value="malaysia">Malaysia</option>
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
        $sql = "SELECT j.JobTitle, j.Deadline, c.CityName, c.StateName, c.CountryName, o.OrganizationName
        FROM jobs j 
        JOIN job_locations jl ON j.JobID = jl.JobID 
        JOIN City c ON jl.CityID = c.CityID 
        JOIN organization o ON j.OrganizationID = o.OrganizationID 
        WHERE j.JobDomain  LIKE (SELECT JobDomain FROM jobs WHERE JobTitle LIKE 
        (SELECT DesiredPosition FROM candidate WHERE CandidateID = $cid))";         

        $result = $conn->query($sql);

        // Check if there are recommendations
        if ($result->num_rows > 0) {
            echo '<div class="right-panel">';
            echo '<h3 style="margin-left: 35px;">Recommendations for you</h3>';
            $recommend = array();
            // Loop through each recommendation
            while ($row = $result->fetch_assoc()) {
                echo '<div class="white">';
                echo '<a href="new_page.php" style="color:white">';
                echo '<h2><u>' . $row['JobTitle'] . ', ' . $row['OrganizationName'] . '</u></h2>';
                echo '</a>';
                echo '<h4>' . $row['CityName'] . ', ' . $row['StateName'] . ', ' . $row['CountryName'] . '</h4>';
                echo '<h4>Deadline: ' . date('m/d/Y', strtotime($row['Deadline'])) . '</h4>';
                echo '</div>';
            }

            echo '</div>';
        } else {
            echo '<p>No recommendations found.</p>';
        }

        $sql = "SELECT j.JobTitle, j.JobDomain, j.PostingDate, ct.CityName, ct.StateName, ct.CountryName, org.OrganizationName 
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
                echo '<a href="new_page.php" style="color:white">';
                echo '<h2><u>' . $row['JobTitle'] . ', ' . $row['OrganizationName'] . '</u></h2>';
                echo '</a>';
                echo '<h4>' . $row['CityName'] . ', ' . $row['StateName'] . ', ' . $row['CountryName'] . ' - Deadline: ' . date('m/d/Y', strtotime($row['PostingDate'])) . '</h4>';
                echo '</div>';
            }
            echo '</div>';
        }
    ?>
</body>
</html>
