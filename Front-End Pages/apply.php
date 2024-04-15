<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jobID = $_POST["jobID"];
    $candiID = $_POST["candiID"];
    $notificationMessage = "You have applied for the job with ID: $jobID";

    $insertNotification = $conn->prepare("INSERT INTO applications (JobID, CandidateID, ApplicationDate, Status) VALUES (?, ?, NOW(), 'Active')");
    $insertNotification->bind_param("ii", $jobID, $candiID);

    if ($insertNotification->execute()) {
        header("Location: CandDisplay.php");
        exit();
    } else {
        echo "Error: " . $insertNotification->error;
    }

    $insertNotification->close();
    $conn->close();
}
?>



