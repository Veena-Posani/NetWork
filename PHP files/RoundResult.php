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

$ApplicationID = $_GET['varname'];
$AppStat = $_GET['stat'];

echo $ApplicationID;
echo $AppStat;

if ($AppStat)
{
    $stat = 'Job Offered';
}
else
{
    $stat = 'Application Rejected';
}

# inserting in that table would require applicationID, RoundID, Status, StartTime, Deadline
$sql = "UPDATE applications SET `Status` = 'Inactive' WHERE ApplicationID = $ApplicationID";
$result = mysqli_query($conn, $sql);

$sql1 = "INSERT INTO round_results (applicationID, acceptanceStatus) VALUES ($ApplicationID, '$stat')";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "DELETE FROM active_rounds WHERE ApplicationID = $ApplicationID";
$result2 = mysqli_query($conn, $sql2);

header("Location: ../Front-end pages/RProfile.php");
$conn->close();
?>