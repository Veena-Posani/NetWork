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

if (!isset($_SESSION['cid']))
{
    header("location: Home.html");
}

$cid = $_SESSION['cid'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Access all the fields with $_POST 
    $FirstName = $_POST["FirstName"];
    $LastName = $_POST["LastName"];
    $PhoneNumber = $_POST["PhoneNumber"];
    $EducationLevel = $_POST["EducationLevel"];
    $Password = $_POST["Password"];
	$EmailAddress = $_POST["EmailAddress"];
	//Access all details from the session
    $username = $_SESSION['username'];
    $table = $_SESSION['table'];
    $password = $_SESSION['password'];
    $cid = $_SESSION['cid'];
	// update statment for settings to update the fields in the database based on the provided fields
    $updateSql = "UPDATE $table SET CFirstName='$FirstName', CLastName='$LastName', PhoneNumber='$PhoneNumber', EducationLevel='$EducationLevel', EmailAddress = '$EmailAddress' WHERE CandidateID='$cid'";

    if ($conn->query($updateSql) === TRUE) {
		// echo $salt;
        header("Location: ../NetWork/CanLogout.php");
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
    <link rel="stylesheet" href="Cprofile.css">
	<!-- External Cprofile for the background and href fields -->
    <script>
		//Function for the major field
		function populateDesiredPositions() {
			const majorSelect = document.getElementById("major");
			const desiredPositionSelect = document.getElementById("desired_position");
			desiredPositionSelect.innerHTML = '';
			const selectedMajor = majorSelect.value;
			if (selectedMajor === "Mechanical Engineering") {
				addOption(desiredPositionSelect, "Mechanical Engineer", "Mechanical Engineer");
				addOption(desiredPositionSelect, "Design Engineer", "Design Engineer");
				addOption(desiredPositionSelect, "Battery Design Engineer", "Battery Design Engineer");
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
				addOption(desiredPositionSelect, "Mental Health Counselor", "Mental Health Counselor");
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
    </script>    
</head>
<body>
	<!-- In the settings to update the candidate details we have used the update statement that will update the details of the provided
	given input fields of the candidate from html -->
    <div class="background"></div>
	<div class="top-menu">
        <img src="NWlogo.png" class="nw" width="180" height="55">
		<a href="CProfile.php"><img src = "home.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">HOME</span></a>
		<a href="CandDisplay.php"><img src = "profile.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">PROFILE</span></a>
		<a href="getnotifications.php?cid=<?php echo $cid?>"><img src = "noti.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">NOTIFICATIONS</span></a>
		<a href="CSettings.php"><img src = "settings.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">SETTINGS</span></a>
		<a href="../Network/CanLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
    </div>    
    <div class="middle-panel" style="margin: 50px auto; padding: 20px; width: 50%; background-color: rgba(255, 255, 255, 0.5); border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); text-align: center;">
        <form action="CSettings.php" method="POST">
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
			<!-- Dropbox fields of education level, major and desired position -->
            <label for="EducationLevel" style="font-size: 24px;">Education Level</label>
            <br>
            <select type="text" name="EducationLevel" id="EducationLevel" class="select" style="font-size: 20px; padding: 10px; width: 83%; margin: 10px auto; background-color: white; border-radius: 0px;" required>
				<option value="None">Select</option>
				<option value="High School">High School</option>
				<option value="Bachelor">Bachelor</option>
				<option value="Master">Master</option>
				<option value="PhD">PhD</option>
				<option value="Professional Certificate">Professional Certificate</option>
			</select>
            <br>

            <label for="Major" style="font-size: 24px;">Major</label>
            <br>
            <select type="text" name="major" id="major" class="select" onchange="populateDesiredPositions()" required style="font-size: 20px; padding: 10px; width: 83%; margin: 10px auto; background-color: white; border-radius: 0px;">
				<option value="None">Select</option>
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
            <br>

            <label for="desired" style="font-size: 24px;">Desired Position</label>
            <br>
            <select type="text" name="desired_position" id="desired_position" class="select" required style="font-size: 20px; padding: 10px; width: 83%; margin: 10px auto; background-color: white; border-radius: 0px;">
                <option value="">Select</option>
            </select>
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
