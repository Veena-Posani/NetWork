<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";
// require("./connection.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];
$userType = $_POST["join"];
echo $userType;
if ($userType === "Candidate") {
    $table = "candidate";
    $redirectPage = "../Front-end pages/CProfile.php";
} elseif ($userType === "Recruiter") {
    $table = "recruiter";
    $redirectPage = "../Front-end pages/RProfile.php";
} else {
    $_SESSION['login_error'] = true;
    header("Location: ../Front-end pages/Home.html");
    exit();
}

$sql = "SELECT * FROM $table WHERE EmailAddress = '$username' AND Password = '$password' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result))
	{   
        if ($userType === "Candidate"){
            $_SESSION['username'] = $row['EmailAddress'];
            $_SESSION['password'] = $row['Password'];
            $_SESSION['cfname'] = $row['CFirstName'];
            $_SESSION['cid'] = $row['CandidateID'];
            $_SESSION['table'] = 'candidate';
        }
        else{
            $_SESSION['username'] = $row['EmailAddress'];
            $_SESSION['password'] = $row['Password'];
            $_SESSION['rfname'] = $row['RFirstName'];
            $_SESSION['rid'] = $row['RecruiterID'];
            $_SESSION['OrgID'] = $row['OrganizationID'];
            $_SESSION['table'] = 'recruiter';
        }
		header("Location: $redirectPage");
	}
    exit();
} else {
    // echo $userType;
    // echo $table;
    // echo $result->num_rows;
    // echo $username;
    // echo $password;
    $_SESSION['login_error'] = true;
    header("Location: ../Front-end pages/Home.html");
    exit();
}

$conn->close();
?>
