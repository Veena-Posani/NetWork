<?php
//Recruiter Registration page is to register the new recruiters into the database 
//start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Access all the fields with $_POST 
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$org = $_POST['org'];
$position = $_POST['position'];
$password = $_POST['password']; 
//select statement to get the organizationID from the organization table into the recruiter table 
$org_query = "SELECT OrganizationID FROM organization WHERE OrganizationName = '$org'";
$org_result = $conn->query($org_query);

if ($org_result!== false) {
if ($org_result->num_rows > 0) {
    $org_row = $org_result->fetch_assoc();
    $org_id = $org_row['OrganizationID'];
    

    // insert statment for registration of recruiter to insert the fields in the database based on the provided fields
    $sql = "INSERT INTO recruiter (RFirstName, RLastName, PositionName, EmailAddress, PhoneNumber, OrganizationID, Password) 
            VALUES ('$first_name', '$last_name', '$position', '$email','$contact', '$org_id', '$password')";

    if ($conn->query($sql) === TRUE) {
       
        $sql1 = "SELECT RecruiterID FROM recruiter WHERE RFirstName = '$first_name' AND RLastName = '$last_name' AND EmailAddress = '$email' AND PhoneNumber = '$contact' AND  PositionName = '$position' AND OrganizationID = '$org_id' AND Password = '$password'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0)
        {
            $row1 = $result1->fetch_assoc();
            $recruiterID = $row1['RecruiterID'];
            // $_SESSION['cid'] = $row1['CandidateID'];
            // echo $_SESSION['cid'];
        }
        // Registration successful, redirect to another page
        header("Location: update_hashing.php?rid=$recruiterID&cid=-1");
        exit();
    } else {
                echo "Error inserting data into the table: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "No matching OrganizationID found for OrganizationName: '$org'";
        }
    } else {
        echo "Error executing the query: " . $major_query . "<br>" . $conn->error;
    }

$conn->close();
?>


