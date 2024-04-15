<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
    die("Connection failed: ". $conn->connect_error);
}

$JobTitle = $_POST['jobTitle'];
$PayRate = $_POST['pay_rate'];
$PayPeriod = $_POST['pay_period'];
$JobDomain = $_POST['jobDomain'];
$Deadline = $_POST['deadline'];
$Information = $_POST['information'];
$OrganizationID = $_SESSION['OrgID'];
$RecruiterID = $_SESSION['rid'];

$JobLocation = $_POST['location'];

$RoundID = $_POST['round_name'];
$RoundLink = $_POST['round_link'];
$RoundDuration = $_POST['round_duration'];

$split_1 = explode("T", $Deadline);
$PayRate = (int)$PayRate;
$OrganizationID = (int)$OrganizationID;
$RecruiterID = (int)$RecruiterID;

$sql3 = "INSERT INTO jobs (JobTitle, PayRate, PayPeriod, JobDomain, PostingDate, Deadline, Information, OrganizationID, RecruiterID) VALUES ('$JobTitle', $PayRate, '$PayPeriod', '$JobDomain', CURDATE(), '$split_1[0]', '$Information', $OrganizationID, $RecruiterID)";
$result3 = mysqli_query($conn, $sql3);

$sql6 = "SELECT JobID FROM jobs WHERE JobTitle = '$JobTitle' AND PayRate = $PayRate AND PayPeriod = '$PayPeriod' AND JobDomain = '$JobDomain' AND PostingDate = CURDATE() AND Deadline = '$split_1[0]' AND Information = '$Information' AND OrganizationID = $OrganizationID AND RecruiterID = $RecruiterID";
$result6 = mysqli_query($conn, $sql6);

if ($result6->num_rows > 0)
{
    $row6 = mysqli_fetch_array($result6);
    $JobID = $row6['JobID'];
}

$sql4 = "INSERT INTO job_locations (JobID, CityID) VALUES ($JobID, $JobLocation)";
$result4 = mysqli_query($conn, $sql4);

$sql5 = "INSERT INTO job_round (JobID, RoundID, RoundLink, Duration) VALUES ($JobID, $RoundID, '$RoundLink', '$RoundDuration')";
$result5 = mysqli_query($conn, $sql5);

// echo $result3;
header("Location: ../Front-end pages/RProfile.php");

$conn->close();
?>