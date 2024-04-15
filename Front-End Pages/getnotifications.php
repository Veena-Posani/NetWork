<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="Cprofile.css">
    <style>
        body {
            color: white;
        }

        .job-details-container {
            color: white;
        }
        .button-container {
            display: flex;
            gap: 10px; /* Adjust the gap as needed */
        }

        .button-container form {
            margin: 0; /* Remove default form margin */
        }
    </style>
    <script>
    function dismissNotification(applicationId) {
        // Hide the notification container
        var notificationContainer = document.getElementById('notification_' + applicationId);
        notificationContainer.style.display = 'none';
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
        <a href="../Network/CanLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
    </div>

    <div class="job-details-container">

        <?php
        

        $servername = "localhost";
        $username = "root";
        $password = "Adbms2023#";
        $dbname = "mydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['markCompleted'])) {
            $applicationId = $_POST['applicationId'];

            // Update the status in the active_rounds table
            $updateQuery = "UPDATE active_rounds SET Status = 'Completed' WHERE ApplicationID = $applicationId";
            $updateResult = $conn->query($updateQuery);

            // Check if the update was successful
            if ($updateResult) {
                // Additional actions if needed

                // Notify user about successful update
                echo '<script>alert("Marked as Completed successfully!");</script>';
            } else {
                // Handle update failure
                echo '<script>alert("Error marking as Completed. Please try again.");</script>';
            }
        }

        //$recruiterID = $_SESSION['recruiterID']; // Assuming you have a session variable for the recruiter ID
        session_start();
        if (!isset($_SESSION['cid']))
		{
			header("location: Home.html");
		}
        $candidateId = $_GET['cid'];
        
        $query1 = "SELECT ApplicationID, JobID FROM applications WHERE CandidateID = $candidateId AND Status = 'Active'";
        $qr1 = mysqli_query($conn, $query1);

        if ($qr1->num_rows > 0)
        {
            $applicationIDs = [];
            $jobIDs = [];
            while ($qrow1 = mysqli_fetch_array($qr1))
            {
                $current_application_ID = $qrow1['ApplicationID'];
                $query2 = "SELECT StartTime, Deadline FROM active_rounds WHERE ApplicationID = $current_application_ID";
                $qr2 = mysqli_query($conn, $query2);
                $starttime = [];
                $deadline = [];
                if ($qr2->num_rows > 0)
                {
                    $qrow2 = mysqli_fetch_array($qr2);
                    $jobID = $qrow1['JobID'];
                    $query3 = "SELECT * FROM jobs WHERE JobID = $jobID";
                    $qr3 = mysqli_query($conn, $query3);
                    $jobTitles = [];
                    $jobInfos = [];
                    if ($qr3->num_rows > 0)
                    {
                        $qrow3 = mysqli_fetch_array($qr3);
                        $orgID = $qrow3['OrganizationID'];
                        $query4 = "SELECT * FROM organization WHERE OrganizationID = $orgID";
                        $qr4 = mysqli_query($conn, $query4);
                        $orgNames = [];
                        if ($qr4->num_rows > 0)
                        {
                            $qrow4 = mysqli_fetch_array($qr4);
                            $query5 = "SELECT * FROM job_round WHERE JobID = $jobID";
                            $qr5 = mysqli_query($conn, $query5);
                            $RoundLinks = [];
                            if ($qr5->num_rows > 0)
                            {
                                $qrow5 = mysqli_fetch_array($qr5);
                                $RoundID = $qrow5['RoundID'];
                                $query6 = "SELECT * FROM round_types WHERE RoundID = $RoundID";
                                $qr6 = mysqli_query($conn, $query6);
                                $RoundNames = [];
                                if ($qr5->num_rows > 0)
                                {
                                    $qrow6 = mysqli_fetch_array($qr6);
                                    array_push($applicationIDs, $qrow1['ApplicationID']);
                                    array_push($jobIDs, $qrow1['JobID']);
                                    array_push($starttime, $qrow2['StartTime']);
                                    array_push($deadline, $qrow2['Deadline']);
                                    array_push($jobTitles, $qrow3['JobTitle']);
                                    array_push($jobInfos, $qrow3['Information']);
                                    array_push($orgNames, $qrow4['OrganizationName']);
                                    array_push($RoundLinks, $qrow5['RoundLink']);
                                    array_push($RoundNames, $qrow6['RoundName']);
                                }
                            }
                        }
                    }
                }
            }
        }

            $query = "SELECT ar.ApplicationID, j.JobID, j.JobTitle, j.Information, o.OrganizationName, rt.RoundName, jr.RoundLink, ar.StartTime, ar.Deadline
                      FROM active_rounds ar
                      JOIN applications a ON ar.ApplicationID = a.ApplicationID
                      JOIN jobs j ON a.JobID = j.JobID
                      JOIN job_round jr ON ar.RoundID = jr.RoundID
                      JOIN round_types rt ON jr.RoundID = rt.RoundID
                      JOIN organization o ON j.OrganizationID = o.OrganizationID
                      WHERE a.CandidateID = $candidateId AND ar.Status != 'Completed';";

        //$result = $conn->query($query);
        $result = mysqli_query($conn, $query);

        $sql1 = "SELECT * FROM round_results INNER JOIN applications ON round_results.ApplicationID = applications.ApplicationID WHERE CandidateID = $candidateId";
        $result1 = mysqli_query($conn, $sql1);

        $flag = 0;
        echo '<div class="bottom-panel" id="notificationContainer">';
        if ($result1->num_rows > 0)
        {
            $flag = 1;
            while ($row1 = mysqli_fetch_array($result1))
            {
                $applicationId = $row1["ApplicationID"];
                $JobID = $row1['JobID'];
                $sql4 = "SELECT * FROM jobs WHERE JobID = $JobID";
                $result4 = mysqli_query($conn, $sql4);

                if ($result4->num_rows > 0)
                {
                    $row4 = mysqli_fetch_array($result4);
                }

                $OrgID = $row4["OrganizationID"];
                $sql5 = "SELECT * FROM organization WHERE OrganizationID = $OrgID";
                $result5 = mysqli_query($conn, $sql5);

                if ($result5->num_rows > 0)
                {
                    $row5 = mysqli_fetch_array($result5);
                }
                
                $sql2 = "SELECT RecruiterID FROM jobs WHERE jobID = $JobID";
                $result2 = mysqli_query($conn, $sql2);

                if ($result2->num_rows > 0)
                {
                    $row2 = mysqli_fetch_array($result2);
                    $RecID = $row2['RecruiterID'];

                    $sql3 = "SELECT RFirstName, RLastName, EmailAddress FROM recruiter WHERE RecruiterID = $RecID";
                    $result3 = mysqli_query($conn, $sql3);

                    if ($result3->num_rows > 0)
                    {
                        $row3 = mysqli_fetch_array($result3);
                        $RFname = $row3['RFirstName'];
                        $RLname = $row3['RLastName'];
                        $REmail = $row3['EmailAddress'];
                    }
                }
                if ($row1['acceptanceStatus'] == 'Job Offered')
                {
                    echo "<h2>Job Offers!</h2>";
                    echo "<div class='white2' id='notification_" . $applicationId . "'>";
                    echo "<p>Application ID: " . $row1["ApplicationID"] . "</p>";
                    echo "<p>Job ID: " . $row1["JobID"] . "</p>";
                    echo "<p>Job Title: " . $row4["JobTitle"] . "</p>";
                    echo "<p>Description: " . $row4["Information"] . "</p>";
                    echo "<p>Organization Name: " . $row5["OrganizationName"] . "</p>";
                    echo "<p>Recruiter Name: " . $RFname." " .$RLname . "</p>";
                    echo "<p>Recruiter Email Address: " . $REmail . "</p>";
                    echo "<h3>Please contact the recruiter to let them know your decision!</h3>";
                    echo '</div>';
                }
                else
                {
                    echo "<h2>Rejections</h2>";
                    echo "<div class='white2' id='notification_" . $applicationId . "'>";
                    echo "<p>Application ID: " . $row1["ApplicationID"] . "</p>";
                    echo "<p>Job ID: " . $row1["JobID"] . "</p>";
                    echo "<p>Job Title: " . $row4["JobTitle"] . "</p>";
                    echo "<p>Description: " . $row4["Information"] . "</p>";
                    echo "<p>Organization Name: " . $row5["OrganizationName"] . "</p>";
                    echo '</div>';
                }
            }
        }
        if ($result->num_rows > 0) {
            $flag = 1;
            //echo '<div class="bottom-panel" id="notificationContainer">';
            echo '<h2>Notifications</h2>';
            for ($i = 0; $i < count($applicationIDs); $i++)
            {
                $applicationId = $applicationIDs[$i];
                echo "<div class='white2' id='notification_" . $applicationId . "'>";
                echo "<p>Application ID: " . $applicationId . "</p>";
                echo "<p>Job ID: " . $jobIDs[$i] . "</p>";
                echo "<p>Job Title: " . $jobTitles[$i] . "</p>";
                echo "<p>Description: " . $jobInfos[$i] . "</p>";
                echo "<p>Organization Name: " . $orgNames[$i] . "</p>";
                echo "<p>Round Name: " . $RoundNames[$i] . "</p>";
                echo "<p>Round Link: " . $RoundLinks[$i] . "</p>";
                echo "<p>Start Time: " . $starttime[$i] . "</p>";
                echo "<p>End Time: " . $deadline[$i] . "</p>";
                //echo '<button onclick="markAsCompleted(' . $row["ApplicationID"] . ')">Mark as Completed</button>';
                echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '">';
                echo '<input type="hidden" name="markCompleted" value="true">';
                echo '<input type="hidden" name="applicationId" value="' . $applicationId . '">';
                echo '<button onclick="dismissNotification(' . $applicationId . ')">Mark as completed</button>';
                echo '</form>';
                echo '</div>';
            }
        } 
        if ($flag == 0) {
            echo '<div class="bottom-panel">';
            echo "<p>No notifications found</p>";
            echo '</div>';
        }

        echo '</div>';

        // Close the database connection
        $conn->close();
        ?>
</div>
</body>
</html>


