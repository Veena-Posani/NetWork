<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailid = $_POST['username'];
    $password = $_POST['password'];

    require("connection.php");

    $emailid = stripcslashes($emailid);
    $pass = stripcslashes($password);

    $sql = "SELECT * FROM candidate WHERE candidate.EmailAddress='$emailid' AND candidate.Password='$password'";
    $result=mysqli_query($con,$sql);

    if ($result->num_rows == 1) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['CandidateFirstName'] = $row['FirstName'];
        $_SESSION['CandidateLastName'] = $row['LastName'];
        $_SESSION['EmailAddress'] = $row['EmailAddress'];
        $_SESSION['PhoneNumber'] = $row['PhoneNumber'];
        header('Location: ../Front-end pages/CProfile.html');
        exit();
    } else {
        echo "Invalid username or password. Please try again.";
    }

    $con->close();
}
?>